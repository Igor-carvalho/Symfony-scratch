<?php

namespace Dmcl\AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Dmcl\AppBundle\Controller\BaseController as Base;
use Dmcl\AppBundle\Entity\License;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Description of Util
 *
 * @author dmanuelcl@gmail.com
 */
class Util
{

    private $container;

    private $fs;

    private $streams_servers;

    private $user;

    const ENCRYPTION_METHOD = "AES-256-CBC";

    function __construct(ContainerInterface $container, TokenStorage $tokenStorage)
    {
        $this->container = $container;
        $this->fs = new Filesystem();
        
        $token = $tokenStorage->getToken();
        $this->user = $token->getUser();

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $this->streams_servers = $em->getRepository("AppBundle:StreamsServer")->findByUser($this->user);
    }

    public function slug($cadena)
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, '-'));
        $slug = preg_replace("/[\/_|+ -]+/", '-', $slug);
        return $slug;
    }

    public function splitPath($path=""){
        $out=array();
        $out["protocol"] = substr($path,0,strpos($path,":"));
        $ip = substr($path,strpos($path,"://")+3);
        $path = substr($ip,strpos($ip,"/"));
        $ip =substr($ip,0,strpos($ip,"/"));
        $port = substr($ip,strpos($ip,":"));
        if($port==$ip){
            $port = 80;
        }else{
            $port = substr($ip,strpos($ip,":")+1);
        $ip = substr($ip,0,strpos($ip,":"));
        }
        $out["ip"] = $ip;
        $out["port"] = $port;
        $out["path"] = $path;
        return $out;
    }

    public function doRequest($path,$method,$data){
        $postdata = http_build_query($data);
        $opts = array('http' =>
            array(
                'method' => strtoupper($method),
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        return  @file_get_contents($path, false, $context);
    }

    public function bestServer($servers,$type){
        $em = $this->container->get('doctrine.orm.entity_manager');
        $serversTmp = null;
        foreach ($servers as $server) {
            $_server = array();
            $_server["address"] = $server->getIpAddress();
            $_server["port"] = $server->getPort();
            $_server["base"] =  $type == "Channel"?"/":$server->getBaseUrl();
            $_server["max_sessions"] = $server->getMaxConnections();
            $_server["id"] = $server->getId();
            $_server["type"] = $type;
            $_server["sessions"] = $em->getRepository('AppBundle:ServersSessions')->getCurrentSessions($server->getId(), $_server["type"]);
            $_server["load"] = $this->getLoad($_server, $_server["sessions"]);
            $serversTmp[$server->getId()] = $_server;
        }

        $server = $this->sortByLoad($serversTmp);
        if (count($server) > 0) {
            $server = $server[0];
        }
        return $server;
    }

    private function sortByLoad($servers){

        if (!empty($servers)){

            foreach ($servers as $id => $server) {
                $load[$id] = $server['load'];
            }

            array_multisort($load, SORT_ASC, SORT_NUMERIC, $servers);
        }
        return $servers;
    }

    private function getLoad($server, $sessions = null){
        if ($server['max_sessions'] > 0){
            if ($sessions === null){
                $em = $this->container->get('doctrine.orm.entity_manager');
                $sessions = $em->getRepository('AppBundle:ServersSessions')->getCurrentSessions($server['id'],$server['type']);
            }
            return count($sessions) / $server['max_sessions'];
        }
        return 1;
    }

    public function videoDuration($videoPath)
    {
        $ffprobe = $this->container->getParameter("ffprobe.bin");
        $command = "$ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 -sexagesimal $videoPath";
        $output = exec($command, $a, $b);
        $aux = explode('.', $output);
        return $aux[0];
    }

    public function getUrl($path)
    {
        $request = $this->container->get('request');
        return $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $path;
    }

    public function dropDirectory($dir)
    {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->dropDirectory("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public function getDataUrl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function encrypt($text, $password) {
        return @openssl_encrypt($text, self::ENCRYPTION_METHOD, $password);
    }

    public function checkStreamsServerStatus($ip){
        $status['nodejs'] = false;
        $status['nginx'] = false;
        
        $serversStatus = $this->sendRequest(Base::ROUTE_SETTINGS_SERVERSTATUS, $ip);       
        $serversStatus = json_decode($serversStatus);    

        if ($serversStatus != NULL) {
            if ($serversStatus->success === 200) {
                $status['nodejs'] = $serversStatus->nodejs;
                $status['nginx'] = $serversStatus->nginx;
            } 
        } 
        
        return $status;
    }

    public function getStreamsServerOnline(){
        $servers_online = [];
        
        foreach($this->streams_servers as $streams_server){
            $status = $this->checkStreamsServerStatus($streams_server->getServerAddress());

            if($status['nodejs'] != false)
                $servers_online[] = $streams_server;
        }        
        
        return $servers_online;
    }

    public function sendRequest($route, $serverAddress, $data=array(), $method='GET', $file=false)
    {
        $password = md5($this->user->getUsername());
        $apikey = $this->encrypt($this->user->getEmail(), $password);
        
        switch($method){
            case "GET":
                $url = "http://$serverAddress/iptvtranscoderclient/$route?password=$password&apikey=$apikey";     
            break;
           
            case "POST":
                $url = "http://$serverAddress/iptvtranscoderclient/$route";
                $data['password'] = $password; 
                $data['apikey'] = $apikey;
            break;           
        }
     
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);  
        
        if($file){
            //$data['file'] = curl_file_create($file['tmp_name'], $file['type'], $file['name']);
            curl_setopt($ch, CURLOPT_HEADER, "Content-type: multipart/form-data");      
        }
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);		
       
        $response = curl_exec($ch);      
        curl_close($ch);

        return $response;			
    }

    public function ega123Obfuscated($em){                
        $key = '';
        $license = '';
        $mac = '';
        $ip = '';       
        $empty = true;
        
        $licenseLocal = $em->getRepository('AppBundle:License')->findOneById('1');

        $licenseLocal = new License();
        
        if($licenseLocal){
            $empty = false;

            $key = $licenseLocal->getCode();
            $license = $licenseLocal->getLicense();
            $mac = $licenseLocal->getUuid();
        }
        
        // $output = array(); 
        // exec("export http_proxy='http://eduardo_hlg:Ega123@192.168.2.8:3128' & curl -s http://checkip.dyndns.org/ | grep -o \"[[:digit:].]\\+\"", $output);       

        // if($output){
        //   $ip = $output[0];      
        // }      

        // $ch = curl_init();
        // $url = "https://www.besttranscoder.com/index.php?controller=licenses&action=comprovate&key=".$key."&licence=".$license."&mac=".$mac."&ip=".$ip."&productid=9";
              
        // curl_setopt ($ch, CURLOPT_URL, $url);
        // curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 50);
        // curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
        // // curl_setopt($ch, CURLOPT_PROXY, 'http://eduardo_hlg:Ega123@192.168.2.8:3128'); 
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    
        // curl_setopt($ch, CURLOPT_VERBOSE,1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        // $data = curl_exec($ch);
        // curl_close($ch);
      
        // if($data){
		// 	$license = json_decode(stripslashes($data));

        //     if($license->Valid){
        //         $date1 = new \DateTime($license->EndedAt);
        //         $date2 = new \DateTime("now");

        //         if($date1 >= $date2)
        //           return json_encode(array('code'=>1));
                
        //         return json_encode(array('code'=>2, 'msg'=>'License expired'));
        //     }
        //     else{
        //         return json_encode(array('code'=>2, 'msg'=>$empty?'':$license->Reason));
        //     }               
        // }
        
        return json_encode(array('code'=>1));
    }
}