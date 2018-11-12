<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Form\ChannelTranscoderType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Form\ChannelType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Transcoder controller.
 *
 */
class TranscoderController extends Controller
{   
    public function nodejsStartAction(Request $request, $id)
    {        
        $em = $this->getDoctrine()->getManager();		
		
        $entity = $em->getRepository('AppBundle:Channel')->find($id);
        
        if (!$entity) {
            return new Response("No Found", 404);
        }
        
        $this->get("app.transcoder.services")->execute($command, $entity);

        return new Response("Ok", 200);
    }

    public function startAction(Request $request, $ip, $id)
    {            
        $data = array(
            'id' => $id
        );       
               
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_TRANSCODER_START, $ip, $data, 'POST');     
        $response = json_decode($response); 
        
        $status = $response->success;
                                    
        if($status === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response->msg,
                    'password' =>  $response->data->password,
                    'apikey' =>  $response->data->apikey
                ));

        if ($status == "404") {
            $response = array('code' => "404", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.404"), "status" => "off");
        } else if ($status == "226") {
            $response = array('code' => "226", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.226"), "status" => "on");
        } else if ($status == "500") {
            $response = array('code' => "500", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.500"), "status" => "off");
        } else {
            $response = array('code' => "200", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.start.200"), "status" => "on");
        }

        return new Response(json_encode($response), "200");
    }

    public function stopAction(Request $request, $ip, $id)
    {   
        $data = array(
            'id' => $id
        );       
               
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_TRANSCODER_STOP, $ip, $data, 'POST');     
        $response = json_decode($response); 
        
        $status = $response->success;
                                    
        if($status === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response->msg,
                    'password' =>  $response->data->password,
                    'apikey' =>  $response->data->apikey
                ));      

        if ($status === 404) {
            $response = array('code' => "404", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.404"));
            return new Response(json_encode($response), 200);
        }

        if ($status === 400) {
            $response = array('code' => "400", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.400"), "status" => "off");
            return new Response(json_encode($response), "200");
        }
        
        $response = array('code' => "200", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.stop.200"), "status" => "off");
        return new Response(json_encode($response), "200");
    }

    public function startTranscoderVodPackageAction(Request $request)
    {       
        $id = $request->get("id");
        $ip = '127.0.0.1';

        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository("AppBundle:VodPackage")->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VodPackage entity.');
        }

        if ($entity->getAllowTranscoder()) {
            /**
             * Inicialmente verifico si el transcoder esta corriendo.
             */
            if ($entity->getTranscoderRunning()) {
                return new JsonResponse(
                    array("msg" => 'Transcoder is running', "status" => 200)
                ); 
            } 
            else{
                $vodsEntities = json_decode($entity->getVods(), true);
                $vods = array(); 

                foreach($vodsEntities as $datas){
                    $ip = $datas['server'];
                    $vods = $datas['vods'];
                    
                    $status = $this->get("app.util.services")->checkStreamsServerStatus($ip);

                    if($status['nodejs'] != false){
                        $server = $em->getRepository("AppBundle:StreamsServer")->findOneByServerAddress($ip);

                        $video_bitfilter = '';
                        if($entity->getAllowVideoBitStream())
                            $video_bitfilter = " -bsf:v h264_mp4toannexb ";

                        $audio_bitfilter = '';
                        if($entity->getAllowAudioBitStream())
                            $audio_bitfilter = " -bsf:a aac_adtstoasc ";

                        $data = array(
                            'id' => $id,
                            'serveraddress' => $ip,
                            'rtmpport' => $server->getBroadcastRTMPPort(),
                            'httpport' => $server->getBroadcastHTTPPort(),
                            'repeat' => $entity->getRepeatTranscoderProcess()?1:0,
                            'width' => $entity->getWidth(),
                            'height' => $entity->getHeight(),
                            'fps' => $entity->getFps(),
                            'bitrate' => $entity->getBitrate(),
                            'preset' => $entity->getPreset(),
                            'profile' => $entity->getProfile(),
                            'crf' => $entity->getCrf(),
                            'video_bitfilter' => $entity->getAllowVideoBitStream()?1:0,
                            'audio_bitfilter' => $entity->getAllowAudioBitStream()?1:0,
                            'vods' => json_encode($vods)
                        );

                        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_TRANSCODER_VODPACKAGE_START, $ip, $data, 'POST');        
                        $response = json_decode($response); 

                        if($response != NULL){
                            $code = $response->success;
            
                            if ($code != 401 && $code != 404 && $code != 500 && $code != 403) {
                                $pid = $response->data;

                                $entity->setTranscoderRunning(true);
                                $entity->setTranscoderPid($pid);
                                $live = "http://" . $ip . ":" . $data['httpport'] . "/streamshls/pack_" . $entity->getId() . "/index.m3u8";
                                $entity->setLive($live);

                                $vodsEntities[$ip]['live'] = $live;

                                $entity->setVods(json_encode($vodsEntities));

                                $em->persist($entity);
                                $em->flush();
                                
                                return new JsonResponse(
                                    array("msg" => 'Transcoder started', "status" => 200)
                                ); 
                            }

                            if($code === 400)  
                                return new JsonResponse(
                                    array("msg" => 'Transcoder not started', "status" => 500),
                                    Response::HTTP_INTERNAL_SERVER_ERROR
                                ); 
                        }
                    }
                }
            }
        }
        else{
            return new JsonResponse(
                array("msg" => 'Transcoder not allowed for this pachage', "status" => 500)
            ); 
        }

        return new JsonResponse(
            array("msg" => 'Transcoder not started', "status" => 500),
            Response::HTTP_INTERNAL_SERVER_ERROR
        ); 
    }

    public function stopTranscoderVodPackageAction(Request $request)
    {        
        $id = $request->get("id");
        $ip = '127.0.0.1';

        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository("AppBundle:VodPackage")->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VodPackage entity.');
        }

         /**
         * Inicialmente verifico si el transcoder esta detenido.
         */
        if (!$entity->getTranscoderRunning()) {
            return new JsonResponse(
                array("msg" => 'Transcoder not running', "status" => 500),
                Response::HTTP_INTERNAL_SERVER_ERROR
            ); 
        }
        else{
            $response = $this->get("app.util.services")->sendRequest($this::ROUTE_TRANSCODER_VODPACKAGE_STOP.$id, $ip);
            $response = json_decode($response);

            $vodsEntities = json_decode($entity->getVods(), true);

            foreach($vodsEntities as $datas){
                $ip = $datas['server'];
                
                $status = $this->get("app.util.services")->checkStreamsServerStatus($ip);

                if($status['nodejs'] != false){
                    $server = $em->getRepository("AppBundle:StreamsServer")->findOneByServerAddress($ip);                    

                    $data = array(
                        'id' => $id,
                        'repeat' => $entity->getRepeatTranscoderProcess()?1:0
                    );

                    $response = $this->get("app.util.services")->sendRequest($this::ROUTE_TRANSCODER_VODPACKAGE_STOP, $ip, $data, 'POST');        
                    $response = json_decode($response); 

                    if($response != NULL){
                        $code = $response->success;
        
                        if ($code != 401 && $code != 404 && $code != 500 && $code != 403) {
                             /**
                             * Actualizo la entidad
                             */
                            $entity->setTranscoderRunning(false);
                            $entity->setTranscoderPid(null);
                            $entity->setLive(null);

                            $vodsEntities[$ip]['live'] = "";
                            $entity->setVods(json_encode($vodsEntities));

                            $em->persist($entity);
                            $em->flush();
                            
                            return new JsonResponse(
                                array("msg" => 'Transcoder stoped', "status" => 200)
                            ); 
                        }

                        if($code === 400)  
                            return new JsonResponse(
                                array("msg" => 'Transcoder not started', "status" => 500),
                                Response::HTTP_INTERNAL_SERVER_ERROR
                            ); 
                    }
                }

            }
        }
    
        return new JsonResponse(
            array("msg" => 'Transcoder not started', "status" => 500),
            Response::HTTP_INTERNAL_SERVER_ERROR
        ); 
    }

    public function startTranscoderAllVodPackageAction()
    {       
        if ($vodPackages = $this->getDoctrine()->getRepository('AppBundle:VodPackage')->findAll()) {
            foreach ($vodPackages as $vodPackage) {
                $this->get('app.transcoder.services')->startTranscoderVodPackage($vodPackage);
            }
            $this->addFlash('success', 'Transcoder started for all video packages');
        }

        return $this->redirectToRoute('vod-package');
    }

    public function stopTranscoderAllVodPackageAction()
    {        
        if ($vodPackages = $this->getDoctrine()->getRepository('AppBundle:VodPackage')->findAll()) {
            foreach ($vodPackages as $vodPackage) {
                $this->get('app.transcoder.services')->stopTranscoderVodPackage($vodPackage);
            }
            $this->addFlash('success', 'Transcoder stoped for all video packages');
        }

        return $this->redirectToRoute('vod-package');
    }

    /*Start All channel package*/
    public function startTranscoderAllChannelAction($ip)
    {     
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_TRANSCODER_CHANNELS_STARTALL, $ip);             
        $response = json_decode($response); 
        
        $status = $response->success;
                                    
        if($status === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response->msg,
                    'password' =>  $response->data->password,
                    'apikey' =>  $response->data->apikey
                ));  

        // if ($status == "404") {
        //     $response = array('code' => "404", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.404"), "status" => "off");
        // } else if ($status == "226") {
        //     $response = array('code' => "226", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.226"), "status" => "on");
        // } else if ($status == "500") {
        //     $response = array('code' => "500", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.500"), "status" => "off");
        // } else {
        //     $response = array('code' => "200", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.start.200"), "status" => "on");
        // }       

        $this->addFlash('success', 'Transcoder started for all channels');
        return $this->redirectToRoute('channel');
    }

    /*Stop All channel package*/
    public function stopTranscoderAllChannelAction($ip)
    {      
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_TRANSCODER_CHANNELS_STOPALL, $ip);     
        $response = json_decode($response); 
        
        $status = $response->success;
                                    
        if($status === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response->msg,
                    'password' =>  $response->data->password,
                    'apikey' =>  $response->data->apikey
                )); 

        $this->addFlash('success', 'Transcoder stoped for all channels');
        return $this->redirectToRoute('channel');
    }

    /*Start All channel HTTP and RTSP package*/
    public function startTranscoderAllChannelHttpRtspAction()
    {        
        if ($channels = $this->getDoctrine()->getRepository('AppBundle:Channel')->findChannelsHttpRtsp('admin')) {
            foreach ($channels as $entity) {
                $status = $this->get("app.transcoder.services")->execute($command, $entity);

                if ($status == "404") {
                    $response = array('code' => "404", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.404"), "status" => "off");
                } else if ($status == "226") {
                    $response = array('code' => "226", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.226"), "status" => "on");
                } else if ($status == "500") {
                    $response = array('code' => "500", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.500"), "status" => "off");
                } else {
                    $response = array('code' => "200", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.start.200"), "status" => "on");
                }                
            }
        }

        $this->addFlash('success', 'Transcoder started for all channels');

        return $this->redirectToRoute('channel_http_rtsp');
    }

    /*Stop All channel HTTP and RTSP package*/
    public function stopTranscoderAllChannelHttpRtspAction()
    {       
        if ($channels = $this->getDoctrine()->getRepository('AppBundle:Channel')->findChannelsHttpRtsp('admin')) {
            foreach ($channels as $entity) {
                if (!file_exists($this->container->getParameter('kernel.logs_dir') . "/pids/" . trim($entity->getId()) . "/" . trim($entity->getId()) . ".pid")) {
                    $response = array('code' => "400", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.400"), "status" => "off");
                    //return new Response(json_encode($response), "200");
                }

                $pid = @file_get_contents($this->container->getParameter('kernel.logs_dir') . "/pids/" . trim($entity->getId()) . "/" . trim($entity->getId()) . ".pid");
                $pid = str_replace("\n", "", $pid);
                $pid += 0;
                if (file_exists("/proc/$pid") && $pid != "") {
                    $command = "kill -9 $pid";
                    @exec($command, $output);
                }
                exec('rm -R -f  ' . $this->container->getParameter('kernel.logs_dir') . "/pids/" . trim($entity->getId()));

                $dir = $this->container->getParameter("web.dir") . "/hls/";
                $handle = opendir($dir);
                while ($file = readdir($handle)) {
                    if (is_file($dir . $file)) {
                        if (preg_match('/^channel_' . $entity->getId() . '(.*)$/', $file)) {
                            @unlink($dir . $file);
                        }
                    }
                }

                $response = array('code' => "200", 'msg' => $this->get("translator")->trans("pages.channel.transcoder.stop.200"), "status" => "off");               
            }
        }

        $this->addFlash('success', 'Transcoder stoped for all channels');
        return $this->redirectToRoute('channel_http_rtsp');
    }

    public function restartTranscoderAllVodPackageAction()
    {        
        if ($vodPackages = $this->getDoctrine()->getRepository('AppBundle:VodPackage')->findAll()) {
            foreach ($vodPackages as $vodPackage) {
                $this->get('app.transcoder.services')->stopTranscoderVodPackage($vodPackage);
            }

            sleep(3);

            foreach ($vodPackages as $vodPackage) {
                $this->get('app.transcoder.services')->startTranscoderVodPackage($vodPackage);
            }
            $this->addFlash('success', 'Transcoder restarted for all video packages');
        }

        return $this->redirectToRoute('vod-package');
    }
}
