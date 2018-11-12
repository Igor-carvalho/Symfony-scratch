<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Entity\CountryPlaybackHistory;
use Dmcl\AppBundle\Entity\PlayBackHistory;
use Dmcl\AppBundle\Entity\ServersSessions;
use Dmcl\AppBundle\Entity\Country;
use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Dmcl\AppBundle\Form\Model\TimeshiftModel;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Playback controller.
 *
 */
class PlaybackController extends Controller
{
    public function playRequestAction(Request $request,$customer,$type,$id)
    {
        $em = $this->container->get("doctrine.orm.entity_manager");
        $_customer = $em->getRepository('AppBundle:Customers')->find($customer);
        if(!$_customer){
            return new Response("Bad Request", 400);
        }

        $types = array(
            'Channel'=>"tvPlayRequest",
            'Vod'=>"vodPlayRequest"
        );

        if(!in_array($type,$types)){
            return $this->{$types[$type]}($request,$customer,$id);
        }
        return new Response("Bad Request", 400);
    }

    private function tvPlayRequest(Request $request,$customer,$id){
        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('AppBundle:Channel')->find($id);
        if(!$entity){
            return new Response("Bad Request", 400);
        }
        $source = $this->container->get("app.stream.security.services")->secureChannel($entity,$customer);
        if (!$source){
            return new Response("Nothing to play",404);
        }
        return new Response($source,200);
    }

    private function vodPlayRequest(Request $request,$customer,$id){
        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('AppBundle:Vod')->find($id);
        if(!$entity){
            return new Response("Bad Request", 400);
        }
        $source = $this->container->get("app.stream.security.services")->secureVod($entity,$customer);
        if (!$source){
            return new Response("Nothing to play",404);
        }
        return new Response($source,200);
    }

    public function handlePlayAction(Request $request, $ip)
    {
        $em = $this->getDoctrine()->getManager();
        
        $server = $em->getRepository('AppBundle:StreamsServer')->findOneByServerAddress($ip);
        $nodejsPort = $server->getNodeJsPort();

        $data = array(
            'mediaType' => $request->get('mediaType'),
            'mediaId' => $request->get('mediaId'),
            'owner' => $request->get('owner'),
            'nodejsport' => $nodejsPort
        );
                
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_PLAYBACK_START, $ip, $data, 'POST');     
        $response = json_decode($response);  
        
        if($response != NULL){
            $code = $response->success;

            if ($code == 401 || $code == 404 || $code == 500) {
                return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                            'msg' => $response->msg,
                            'data' => $response->data
                ));
            }

            if ($code === 403) {
                return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                            'msg' => $response->msg,
                            'password' => $response->data->password,
                            'apikey' => $response->data->apikey
                ));
            }
        }

        return new Response(json_encode(array('status'=>200, 'ip'=>$response->ip, 'country'=>$response->country)), 200);
    }

    public function handleStopAction(Request $request, $ip)
    {
        $data = array(
            'idchannel' => $request->get('t')
        );
                
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_PLAYBACK_STOP, $ip, $data, 'POST');
        $response = json_decode($response);  
        
        if($response != NULL){
            $code = $response->success;

            if ($code == 401 || $code == 404 || $code == 500) {
                return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                            'msg' => $response->msg,
                            'data' => $response->data
                ));
            }

            if ($code === 403) {
                return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                            'msg' => $response->msg,
                            'password' => $response->data->password,
                            'apikey' => $response->data->apikey
                ));
            }
        }
                
        return new Response("Ok",200);
    }

    public function playbackIndexAction()
    {     
        $streams_servers = $this->get("app.util.services")->getStreamsServerOnline();
        $entities = [];        
        
        foreach($streams_servers as $streams_server){           
            $entities[] = [
                'streams_server' => $streams_server->getServerAddress(),
                'server_name' => $streams_server->getName(),
            ];
        }

        return $this->render('@App/themes/default/Admin/Channel/indexPlayback.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function playbackAction($ip)
    {   
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_CHANNEL_ALL, $ip);     
        $response = json_decode($response);  
        
        if($response != null){
            $code = $response->success;
                                    
            if($code == 401 || $code == 404 || $code == 500)
                return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                    'msg' => $response->msg,
                    'data' =>  $response->data
                    )); 
                                        
            if($code === 403)
                return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                        'msg' => $response->msg,
                        'password' =>  $response->data->password,
                        'apikey' =>  $response->data->apikey
                    )); 
        }     
                                    
        // if($code === 403)
        //     return $this->redirect($this->generateUrl('settings'));

        $result = $response->data;
        
        $channels = [];
        $channelsCategory = [];

        foreach($result as $channel){
            $channels[] = new Channel($channel);
        }

        $categories = $this->getDoctrine()->getRepository('AppBundle:ChannelCategories')->findBy(array(), array('name' => 'ASC'));

        foreach ($categories as $category) {
            $aux = array();
            $count = 0;

            foreach ($channels as $channel) {
                if ($channel->getCategory() == $category->getId()) {
                    array_push($aux, array(
                        'id' => $channel->getId(),
                        'name' => $channel->getName(),
                        'stream' => $channel->getStream()
                    ));

                    $count++;
                }
            }

            if (count($aux) > 0) {
                array_push($channelsCategory, array(
                    'category' => array(
                        'id' => $category->getId(),
                        'name' => $category->getName()
                    ),
                    'channels' => $aux,
                    'count' => $count
                ));
            }
        }
        
        $timeshiftModel = new TimeshiftModel();

        $form = $this->createForm($this->get('app.form.timeshift'), $timeshiftModel);

        return $this->render('@App/themes/default/Admin/Channel/playback.html.twig', array(
            'channelsCategory' => $channelsCategory,
            'form' => $form->createView(),
            'ip' => $ip
        ));
    }

    public function playbackChannelInfoAction($ip, $idChannel, $startdate, $starttime, $enddate, $endtime)
    {
        $em = $this->getDoctrine()->getManager();

        $server = $em->getRepository('AppBundle:StreamsServer')->findOneByServerAddress($ip);

        $httpport = $server->getBroadcastHTTPPort();
        
        $route = $idChannel . '/' . $startdate . '/' . $starttime . '/' . $enddate . '/' . $endtime . '/' . $ip . '/' . $httpport;

        set_time_limit(0);
        
        $url = $this->get("app.util.services")->sendRequest($this::ROUTE_PLAYBACK_CHANNEL_INFO.$route, $ip);
        $response = array(
            'type' => 'http',
            'codeo' => base64_encode($url)
        );

        return new JsonResponse($response);
    }
}