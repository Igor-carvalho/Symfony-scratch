<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Command;

/**
 * Description of RecordProgrammesCommand
 *
 * @author dani
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface

    ;

class RecordProgrammesCommand extends ContainerAwareCommand {

    protected $container;

    protected function configure() {
        $this->setName('besttranscoder:record:programmes');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->container = $this->getContainer();
        $em = $this->container->get('doctrine')->getManager();

        $start = new \DateTime("now");
        $start = new \DateTime($start->format("Y-m-d H:i:00"));


        $log_path = "/tmp/record.log";
        $log_data = @file_get_contents($log_path) or "";

        $log_data.="\nComprobando para grabar -> ".$start->format("Y-m-d H:i:00")."\n";

        $programmes = $em->getRepository('AppBundle:Programme')->findBy(array("start"=>$start));
        if ($programmes) {
            $log_data.=count($programmes)." encontrados\n";
            foreach ($programmes as $programme) {
                if($programme->getChannel()->isAllowRecord()){
                    echo "procesando programa: ".$programme->getTitle()."\n";
                    $log_data.="procesando programa ".$programme->getTitle()."\n";
                    $duration = $programme->getDuration();
                    $__path = $programme->getDay()->format("Y")."/".$programme->getDay()->format("m")."/".$programme->getDay()->format("d");
                    $_path = $this->container->getParameter('programmes.dir').$__path;
                    if(!is_dir($_path)){
                        @exec("mkdir -p $_path");
                    }
                    $init = "";
                    $channel = $programme->getChannel()->getChannel();
                    $_liveurl = $channel->getLive();
                    if (strpos($_liveurl, "udp://") !== false) {
                        $init = "-f mpegts";
                    }

                    $rtsp = "";
                    if (strpos($_liveurl, "mms://") !== false) {
                        $_liveurl = str_replace("mms://", 'rtsp://', $_liveurl);
                        $rtsp = "-f rtsp";
                    }

                    if (strpos($_liveurl, "rtsp://") !== false) {
                        $rtsp = "-f rtsp";
                    }
                    if (strpos($channel->getLive(), "http://") !== false) {
                        if (substr($channel->getLive(), strlen($channel->getLive()) - 3, strlen($channel->getLive())) == ".ts") {
                            $rtsp = "-f mpegts";
                        }
                    }

                    if($programme->getChannel()->getEpg()->getServerRecorder()){

                        $datos = array(
                            'cmd' => "-rtbufsize 1500M $init $rtsp -i \"$_liveurl\" -analyzeduration 0 -async 2  -b:v 300k -ac 2 -vcodec libx264 -r 25 -acodec aac -strict experimental -t $duration -ar 44100 -bsf:a aac_adtstoasc -s 720x540 -y ",
                            "url" =>  $programme->getSource());

                        $postdata = http_build_query($datos);

                        $opts = array('http' =>
                            array(
                                'method' => 'POST',
                                'header' => 'Content-type: application/x-www-form-urlencoded',
                                'content' => $postdata
                            )
                        );
                        $context = stream_context_create($opts);

                        @file_get_contents("http://".$programme->getChannel()->getEpg()->getServerRecorder()."/besttranscoder-recorder/index.php", false, $context);

                    }else{
                        $folder = $programme->getDay()->format("Y-m-d");
                        $folder= preg_split("/-/", $folder);
                        $_path = $this->container->getParameter('programmes.dir') ."/".$folder[0]."/".$folder[1]."/".$folder[2];
                        $_path= str_replace("/../","/",$_path);
                        if(!is_dir($_path)){
                            @exec("mkdir -p $_path");
                        }
                        $name = $programme->getSource();
                        $recorder = $this->container->getParameter("kernel.root_dir")."/../libs/checker/record.js";
                        $log_data.="ejecutando cmd: nodejs $recorder \"$_liveurl\" \"".$programme->getStartAtXMLTV()."\" \"".$programme->getEndAtXMLTV()."\" \"$name\" \"$_path\"";
                        file_put_contents($log_path, $log_data);
                        // exec("nodejs /usr/share/iptv/app/check-live/record.js \"$init\" \"$rtsp\" \"$_liveurl\" \"".$programme->getTimeFMT()."\" \"".$programme->getTimeToFMT()."\" \"$name\" \"$_path\" \"".$url.$this->container->getParameter('_programmes.dir').substr($programme->getUrl(),0,strrpos($programme->getUrl(),"/"))."\"> /tmp/my.log 2>&1 &");
                        exec("nodejs $recorder \"$_liveurl\" \"".$programme->getStartAtXMLTV()."\" \"".$programme->getEndAtXMLTV()."\" \"$name\" \"$_path\" >> /tmp/record.log 2>&1 &");
                    }
                }
            }
        }else{
            print "No se encontraron programas para grabar\n";
            $log_data.="No se encontraron programas para grabar\n";
            file_put_contents($log_path, $log_data);
        }
        echo "Ok";
    }
}
