<?php

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Entity\Server;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Description of ChannelsProxy
 *
 * @author dmanuelcl@gmail.com
 */
class ChannelsProxy {

    private $container;

    function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function bindProxies(Channel $channel, $oldServers=null) {
        if($channel){
            if(!$oldServers){
                if($channel->getAllowLoadBalancing()) {
                    foreach ($channel->getServerForBalancing() as $proxy) {
                        $this->bind($channel, $proxy);
                    }
                }else{
                    $this->bind($channel, 0);
                }
            }else{
                if(is_array($oldServers)){
                    foreach ($channel->getServerForBalancing() as $proxy) {
                        if(!in_array($proxy,$oldServers)){
                            $this->bind($channel,$proxy);
                        }
                    }
                    if(count($channel->getServerForBalancing()->toArray())==0){
                        $this->bind($channel, 0);
                    }
                    foreach ($oldServers as $proxy) {
                        if(!in_array($proxy,$channel->getServerForBalancing()->toArray())){
                            $this->unbind($channel,$proxy);
                        }
                    }
                }else if(!$channel->getAllowLoadBalancing()){
                    $this->bind($channel, 0);
                }
            }
        }

    }

    public function updateChannels(Channel $channel){
        if($channel) {
            if($channel->getAllowLoadBalancing()){
                foreach ($channel->getServerForBalancing() as $proxy) {
                    $this->update($channel, $proxy);
                }
            }else{
                $this->update($channel, 0);
            }
        }
    }

    private function update(Channel $channel,$server){
        $protocols = ["hls","http","rtmp","rtsp"];
        $data = $this->container->get('app.util.services')->splitPath($channel->getLive());
        if(strpos($data["path"],".m3u8")!=false){
            $data['protocol']="hls";
        }
        $serverIp = !$server? "127.0.0.1":$server->getIpAddress();

        if(in_array($data['protocol'],$protocols)){
            $url = "http://$serverIp:".$this->container->getParameter("proxy")['server']."/channels/update";
            $this->{$data['protocol']}($channel,$server,$data,$url);
        }
    }

    private function bind(Channel $channel,$server){

        $protocols = ["hls","http","rtmp","rtsp"];
        $data = $this->container->get('app.util.services')->splitPath($channel->getLive());
        if(strpos($data["path"],".m3u8")!=false){
            $data['protocol']="hls";
        }

        $serverIp = $server == 0 ? "127.0.0.1":$server->getIpAddress();

        if(in_array($data['protocol'],$protocols)){
            $url = "http://$serverIp:".$this->container->getParameter("proxy")['server']."/channels/new";
            $this->{$data['protocol']}($channel,$server,$data,$url);
        }
    }

    private function hls(Channel $channel,$server,array $data,$url){
        $path = substr($data['path'],0,strrpos($data['path'],'/'));
        $name = substr($data['path'],strrpos($data['path'],'/')+1);
        if(!$name){
            $name='';
        }
        $postData = array(
            'id'=>$channel->getToken(),
            'type'=>"hls",
            'channel'=>array(
                $channel->getToken(),
                "http://".$data["ip"].":".$data['port'],
                $path,
                $name
            )
        );
        $this->container->get('app.util.services')->doRequest($url,"POST",$postData);
    }

    private function http(Channel $channel,$server,array $data,$url){
        $postData = array(
            'id'=>$channel->getToken(),
            'type'=>"http",
            'channel'=>array(
                $channel->getToken(),
                "http://".$data["ip"].":".$data['port'],
                $data['path']
            )
        );
        $this->container->get('app.util.services')->doRequest($url,"POST",$postData);
    }

    private function rtsp(Channel $channel,$server,array $data,$url){
        $postData = array(
            'id'=>$channel->getToken(),
            'type'=>"rtsp",
            'channel'=>array(
                $channel->getToken(),
                $data["ip"],
                $data['port'],
                $data['path'],
            ),
        );
        $this->container->get('app.util.services')->doRequest($url,"POST",$postData);
    }

    private function rtmp(Channel $channel,$server,array $data,$url){
        $postData = array(
            'id'=>$channel->getToken(),
            'type'=>"rtmp",
            'channel'=>array(
                $channel->getToken(),
            )
        );
        $this->container->get('app.util.services')->doRequest($url,"POST",$postData);
    }

    public  function unbind(Channel $channel,$server){
        $serverId = !$server ? 0: $server->getId();
        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('AppBundle:ProxyChannels')->findOneBy(array(
            "channel"=>$channel->getToken(),
            "server"=>$serverId
        ));

        if($entity){
            $data = $this->container->get('app.util.services')->splitPath($channel->getLive());
            if(strpos($data["path"],".m3u8")!=false){
                $data['protocol']="hls";
            }
            $postData = array(
                'id'=>$channel->getToken(),
                'type'=>$data['protocol'],
            );

            $serverIp = !$server ? "127.0.0.1":$server->getIpAddress();

            $em->remove($entity);
            $em->flush();
            $url = "http://$serverIp:".$this->container->getParameter("proxy")['server']."/channels/remove";
            $this->container->get('app.util.services')->doRequest($url,"POST",$postData);
        }
        $this->bind($channel,0);
    }



}
