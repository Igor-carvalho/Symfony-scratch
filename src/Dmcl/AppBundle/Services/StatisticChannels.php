<?php

namespace Dmcl\AppBundle\Services;


use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Entity\VodPackage;
use Dmcl\AppBundle\Entity\Vod;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;


/**
 * Description of IncomingChannel
 */
class StatisticChannels
{

    private $container;
    private $em;
    private $logger;
    private $regName = '/^[\w\s\-]+$/';

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.default_entity_manager');
        $this->logger = $container->get('logger');
    }

    public function getChannels(){
        $result = array('success' => true);
        $serverNginx = $this->container->get('app.twig.extension.utils')->getServerNginx();
        $urlRtmp = $this->container->get('app.twig.extension.utils')->getRtmpServerAddress();
        try{
            $xml = simplexml_load_file($serverNginx . '/stat');
            $data   = json_encode($xml);
//            $data = '{"nginx_version":"1.9.9","nginx_rtmp_version":"1.1.4","compiler":"gcc 4.8.4 (Ubuntu 4.8.4-2ubuntu1~14.04.3) ","built":"May 2 2017 17:33:35","pid":"17183","uptime":"274","naccepted":"2","bw_in":"2570568","bytes_in":"42468387","bw_out":"0","bytes_out":"818","server":{"application":[{"name":"livehls","live":{"nclients":"0"}},{"name":"streams","live":{"nclients":"0"}},{"name":"live-dash","live":{"nclients":"0"}},{"name":"live-hls","live":{"nclients":"0"}},{"name":"dash-rec","live":{"nclients":"0"}},{"name":"hls-rec","live":{"nclients":"0"}},{"name":"rec-all"},{"name":"live","live":{"stream":[{"name":"channel_591757fa14d9d","time":"193688","bw_in":"1014840","bytes_in":"32538783","bw_out":"0","bytes_out":"0","bw_audio":"56608","bw_video":"961752","client":{"id":"1","address":"10.8.143.138","time":"193741","dropped":"0","avsync":"-16","timestamp":"296558","publishing":{},"active":{}},"meta":{"video":{"width":"470","height":"380","frame_rate":"15","codec":"H264","profile":"Baseline","compat":"192","level":"2.1"},"audio":{"codec":"MP3","channels":"2","sample_rate":"44100"}},"nclients":"1","publishing":{},"active":{}},{"name":"channel_1497131626320","time":"54324","bw_in":"1297912","bytes_in":"9471750","bw_out":"0","bytes_out":"0","bw_audio":"100008","bw_video":"1197896","client":{"id":"5","address":"10.8.143.138","time":"54410","dropped":"0","avsync":"11","timestamp":"87167","publishing":{},"active":{}},"meta":{"video":{"width":"470","height":"380","frame_rate":"15","codec":"H264","profile":"Baseline","compat":"192","level":"2.1"},"audio":{"codec":"AAC","profile":"LC","channels":"2","sample_rate":"44100"}},"nclients":"1","publishing":{},"active":{}}],"nclients":"2"}},{"name":"vod","play":{"nclients":"0"}}]}}';
            $data   = json_decode($data);
            foreach ($data->server->application as $application){
                if(!empty($application->live->stream)){
                    $streams = $application->live->stream;
                    if(!is_array($streams)){
                        $streams = array($streams);
                    }
                    foreach ($streams as $channel){
                        $data[] = array(
                            'name' => $channel->name,
                            'output' => $urlRtmp . "/" . $application->name . "/" . $channel->name,
                            'source' => ''
                        );
                    }
                }
            }
            $result['data'] = $data;
        } catch (\Exception $e){
            $result['success'] = false;
            $result['msg'] = $this->container->get('translator')->trans('pages.channel.msg_error_server_nginx_off');
            $result['data'] = array();
            $this->logger->error( __FUNCTION__, $e->getTraceAsString());
        }
        return $result;
    }

    public function getIncomingChannelsFromStats(){
        $result = array('success' => true);
        $serverNginx = $this->container->get('app.twig.extension.utils')->getServerNginx();
        $urlRtmp = $this->container->get('app.twig.extension.utils')->getRtmpServerAddress();
        $channels = array();
        try{
            $xml = simplexml_load_file($serverNginx . '/stat');
            $data   = json_encode($xml);
//            $data = '{"nginx_version":"1.9.9","nginx_rtmp_version":"1.1.4","compiler":"gcc 4.8.4 (Ubuntu 4.8.4-2ubuntu1~14.04.3) ","built":"May 2 2017 17:33:35","pid":"17183","uptime":"274","naccepted":"2","bw_in":"2570568","bytes_in":"42468387","bw_out":"0","bytes_out":"818","server":{"application":[{"name":"livehls","live":{"nclients":"0"}},{"name":"streams","live":{"nclients":"0"}},{"name":"live-dash","live":{"nclients":"0"}},{"name":"live-hls","live":{"nclients":"0"}},{"name":"dash-rec","live":{"nclients":"0"}},{"name":"hls-rec","live":{"nclients":"0"}},{"name":"rec-all"},{"name":"live","live":{"stream":[{"name":"channel_591757fa14d9d","time":"193688","bw_in":"1014840","bytes_in":"32538783","bw_out":"0","bytes_out":"0","bw_audio":"56608","bw_video":"961752","client":{"id":"1","address":"10.8.143.138","time":"193741","dropped":"0","avsync":"-16","timestamp":"296558","publishing":{},"active":{}},"meta":{"video":{"width":"470","height":"380","frame_rate":"15","codec":"H264","profile":"Baseline","compat":"192","level":"2.1"},"audio":{"codec":"MP3","channels":"2","sample_rate":"44100"}},"nclients":"1","publishing":{},"active":{}},{"name":"channel_1497131626320","time":"54324","bw_in":"1297912","bytes_in":"9471750","bw_out":"0","bytes_out":"0","bw_audio":"100008","bw_video":"1197896","client":{"id":"5","address":"10.8.143.138","time":"54410","dropped":"0","avsync":"11","timestamp":"87167","publishing":{},"active":{}},"meta":{"video":{"width":"470","height":"380","frame_rate":"15","codec":"H264","profile":"Baseline","compat":"192","level":"2.1"},"audio":{"codec":"AAC","profile":"LC","channels":"2","sample_rate":"44100"}},"nclients":"1","publishing":{},"active":{}}],"nclients":"2"}},{"name":"vod","play":{"nclients":"0"}}]}}';
            $data   = json_decode($data);
            foreach ($data->server->application as $application){
                if(empty($application)) continue;
                if(!empty($application->live)){
                    if(!empty($application->live->stream)){
                        $streams = $application->live->stream;
                        if(!is_array($streams)){
                            $streams = array($streams);
                        }
                        foreach ($streams as $channel){
                            if(empty($channel)) continue;
                            if($this->isIncoming($channel)){
                                $item = array(
                                    'application' => $application->name,
                                    'name' => $channel->name,
                                    'bw_video' => $channel->bw_video / 1024,
                                    'source' => $urlRtmp . "/" . $application->name . "/" . $channel->name,
                                    'live' => !empty($channel->active) ? 'active' : 'idle'
                                );
                                $item['stream_id'] = md5($item['source']);
                                $channels[] = $item;
                            }
                        }
                    }
                }
            }
            $result['data'] = $channels;
        } catch (\Exception $e){
            $result['success'] = false;
            $result['msg'] = $this->container->get('translator')->trans('pages.channel.msg_error_server_nginx_off');
            $result['data'] = array();
//            $this->logger->error( __FUNCTION__, $e->getMessage());
        }
        return $result;
    }


    public function getIncomingChannelsFromDB(Request $request){
        $channels  = array();
        $entities = $this->em->getRepository('AppBundle:Channel')->findBy(array('incoming' => true));
        /**
         * @var Channel $entity
         */
        foreach ($entities as $entity){
            $categoryName = '';
            if($entity->getCategory()){
                $categoryName = $entity->getCategory()->getName();
            }
            //rtmp://10.8.143.138:1935/live/channel_591757fa14d9d
            $source_app = $entity->getSource();
            $source_app = str_replace('rtmp://', '', $source_app);
            $source_app_arr = explode('/', $source_app);
            $application= $source_app_arr[1];

            $port = "";
            if(!empty($request->getPort()) && $request->getPort() != 80){
                $port = ":{$request->getPort()}";
            }
            $logoUrlBase = "{$request->getScheme()}://{$request->getHost()}{$port}{$request->getBaseUrl()}";
            $logoUrlBase = $logoUrlBase . "/uploads/";
            $urlLogo = "";
            if(!empty( $entity->getLogo())){
                if(!$entity->isLogoUrl()){
                    $urlLogo = $logoUrlBase . $entity->getLogo();
                } else {
                    $urlLogo = $entity->getLogo();
                }
            }
            $channels[] = array(
                'id' => $entity->getId(),
                'application' => $application,
                'name' => $entity->getName(),
                'category' => $categoryName,
                'stream' => $entity->getSource(),
                'stream_id' => md5($entity->getSource()),
                'status' => $entity->getEnabled(),
                'bw_video' => $entity->getBitRate(),
                'logo' => $urlLogo,
                'active' => ''
            );
        }
//        $channels = $this->em->getRepository('AppBundle:Channel')->findAll();
        return $channels;
    }

    private function isIncoming($dataChannel){
        $address = $dataChannel->client->address;
        $command="/sbin/ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'";
        $localIP = exec ($command);
        if(isset($dataChannel->client->publishing)){
            if($address != $localIP) return true;
        }
        return false;
    }


    public function saveBulk($channels){
        $batchSize = 20;
        foreach($channels as $i=>$channel) {
            if (!preg_match($this->regName, $channel['name'])) {
                $error = array(
                    'name' =>$channel['name'],
                    'path' =>$channel['source'],
                    'msg' => $this->container->get('translator')->trans('pages.channel.msg_error_name'),
                );
                $result['errores'][] = $error;
                $this->logger->error( __FUNCTION__, $error);
                continue;
            }

            $entity = $this->em->getRepository('AppBundle:Channel')->findOneBy(array('source' => $channel['source']));
            if(empty($entity)){
                $entity = new Channel();
                $entity->setProtocol('rtmp');
                $entity->setIncoming(true);
            }


            /**
             * @var Channel $entity
             */

            $entity->setName($channel['name']);
            $entity->setSource($channel['source']);
            $entity->setLive($channel['source']);
            $entity->setBitRate($channel['bw_video']);

            if(!empty($channel['logo'])){
                $entity->setLogo($channel['logo']);
            }

            $this->em->persist($entity);
            $this->container->get('app.channelsproxy.services')->bindProxies($entity);
            if (($i % $batchSize) === 0) {
                $this->em->flush();
                $this->em->clear(); // Detaches all objects from Doctrine!
            }
        }

        $this->em->flush(); //Persist objects that did not make up an entire batch
        $this->em->clear();
    }
    public function saveIncomingChannels(){
        $response = $this->getIncomingChannelsFromStats();

        if($response['success'] == false){
            return;
        }
        $this->saveBulk($response['data']);
    }
}
