<?php
/**
 * Created by PhpStorm.
 * User: yordan
 * Date: 12/3/16
 * Time: 3:15 AM
 */

namespace Dmcl\AppBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Process\Process;

class DownloadVodService
{
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function run() {
        $transcoderBasePath = $this->container->getParameter('transcoder_vod');
        $appConsole = rtrim($this->container->get('kernel')->getRootDir(), '/\\') . '/console';
        $vod_id = 1/*$entity->getId()*/;
        $base_path = $transcoderBasePath . "/download." . $vod_id . ".src";
        $transcoderSh = $base_path . ".sh";
        $transcoderLog = $base_path . ".log";
        $transcoderPid = $base_path . ".pid";
        touch($transcoderSh);
        touch($transcoderLog);
        touch($transcoderPid);
        file_put_contents($transcoderSh, "#!/bin/sh\n");
        file_put_contents($transcoderSh, "echo $$ > $transcoderPid\n", FILE_APPEND);
        file_put_contents($transcoderSh, "echo \"Download started\"\n", FILE_APPEND);
//        $command = "wget http://127.0.0.1:8989/src.461a8804f679cc8d427c5e80a4f09b2b.mp4 -O /usr/share/besttranscoder/web/uploads/vod/video.mp4";
        $command="php $appConsole app:download_vod --url http://127.0.0.1:8989/src.461a8804f679cc8d427c5e80a4f09b2b.mp4 --id 1";
        file_put_contents($transcoderSh, $command . " 1> $transcoderLog 2>&1\n", FILE_APPEND);
        file_put_contents($transcoderSh, "code=$?\n", FILE_APPEND);

//        file_put_contents($transcoderSh, "echo \"Updating sources metadata\"\n", FILE_APPEND);
//        //todo: ejecutar comando php para actualizar los sources
//        file_put_contents($transcoderSh, "php $appConsole vod:sources:update $videos --vod=$vod_id\n", FILE_APPEND);
        file_put_contents($transcoderSh, "echo \"Downloaded stoped\"\n", FILE_APPEND);
        file_put_contents($transcoderSh, "exit \$code", FILE_APPEND);
//        exec('sh /home/yordan/download.sh > /dev/null 2>&1 &');
        /**
         * Ejecuto el proceso de transcoder para el paquete y
         * guardo en un log la salida del transcoder
         */

        $commandSh = "sh $transcoderSh > $transcoderLog &";
        exec($commandSh);
        sleep(1);

        if (file_exists($transcoderPid) && ($pid = file_get_contents($transcoderPid))) {
            return true;
        } else {
            return false;
        }
    }
}