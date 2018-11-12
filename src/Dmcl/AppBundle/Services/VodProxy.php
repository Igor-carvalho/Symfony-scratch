<?php

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\Storages;
use Dmcl\AppBundle\Entity\Vod;
use Dmcl\AppBundle\Entity\Server;
use Dmcl\AppBundle\Entity\VodSource;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Description of VodProxy
 *
 * @author dmanuelcl@gmail.com
 */
class VodProxy {

    private $container;

    function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function bindProxies(Vod $vod,$oldServers=null){
        if($vod){
            if(!$oldServers){
                if($vod->getAllowLoadBalancing()) {
                    foreach ($vod->getStoragesForBalancing() as $proxy) {
                        $this->bind($vod, $proxy);
                    }
                }else{
                    $this->bind($vod, 0);
                }
            }else{
                if(is_array($oldServers)){
                    foreach ($vod->getStoragesForBalancing() as $proxy) {
                        if(!in_array($proxy,$oldServers)){
                            $this->bind($vod,$proxy);
                        }
                    }
                    if(count($vod->getStoragesForBalancing()->toArray())==0){
                        $this->bind($vod, 0);
                    }
                    foreach ($oldServers as $proxy) {
                        if(!in_array($proxy,$vod->getStoragesForBalancing()->toArray())){
                            $this->unbind($vod,$proxy);
                        }
                    }
                }else{
                    $this->bind($vod,0);
                }
            }
        }
    }

    public function updateVods(Vod $vod){
        if($vod){
            if($vod->getAllowLoadBalancing()) {
                foreach ($vod->getStoragesForBalancing() as $proxy) {
                    $this->update($vod, $proxy);
                }
            }else{
                $this->bind($vod,0);
            }
        }
    }

    private function update(Vod $vod,$server){

        $protocols = ["http"];
        $data = $this->container->get('app.util.services')->splitPath($vod->getSources());

        $serverIp = !$server ? "127.0.0.1":$server->getIpAddress();

        if(in_array($data['protocol'],$protocols)){
            $url = "http://$serverIp:".$this->container->getParameter("proxy")['vod_server']."/vod/update";
            $this->{$data['protocol']}($vod,$server,$data,$url);
        }
    }

    private function bind(Vod $vod,$server){
        $sources = $vod->getSources();
        foreach ($sources as $source) {
            $protocols = ["http"];
            $data = $this->container->get('app.util.services')->splitPath($source->getVideo());

            $serverIp = !$server ? "127.0.0.1" : $server->getIpAddress();

            if (in_array($data['protocol'], $protocols)) {
                $url = "http://$serverIp:" . $this->container->getParameter("proxy")['vod_server'] . "/vod/new";
                $this->{$data['protocol']}($vod, $server, $data, $url);
            }
        }
    }

    private function http(Vod $vod, $server,array $data,$url){
        $postData = array(
            'id'=>$vod->getToken(),
            'type'=>"http",
            'channel'=>array(
                $vod->getToken(),
                "http://".$data["ip"].":".$data['port'],
                $data['path']
            )
        );
        $this->container->get('app.util.services')->doRequest($url,"POST",$postData);
    }

    public  function unbind(Vod $vod,$server){
        $serverId = !$server ? 0: $server->getId();
        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('AppBundle:ProxyChannels')->findOneBy(array(
            "channel"=>$vod->getToken(),
            "server"=>$serverId
        ));

        if($entity){
            $sources = $vod->getSources();
            foreach ($sources as $source) {
                $data = $this->container->get('app.util.services')->splitPath($source->getVideo());

                $postData = array(
                    'id' => $vod->getToken(),
                    'type' => $data['protocol'],
                );
                $serverIp = !$server ? "127.0.0.1" : $server->getIpAddress();
                $em->remove($entity);
                $em->flush();
                $url = "http://$serverIp:" . $this->container->getParameter("proxy")['vod_server'] . "/vod/remove";
                $this->container->get('app.util.services')->doRequest($url, "POST", $postData);
            }
        }

        $this->bind($vod,0);
    }
}
