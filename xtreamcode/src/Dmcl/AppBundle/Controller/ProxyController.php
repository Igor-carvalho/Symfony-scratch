<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\ProxyChannels;
use Dmcl\AppBundle\Entity\Server;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProxyController extends Controller
{

    public function indexAction(Request $request,$server)
    {        
        if(method_exists($this,$request->get("action")."Action")){
            $em = $this->getDoctrine()->getManager();
            if($server){
                $server = $em->getRepository('AppBundle:Server')->find($server);
                if(!$server){
                    return new Response(json_encode(array('status'=>403)),403);
                }
            }
            return $this->{$request->get("action")."Action"}($request,$server);
        }
        return new Response(json_encode(array('status'=>403)),403);
    }

    public function vodIndexAction(Request $request,$server)
    {        
        if(method_exists($this,$request->get("action")."Action")){
            $em = $this->container->get('doctrine.orm.entity_manager');
            if($server){
                $server = $em->getRepository('AppBundle:Storages')->find($server);
                if(!$server){
                    return new Response(json_encode(array('status'=>403)),403);
                }
            }
            return $this->{$request->get("action")."Action"}($request,$server);
        }
        return new Response(json_encode(array('status'=>403)),403);
    }


    public function checkCustomerAction(Request $request, $server){        
        $this->container->get("logger")->alert("dmcl: checking customer");
        return $this->forward("AppBundle:Playback:handlePlay",array(),$request->query->all());
    }

    public function checkCloseConnectionAction(Request $request, $server){        
        $this->container->get("logger")->alert("dmcl: close connection");
        return $this->forward("AppBundle:Playback:handleStop",array(),$request->query->all());
    }

//hls -> //http://127.0.0.1:55551/random-value-uuid/hls-proxy?c=cliente-id&t=session-token&ch=channel-id
//http -> //http://127.0.0.1:55550/s?c=cliente-id&t=session-token&ch=channel-id
//rtsp -> //rtsp://127.0.0.1:55552/original/path?c=cliente-id&t=session-token&ch=channel-id
//rtmp -> //rtmp://127.0.0.1:55553/s/random-value-uuid?c=cliente-id&t=session-token&ch=channel-id
    public function channelProxyAction(Request $request,$server){
        $type= $request->get("type");
        $channelId = $request->get("id");
        $port= $request->get("localPort");
        $path= $request->get("path");
        $serverIp = !$server ? $this->container->get("app.config.services")->getGeneralConfig()->getServerAddress():$server->getIpAddress();
        $serverId = !$server ? 0:$server->getId();
        $em = $this->getDoctrine()->getManager();
        if($channelId && $type){
            $entity = $em->getRepository('AppBundle:ProxyChannels')->findOneByChannel($channelId);
            if(!$entity){
                $entity = new ProxyChannels();
            }
            $baseUrl = '';
            switch($type){
                case "hls":
                    $baseUrl = "http://$serverIp:$port/".uniqid()."/hls-proxy?ch=$channelId&sr=$serverId";
                    break;
                case "http":
                    $baseUrl = "http://$serverIp:$port/".uniqid()."?ch=$channelId&sr=$serverId";
                    break;
                case "rtsp":
                    $baseUrl = "rtsp://$serverIp:$port$path?ch=$channelId&sr=$serverId";
                    break;
                case "rtmp":
                    $baseUrl = "rtmp://$serverIp:$port/s/".uniqid()."?ch=$channelId&sr=$serverId";
                    break;
                default:
                    $baseUrl = "http://127.0.0.1/s/".uniqid()."?ch=$channelId&sr=$serverId";
                    break;
            }
            $entity->setChannel($channelId);
            $entity->setServer($serverId);
            $entity->setType($type);
            $entity->setBasePath($baseUrl);
            $em->persist($entity);
            $em->flush();
            return new Response(json_encode(array('status'=>200)),200);
        }
    }
}
