<?php

namespace Dmcl\AppBundle\Services;


use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Entity\VodPackage;
use Dmcl\AppBundle\Entity\Vod;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Process\Process;


/**
 * Description of Transcoder
 *
 * @author dmanuelcl@gmail.com
 */
class Transcoder
{

    private $container;
    private $ffmpegBin;
    private $settings;

    function __construct(ContainerInterface $container)
    {        
        $this->container = $container;
        $this->ffmpegBin = $this->container->getParameter("ffmpeg.bin");

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $this->settings = $em->getRepository("AppBundle:Settings")->findAll();                
    }

    /**
     * @param $command
     * @param Channel $model Channel
     * @param bool $re_start
     * @return int
     */
    function execute(&$command, $model, $re_start = false)
    {
        $pidsDir = $this->container->getParameter("kernel.logs_dir");

        if (!$model) {
            return 404; //no model
        }

        $modelIdentificator = $model->getId();
        $path = $pidsDir . '/pids/' . $modelIdentificator;
       
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        
        $success = $this->getCommand($command, $model);
        //print_r($command);die;
        if ($success == 400) {
            return 400;//bad request
        }

        @file_put_contents($pidsDir . '/pids/' . $modelIdentificator . "/" . $modelIdentificator . ".cmd", $command); //for dev
        $log_dir = $this->container->getParameter("web.dir") . "/logs/" . $modelIdentificator . ".log";
         if (file_exists($log_dir)) {
            rename($log_dir, $this->container->getParameter("web.dir") . "/logs/" . $modelIdentificator . '_' . date('Y-m-d-H-i-s') . ".log");
        }       

        $commandSuff = " > $log_dir 2>&1 & echo $!  > $pidsDir/pids/" . $modelIdentificator . "/" . $modelIdentificator . ".pid";
        $command .= $commandSuff;

        //$commandSuff = " > $log_dir ";
        //$command = str_replace('-f mpegts - | vlc', '-f mpegts - ' . $commandSuff . ' | vlc', $command);
        
        if (!is_file("$pidsDir/pids/" . $modelIdentificator . "/" . $modelIdentificator . ".pid")) {
            file_put_contents("$pidsDir/pids/" . $modelIdentificator . "/" . $modelIdentificator . ".pid", "");
        }

        $pid = @file_get_contents("$pidsDir/pids/" . $modelIdentificator . "/" . $modelIdentificator . ".pid");
        $pid = str_replace("\n", "", $pid);
        $pid += 0;
        if (file_exists("/proc/$pid") && $pid != "") {
            return 226;//already running
        }

        exec("$command", $output);

        sleep(3);

        $pid = @file_get_contents("$pidsDir/pids/" . $modelIdentificator . "/" . $modelIdentificator . ".pid");
        $pid = str_replace("\n", "", $pid);
        $pid += 0;
       
        if (file_exists("/proc/$pid") && $pid != "") {;
            return 200;
        } else {
            if (!$re_start) {
                exec("rm -R -f  $pidsDir/pids/$modelIdentificator");
            }
            return 500;
        }
    }

    /**
     * @param $command
     * @param Channel $model
     * @return int
     */
    function getCommand(&$command, $model)
    { 
        $protocol = $model->getProtocol();
        $crf = "";        

        if($model->getCrf() >= 0){
            $crf = "-crf {$model->getCrf()}";
        }        

        if($protocol != 'rtmp'){
             $videoCodec = array(               
                'h264' => 'libx264',
                'h265' => 'hevc -x265-params crf=25',
                'h263' => 'h263p',
                'copy' => 'copy'
            );

            $audioCodec = array(
                'mp2' => 'mp2',
                'aac' => 'aac -strict -2',
                'vorbis' => 'libvorbis',
                'mp3' => 'libmp3lame',
                'copy' => 'copy'
            );
        }
        else{
             $videoCodec = array(
                'theora' => 'libtheora',
                'mpeg2' => 'mpeg2video',
                'mpeg4' => 'mpeg4',
                'h264' => 'libx264',
                'H265' => 'libx265',
                'flv' => 'flv',
                'copy' => 'copy'
            );

            $audioCodec = array(
                'mp2' => 'mp2',
                'aac' => 'aac -strict experimental',
                'vorbis' => 'libvorbis',
                'mp3' => 'libmp3lame',
                'copy' => 'copy'
            );
        }
        
        $v_codec = empty($model->getVideoCodec()) ? 'copy' : trim($model->getVideoCodec());
        $a_codec = empty( $model->getAudioCodec()) ? 'copy' :  trim($model->getAudioCodec());

        $v_codec = strtolower($v_codec);
        $a_codec = strtolower($a_codec);

        $video_codec = $videoCodec[$v_codec];
        $audio_codec = $audioCodec[$a_codec];       

        $http_proxy = '';
        if(!empty($model->getUrlProxy())){
            $urlProxy =  trim($model->getUrlProxy());
            if(!empty($urlProxy)){
                $http_proxy = " -http_proxy " . $urlProxy;
            }
        }
        
        if(!empty($model->getUserAgent())){
            $http_proxy .= " -user_agent \"" . trim($model->getUserAgent()) . "\" ";
        }

        $video_bitfilter = '';
        if($model->getAllowVideoBitStream()){           
            if($video_codec == 'h265')
                $video_bitfilter = " -bsf:v hevc_mp4toannexb ";
            else
                $video_bitfilter = " -bsf:v h264_mp4toannexb ";
        }

        $audio_bitfilter = '';
        if($model->getAllowAudioBitStream()){
            if($audio_codec == 'aac'){
                $audio_bitfilter = " -bsf:a aac_adtstoasc ";
            }
        }

        $codec_options = '';
        //if($model->getKeepOriginal()){
            if($model->getKeepOriginalType() == 'both'){
                $codec_options = " $crf -vcodec copy $video_bitfilter -acodec copy $audio_bitfilter ";
            } elseif ($model->getKeepOriginalType() == 'only_video'){
                $codec_options = " $crf -vcodec copy $video_bitfilter -acodec $audio_codec $audio_bitfilter ";
            } elseif ($model->getKeepOriginalType() == 'only_audio'){
                $codec_options = " $crf -vcodec $video_codec $video_bitfilter -acodec copy $audio_bitfilter ";
            }
         else {
            $codec_options = " -vcodec $video_codec $video_bitfilter -acodec $audio_codec $audio_bitfilter ";
        }

        $allowText = $model->getAllowTextOverlay();
        $text = trim($model->getTextOverlaySource());
        $fontsize = trim($model->getTextOverlaySize());
        $fontcolor = trim($model->getTextOverlayColor());
        $textleft = trim($model->getTextOverlayLeft());
        $texttop = trim($model->getTextOverlayTop());

        $allowWaterMark = $model->getAllowWaterMark();
        $waterPosition = $model->getWaterPosition();
        $waterImage = $model->getWaterImage();
        if ($allowWaterMark) {
            $uploadDir = $this->container->getParameter("upload.dir");
            $waterMark = " -vf \"movie=$uploadDir/$waterImage [watermark];[in][watermark] overlay=$waterPosition [out]\"";
        } else {
            $waterMark = "";
        }

        if ($allowText) {
            $font = $this->container->getParameter("web.dir") . "/bundles/assets/themes/default/dist/fonts/DejaVuSerif.ttf";
            $fontoverlay = " -vf drawtext=\"fontfile=$font:text='$text':fontsize=$fontsize:fontcolor=$fontcolor:x=$textleft:y=$texttop\"";
        } else {
            $fontoverlay = "";
        }

        $preset = "";
        $profile = "";
//        if (array_key_exists($video_codec, $videoCodec) && $videoCodec[$video_codec] == "libx264") {
        if ($video_codec == "libx264") {
            if(!empty($model->getPreset()) && $model->getPreset() != 'none'){
                $preset = " -preset:v " . $model->getPreset();
            }
            if(!empty($model->getProfile()) && $model->getProfile() != 'none'){
                $profile = " -profile:v " . $model->getProfile();
            }
        }

        if ($model->getTranscoderLib() == "vlc") {
            return $this->vlc($command, $model);
        }

        $_sourceStream = $model->getSource();
        $rtsp = "";
        if (strpos($model->getSource(), "mms://") !== false) {
            $_sourceStream = str_replace("mms://", 'rtsp://', $model->getSource());
            $rtsp = "-f rtsp";
        }

        $init = " ";
        if(($protocol != 'http') && ($protocol != 'rtsp')){
            if (strpos($model->getSource(), "udp://") !== false) {
                $init = "-f mpegts";
            }
        }        

        $output = "";
        if (strpos($model->getSource(), "rtsp://") !== false) {
            $rtsp = "-f rtsp";
        }

        if(($protocol != 'http') && ($protocol != 'rtsp')){
             if (strpos($model->getSource(), "http://") !== false) {
                if (substr($model->getSource(), strlen($model->getSource()) - 3, strlen($model->getSource())) == ".ts") {
                    $rtsp = "-f mpegts";
                }
            }
        }       

        /*if (strpos($model->getLive(), "rtsp://") !== false) {
            $output = " -f rtsp ";
        }*/

        $tracks = $model->getAudioPids();

        $audioMap = '';
        if ($tracks) {
            if ($model->getOnlyAudio()) {
                $audioMap = '0:' . $tracks;
            } else {
                $audioMap = '-map 0:a:' . $tracks;
            }
        }

        $pids = $model->getVideoPids();
        if ($pids) {
            $videoMap = '-map 0:v:' . $pids;
        } else {
            $videoMap = '';
        }

        if(($protocol != 'http') && ($protocol != 'rtsp')){
            if (strpos($model->getLive(), "udp://") !== false) {
                $output = "-f mpegts";
                if (!(strpos($model->getSource(), "udp://") !== false)) {
                    $videoMap = '';
                    $audioMap = '';
                }
            }

            if (strpos($model->getLive(), "http://") !== false) {
                $output = "-f mpegts";
            }
        }

        if (strpos($model->getLive(), "rtp://") !== false) {
            $output = "-f rtp";
        }
        if (strpos($model->getLive(), "rtmp://") !== false) {
            $output = "-f flv";
        }

        $_outputurl = trim($model->getLive());

        /*if($protocol == 'http'){
            $_outputurl = '-f mpegts - | vlc -I dummy - --sout "#std{mux=ts,access=http,dst=' . str_replace('http://', '', $_outputurl) . '}"';
        }

        if($protocol == 'rtsp'){
            $_outputurl = '-f mpegts - |vlc -I dummy - --sout="#rtp{mp4a-latm,sdp=' . $_outputurl . '}"';
        }*/

        /*if($protocol == 'http'){
            $_outputurl = '-f mpegts - | vlc -I dummy - --sout "#std{mux=ts,access=http,dst=' . str_replace('http://', '', $_outputurl) . '}" vlc://quit';
        }

        if($protocol == 'rtsp'){
            $_outputurl = '-f mpegts - | vlc -I dummy - --sout="#rtp{mp4a-latm,sdp=' . $_outputurl . '}" vlc://quit';
        }*/

        if($protocol == 'http'){
            $_outputurl = '-f mpegts - | cvlc -vvv - --sout-mux-caching=1000 --no-sout-display-audio --sout="#std{mux=ts,access=http,dst=' . str_replace('http://', '', $_outputurl) . '}" :sout-keep vlc://quit';
        }

        if($protocol == 'rtsp'){
            $_outputurl = '-f mpegts - | cvlc -vvv - --sout-mux-caching=1000 --no-sout-display-audio --sout="#rtp{mp4a-latm,sdp=' . $_outputurl . '}" :sout-keep vlc://quit';
        }
                                                                                                                                              
        $_fps = trim($model->getFps());
        $_vbitrate = trim($model->getBitRate());
        $_width = trim($model->getWidth());
        $_height = trim($model->getHeight());
        $_channels = trim($model->getAudioMode());
        $_samplerate = trim($model->getAudioSamplerate());

//        if (($video_codec && $videoCodec[$video_codec] == "flv") && ($audio_codec && $audioCodec[$audio_codec] == "libmp3lame") && $_samplerate != "44100") {
        if ($video_codec == "flv" && $audio_codec == "libmp3lame" && $_samplerate != "44100") {
            $_samplerate = "44100";
        }

        $resolution = $_width . "x" . $_height;

        $deinterlace = "";
        if ($model->getDeinterlace()) {
            $deinterlace = " -deinterlace ";
        }

        $logo = $this->container->getParameter("web.dir") . "/bundles/assets/themes/default/dist/img/no-image-available.png";
        if (is_file($model->getLogo())) {
            $logo = $this->container->getParameter("web.dir") . "/uploads/" . $model->getLogo();
        }

        $timeshift = "";
        if (($aux = $model->getTimeShitf()) != null && $aux > 0) {
            $timeshift = "-itsoffset $aux";
        }

        $audiobit = $model->getAllowAudioBitStream();
        $videobit = $model->getAllowVideoBitStream();

        //todo -- Cuando $audiobit o $videobit toman valor 1 el comando da problemas, por eso los puse vacios
        $audiobit = "";
        $videobit = "";

        $frameDrop = "";
        if($model->isFrameDrop()){
            $frameDrop = "-frame_drop_threshold 4";
        }
        $reconnect = "";
        if($model->isReconnect()){
            $reconnect = "-reconnect 1 -reconnect_at_eof 1 -reconnect_streamed 1 -reconnect_delay_max 2";
        }
        $threadQueue = "";
        if($model->isThreadQueue()){
            $threadQueue = "-thread_queue_size 1024";
        }

        /*if ($model->getProtocol() == "hls" && strtolower($model->getVideoCodec()) == 'h265') {
            $folder_channel = "/tmp/streamshls/channel_{$model->getId()}";
            if (!is_dir($folder_channel)) {
                mkdir($folder_channel, '0777', true);
            }
            $segment_list = "{$folder_channel}/index.m3u8";
            $_outputurl = "{$folder_channel}/%03d.ts";

            $command = $this->ffmpegBin . " $rtsp $frameDrop $reconnect $threadQueue -i \"$_sourceStream\" $preset -g 30 $crf $audioMap -acodec $audio_codec -vf yadif -max_alloc 100000000 -vf \"fps=$_fps\" -r $_fps -b:v $_vbitrate" . "k -bufsize ". $_vbitrate . "k -maxrate ". $_vbitrate . "k -ar $_samplerate -ac $_channels  -strict -2 $video_bitfilter -async 1 -sn -ab 64k -muxrate 10M -s $resolution $videoMap -codec:v hevc -shortest -f ssegment -segment_format mpegts -segment_list_type m3u8 -segment_list \"$segment_list\" -segment_list_flags +live -segment_wrap 6 -segment_time 10 \"$_outputurl\"";
        } else {*/
            //todo -- Si esta la opcion( -bsf:a aac_adtstoasc ) y en acodec no es AAC el comando explota
			
			if(($protocol != 'http') && ($protocol != 'rtsp'))
               $_outputurl = '"'.$_outputurl.'"';
         
			
        if ($model->getOnlyAudio()) {
                $re = $model->getKeepOriginal() ? "-re" : "";
                $command = $this->ffmpegBin . " $http_proxy -loop 1 $reconnect $threadQueue -i \"$logo\" $re $init $rtsp $timeshift -i \"$_sourceStream\" -r 30 -b:v 2500k $audioMap -acodec $audio_codec  -ab 384k $output $audiobit $videobit \"$_outputurl\"";
            } else if ($model->getKeepOriginal()) {
//            $command = $this->ffmpegBin . " $http_proxy -rtbufsize 1500M -vsync passthrough -frame_drop_threshold 4 -re $init $rtsp $timeshift -i \"$_sourceStream\" $deinterlace $fontoverlay $preset -g 125 $audioMap -acodec copy $videoMap -codec:v copy -ar $_samplerate -ac $_channels -crf 23 -strict -2 -async 1 -sn -ab 64k -bsf:a aac_adtstoasc $waterMark $output \"$_outputurl\"";
                $command = $this->ffmpegBin . " $http_proxy -rtbufsize 1500M -vsync passthrough $frameDrop $reconnect $threadQueue -re $init $rtsp $timeshift -i \"$_sourceStream\" $deinterlace $fontoverlay $preset -g 125 $audioMap $videoMap $codec_options -ar $_samplerate -ac $_channels -strict -2 -async 1 -sn -ab 64k $waterMark $output $_outputurl";
				//\"$_outputurl\"";
            } else {
//            $command = $this->ffmpegBin . " $http_proxy -rtbufsize 1500M  $init $rtsp $timeshift -i \"$_sourceStream\" $deinterlace $fontoverlay $preset -g 125 $audioMap -acodec $audioCodec[$audio_codec] $videoMap -codec:v $videoCodec[$video_codec] $profile  -r $_fps -b:v " . $_vbitrate . "k -ar $_samplerate -ac $_channels -crf 23 -strict -2 -async 1 -sn -ab 64k -s $resolution $waterMark $output $audiobit $videobit \"$_outputurl\"";
                $command = $this->ffmpegBin . " $http_proxy -rtbufsize 1500M $frameDrop $reconnect $threadQueue $init $rtsp $timeshift -i \"$_sourceStream\" $deinterlace $fontoverlay $preset -g 125 $audioMap $videoMap $codec_options $profile  -r $_fps -b:v " . $_vbitrate . "k -ar $_samplerate -ac $_channels -strict -2 -async 1 -sn -ab 64k -s $resolution $waterMark $output $audiobit $videobit $_outputurl";
				//\"$_outputurl\"";
            }
        //}  
        // /usr/share/besttranscoder/app/../libs/ffmpeg/ffmpeg  -rtbufsize 1500M        -i "http://localhost/besttranscoder/videos/test.mp4"    -preset:v ultrafast -g 125    -vcodec libx264  -acodec aac       -b:v 800k -ar 44100 -ac 2 -strict -2 -async 1 -sn -ab 64k -s 470x380  -f flv   "rtmp://127.0.0.1:1936/streams/channel_1500769177087"       
        
        return 200;
    }

    function ffmpegHls(&$command, $model, $audio_codec, $fontoverlay, $watermark, $preset, $profile)
    {

        $_sourceStream = $model->getSource();
        if (strpos($model->getSource(), "mms://") !== false) {
            $_sourceStream = str_replace("mms://", 'rtsp://', $model->getSource());
        }
        $rtsp = "";
        if (strpos($model->getSource(), "rtsp://") !== false) {
            $rtsp = "-f rtsp";
//            $rtsp = "-f rtsp -rtsp_transport tcp";
        }
        if (strpos($model->getSource(), "http://") !== false) {
            if (substr($model->getSource(), strlen($model->getSource()) - 3, strlen($model->getSource())) == ".ts") {
                $rtsp = "-f mpegts";
            }
        }

        $path = $this->container->getParameter("web.dir") . '/hls/';
        $id = $model->getId();

        $_channels = trim($model->getAudioMode());
        $_samplerate = trim($model->getAudioSamplerate());

        $_fps = trim($model->getFps());
        $_vbitrate = trim($model->getBitRate());
        $_width = trim($model->getWidth());
        $_height = trim($model->getHeight());
        $resolution = $_width . "x" . $_height;

        $deinterlace = "";
        if ($model->getDeinterlace()) {
            $deinterlace = " -deinterlace ";
        } else {
            $deinterlace = "";
        }


        $tracks = $model->getAudioPids();
        if ($tracks) {
            $audioMap = '-map 0:' . $tracks;
        } else {
            $audioMap = '';
        }

        $pids = $model->getVideoPids();
        if ($pids) {
            $videoMap = '-map 0:' . $pids;
        } else {
            $videoMap = '';
        }


        $logo = $this->container->getParameter("web.dir") . "/bundles/assets/themes/default/dist/img/no-image-available.png";
        if (is_file($model->getLogo())) {
            $logo = $this->container->getParameter("web.dir") . "/uploads/" . $model->getLogo();
        }

        $hlsName = $model->nameToHls();

        if (($aux = $model->getTimeShitf()) != null && $aux > 0) {
            $timeshift = "-itsoffset $aux";
        } else {
            $timeshift = "";
        }

        if ($model->getOnlyAudio()) {
            $re = $model->getKeepOriginal() ? "-re" : "";
            $command = $this->ffmpegBin . " -loop 1  -i \"$logo\" $re $rtsp $timeshift -i \"$_sourceStream\" -r 30 -b:v 2500k $audioMap -acodec $audio_codec  -ab 384k -f ssegment  -segment_format mpegts -segment_list_type m3u8 -segment_list  \"$path$hlsName\" -segment_list_flags +live -segment_wrap 6 -segment_time 10 \"" . $path . "channel_$id%03d.ts\"";
        } else if ($model->getKeepOriginal()) {
            $command = $this->ffmpegBin . " -re $rtsp $timeshift -i \"$_sourceStream\" -analyzeduration 2147483647 -probesize 2147483647 $deinterlace $fontoverlay -strict -2 -async 1 -sn -codec:v copy $audioMap -codec:a copy -ar 41000 -f ssegment -segment_format mpegts -segment_list_type m3u8 -segment_list  \"$path$hlsName\" -segment_list_flags +live -segment_wrap 6 -segment_time 10 $watermark \"" . $path . "channel_$id%03d.ts\"";
        } else {
            $command = $this->ffmpegBin . " $rtsp $timeshift -i \"$_sourceStream\" $deinterlace $fontoverlay -analyzeduration 2147483647 -probesize 2147483647 -ar $_samplerate -ac $_channels -crf 23 -strict -2 -async 1 -sn $preset $videoMap -codec:v libx264 $audioMap -acodec $audio_codec $profile -r $_fps -b:v " . $_vbitrate . "k -s $resolution -f ssegment  -segment_format mpegts -segment_list_type m3u8 -segment_list  \"$path$hlsName\" -segment_list_flags +live -segment_wrap 6 -segment_time 10 $watermark \"" . $path . "channel_$id%03d.ts\"";
        }
        return 200;
    }

    function vlc(&$command, $model)
    {

        $_channels = trim($model->getAudioMode());
        $_samplerate = trim($model->getAudioSamplerate());

        $_fps = trim($model->getFps());
        $_vbitrate = trim($model->getBitRate());
        $_width = trim($model->getWidth());
        $_height = trim($model->getHeight());


        $_sourceStream = trim($model->getSource());
        $_outputurl = trim($model->getLive());

        $_outputurl = str_replace("http://", "", $_outputurl);


        $allowText = $model->getAllowTextOverlay();
        $text = trim($model->getTextOverlaySource());
        $fontsize = trim($model->getTextOverlaySize());
        $fontcolor = trim($model->getTextOverlayColor());
        $fontcolor = @hexdec($fontcolor);
        $textleft = trim($model->getTextOverlayLeft());
        $texttop = trim($model->getTextOverlayTop());

        $allowWaterMark = $model->getAllowWaterMark();
        $waterPosition = trim($model->getWaterPosition());
        $waterP = 5;
        switch ($waterPosition) {
            case "10:10":
                $waterPosition = 5;
                break;
            case "main_w-overlay_w-10:10":
                $waterPosition = 6;
                break;
            case "10:main_h-overlay_h-10":
                $waterPosition = 9;
                break;
            case "(main_w-overlay_w-10):(main_h-overlay_h-10)":
                $waterPosition = 10;
                break;
        }
        $waterImage = $model->getWaterImage();

        $uploadDir = $this->container->getParameter("upload.dir");
        if ($allowWaterMark) {
            $waterMark = "sfilter=logo{file=$uploadDir/$waterImage,position=$waterPosition}, ";
//            $waterMark = " --sub-filter=logo --logo-file /usr/share/webtranscoder/web/assets/upload/$waterImage --logo-opacity 128 --logo-position $waterP";
        } else {
            $waterMark = "";
        }


        if ($allowText) {
            $fontoverlay = "{soverlay,sfilter=marq{marquee='" . $text . "',color=$fontcolor,x=$textleft,y=$texttop,size=$fontsize,opacity=255}, ";
        } else {
            $fontoverlay = "{";
        }
        if ($allowText && $allowWaterMark) {
            $fontoverlay = "{soverlay,sfilter={marq{marquee='" . $text . "',color=$fontcolor,x=$textleft,y=$texttop,size=$fontsize,opacity=255}:logo{file=$uploadDir/$waterImage,position=$waterPosition}}, ";
            $waterMark = "";
        }

        $deinterlace = "";
        if ($model->getDeinterlace()) {
            $deinterlace = " ,deinterlace ";
        }

        $_profile = $model->getProfile();
        $_preset = $model->getPreset();
        $profile_preset = ",venc=x264{preset=$_preset,profile=$_profile}";

        $tracks = $model->getAudioPids();
        if ($this) {
            $tracks = "--audio-track=$tracks --sout-transcode-audio-sync";
        }
        //HTTP
        if (trim($model->getProtocol()) == "http") {
            if (trim($model->getAudioVideoCodec()) == "theora+vorbis") {
                if ($model->getKeepOriginal()) {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate, width=$_width,height=$_height, acodec=vorb,ab=128,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=ogg,dst=$_outputurl}\" vlc://quit";
                } else {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=theo,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height, acodec=vorb,ab=128,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=ogg,dst=$_outputurl}\" vlc://quit";
                }
            } else
                if (trim($model->getAudioVideoCodec()) == "wmv") {
                    if ($model->getKeepOriginal()) {
                        $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2   \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate, width=$_width,height=$_height, acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=asf,dst=$_outputurl}\" vlc://quit";
                    } else {
                        $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2   \":sout=#transcode$fontoverlay $waterMark vcodec=WMV2,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height, acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=asf,dst=$_outputurl}\" vlc://quit";
                    }
                } else
                    if (trim($model->getAudioVideoCodec()) == "flv") {
                        if ($model->getKeepOriginal()) {
                            $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2   \":sout=#transcode$fontoverlay $waterMark scale=1,vb=$_vbitrate, width=$_width,height=$_height, acodec=mp4a,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=ffmpeg{mux=flv},dst=$_outputurl} --ttl=3\" vlc://quit";
                        } else {
                            $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2   \":sout=#transcode$fontoverlay $waterMark vcodec=FLV1,fps=$_fps,scale=1,vb=$_vbitrate, width=$_width,height=$_height, acodec=mp4a,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=ffmpeg{mux=flv},dst=$_outputurl} --ttl=3\" vlc://quit";
                        }
                    } else
                        if (trim($model->getAudioVideoCodec()) == "webm") {
                            if ($model->getKeepOriginal()) {
                                $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2   \":sout=#transcode$fontoverlay $waterMark vcodec=VP80,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height, acodec=vorb,ab=128,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=webm,dst=$_outputurl}\" vlc://quit";
                            } else {
                                $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2   \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate, width=$_width,height=$_height, acodec=vorb,ab=128,channels=$_channels,samplerate=$_samplerate $deinterlace}:http{mux=webm,dst=$_outputurl ,audio-sync}\" vlc://quit";
                            }
                        } else
                            if (trim($model->getAudioVideoCodec()) == "h264+mp3") {
                                if ($model->getKeepOriginal()) {
                                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate $profile_preset,width=$_width,height=$_height, acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:http{mux=ts,dst=$_outputurl}\" vlc://quit";
                                } else {
                                    $command = "cvlc -vvv \"$_sourceStream\" --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264 $profile_preset,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height, acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace}:http{mux=ts,dst=$_outputurl}\" vlc://quit";
                                }
                            } else
                                if (trim($model->getAudioVideoCodec()) == "h264+aac") {
                                    if ($model->getKeepOriginal()) {
                                        $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate $profile_preset, width=$_width,height=$_height, acodec=mp4a,ab=128,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:http{mux=ts,dst=$_outputurl}\" vlc://quit";
                                    } else {
                                        $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264 $profile_preset,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height, acodec=mp4a,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:http{mux=ts,dst=$_outputurl}\" vlc://quit";
                                    }
                                }
//            if (trim($model->getAudioVideoCodec()) == "H264 + MP2") {
//                if ($model->getKeepOriginal()) {
//                    $command = "cvlc -vvv \"$_sourceStream\" --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate $profile_preset, width=$_width,height=$_height, acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate $profile $deinterlace}:http{mux=ts,dst=$_outputurl}\" vlc://quit";
//                } else {
//                    $command = "cvlc -vvv \"$_sourceStream\" --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264 $profile_preset,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height, acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate $profile $deinterlace}:http{mux=ts,dst=$_outputurl}\" vlc://quit";
//                }
//            }
        } else if (trim($model->getProtocol()) == "rtmp") {
            if (trim($model->getAudioVideoCodec()) == "h264+mp3") {
                if ($model->getKeepOriginal()) {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate $profile_preset, width=$_width,height=$_height,acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                } else {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264 $profile_preset,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height,acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                }
            } else if (trim($model->getAudioVideoCodec()) == "flv+mp3") {
                if ($model->getKeepOriginal()) {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate, width=$_width,height=$_height,acodec=mp3,ab=128,channels=$_channels,samplerate=44100 $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                } else {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=FLV1,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height,acodec=mp3,ab=128,channels=$_channels,samplerate=44100 $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                }
            } else if (trim($model->getAudioVideoCodec()) == "h264+mp2") {
                if ($model->getKeepOriginal()) {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate $profile_preset, width=$_width,height=$_height,acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                } else {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264 $profile_preset,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height,acodec=mp3,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                }
            } else if (trim($model->getAudioVideoCodec()) == "h264+aac") {
                if ($model->getKeepOriginal()) {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate $profile_preset, width=$_width,height=$_height,acodec=mp4a,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                } else {
                    $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264 $profile_preset,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height,acodec=mp4a,ab=128,channels=$_channels,samplerate=$_samplerate  $deinterlace ,audio-sync}:std{access=rtmp,mux=ffmpeg{mux=flv},dst= $_outputurl}\" vlc://quit";
                }
            }
        } else if (trim($model->getProtocol()) == "rtsp") {
            $acodec = "mpga";
            if (trim($model->getAudioVideoCodec()) == "h264+aac") {
                $acodec = "mp4a";
            }
            if ($model->getKeepOriginal()) {
                $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate, width=$_width,height=$_height,acodec=$acodec,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:rtp{sdp=$_outputurl}\" vlc://quit";
            } else {
                $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264,vb=$_vbitrate,fps=$_fps, width=$_width,height=$_height,acodec=$acodec,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:rtp{sdp=$_outputurl}\" vlc://quit";
            }
        } else if (trim($model->getProtocol()) == "hls") {
            /*$path = $this->container->getParameter("web.dir"). '/hls/';

            $id = $model->getId();
            $dest = $path . "channel_$id-########.ts";
            $hlsName = $model->nameToHls();
            $apachePath = $path . $hlsName;
            $indexURL = "channel_$id-########.ts";

            $acodec = "mp4a";
            if (trim($model->getAudioVideoCodec()) == "h264+mp3") {
                $acodec = "mpga";
            }
            if ($model->getKeepOriginal()) {
                $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vb=$_vbitrate,venc=x264{preset=$_preset,aud,profile=$_profile,level=30,keyint=30,ref=1},aenc=ffmpeg{aac-profile=low},acodec=$acodec,ab=32,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:std{access=livehttp{seglen=10,delsegs=true,numsegs=5, index=$apachePath,index-url=$indexURL}, mux=ts{use-key-frames},dst=$dest}\" vlc://quit";
            } else {
                $command = "cvlc -vvv \"$_sourceStream\" $tracks --sout-avcodec-strict=-2  \":sout=#transcode$fontoverlay $waterMark vcodec=h264,vb=$_vbitrate,fps=$_fps,venc=x264{preset=$_preset,aud,profile=$_profile,level=30,keyint=30,ref=1},aenc=ffmpeg{aac-profile=low},acodec=$acodec,ab=32,channels=$_channels,samplerate=$_samplerate $deinterlace ,audio-sync}:std{access=livehttp{seglen=10,delsegs=true,numsegs=5, index=$apachePath,index-url=$indexURL}, mux=ts{use-key-frames},dst=$dest}\" vlc://quit";
            }*/
        }
        return 200;
    }

    /**
     * Funcion utilizada para iniciar el transcoder a un vodpackage
     * @param VodPackage $vodPackage
     * @return bool
     * @throws \Exception
     */
    public function startTranscoderVodPackage(VodPackage $vodPackage)
    {
        if ($vodPackage->getAllowTranscoder()) {
            /**
             * Inicialmente verifico si el transcoder esta corriendo.
             */
            if ($vodPackage->getTranscoderRunning()) {
                return false;
            } else {
                /**
                 * Creo el fichero que sera utilizado para ejecutar el transcoder.
                 * Antes de crear el fichero verifico que no exista
                 */
                $transcoderBasePath = $this->container->getParameter('transcoder_vodpack') . "/" . $vodPackage->getId();
                if (file_exists($transcoderBasePath)) {
                    $this->container->get('app.util.services')->dropDirectory($transcoderBasePath);
                }
                mkdir($transcoderBasePath);

                $transcoderSh = $transcoderBasePath . "/transcoder.sh";
                touch($transcoderSh);

                file_put_contents($transcoderSh, "#!/bin/sh");
                file_put_contents($transcoderSh, "\n", FILE_APPEND);
                file_put_contents($transcoderSh, "echo \"Transcoder started\";", FILE_APPEND);
                file_put_contents($transcoderSh, "\n", FILE_APPEND);

                /**
                 * El fichero transcoder.stop es utilizado para saber cuando es que tengo que
                 * terminar el proceso de transcoder
                 */
                if ($vodPackage->getRepeatTranscoderProcess()) {
                    $transcoderStop = $transcoderBasePath . "/transcoder.stop";
                    file_put_contents($transcoderSh, "until [ -e $transcoderStop ]", FILE_APPEND);
                    file_put_contents($transcoderSh, "\n", FILE_APPEND);
                    file_put_contents($transcoderSh, "do", FILE_APPEND);
                    file_put_contents($transcoderSh, "\n", FILE_APPEND);
                }

                /**
                 * Inicializo todos los parametros necesarios para crear el command del transcoder
                 */
                $size = $vodPackage->getWidth() . 'x' . $vodPackage->getHeight();

                $fps = $vodPackage->getFps();
                $bitrate = $vodPackage->getBitrate() . 'k';

                $videoList = "";
                $filterComplex = "";
                $totalVideos = 0;

                $vodPublicPath = $this->container->getParameter("app.vod.public_path");
                foreach ($vodPackage->getVods() as $key => $vod) {
                    $videoPath = $vod->getSources();
                    foreach ($videoPath as $key1 => $source) {
                        $path = $source->getVideo();
                        $videoList .= " -vsync passthrough -frame_drop_threshold 4 -thread_queue_size 1024 -i \"$vodPublicPath/$path\"";
                        $filterComplex .= "[$key:v:0] [$key:a:0] ";
                        $totalVideos++;
                    }
                }

                $em = $this->container->get("doctrine.orm.default_entity_manager");
                $settings = $em->getRepository("AppBundle:Settings")->findAll();
                $output = "rtmp://" . $settings[0]->getServerAddress() . ":" . $settings[0]->getBroadcastRTMPPort()
                    . "/streams/pack_" . $vodPackage->getId();

                $command = $this->ffmpegBin . "$videoList -filter_complex \"$filterComplex concat=n=$totalVideos:v=1:a=1 [v] [a]\" -map \"[v]\" -map \"[a]\" -analyzeduration 0 -ar 44100 -tune zerolatency -preset:v medium -codec:v libx264 -crf 15 -acodec aac -strict -2 -r $fps -profile:v high -g 30 -pix_fmt yuv420p -b:v $bitrate -s $size -bsf:v h264_mp4toannexb -f flv \"$output\";";

                file_put_contents($transcoderSh, $command, FILE_APPEND);
                file_put_contents($transcoderSh, "\n", FILE_APPEND);

                if ($vodPackage->getRepeatTranscoderProcess()) {
                    file_put_contents($transcoderSh, "done", FILE_APPEND);
                    file_put_contents($transcoderSh, "\n", FILE_APPEND);
                }

                file_put_contents($transcoderSh, "echo \"Transcoder stoped\";", FILE_APPEND);
                file_put_contents($transcoderSh, "\n", FILE_APPEND);
                file_put_contents($transcoderSh, "exit 0;", FILE_APPEND);

                /**
                 * Ejecuto el proceso de transcoder para el paquete y
                 * guardo en un log la salida del transcoder
                 */
                $transcoderLog = $transcoderBasePath . "/transcoder.log";
                $transcoderPid = $transcoderBasePath . "/transcoder.pid";
                $commandSh = "sh $transcoderSh > $transcoderLog 2>&1 & echo $! > $transcoderPid";
                exec($commandSh);

                //Espero 3 segundos para dar tiempo a que se cree el file .m3u8
                sleep(3);

                if (file_exists($transcoderPid) && ($pid = file_get_contents($transcoderPid))) {
                    $vodPackage->setTranscoderRunning(true);
                    $vodPackage->setTranscoderPid($pid);
                    $live = "http://" . $settings[0]->getServerAddress() . ":" . $settings[0]->getBroadcastHTTPPort()
                        . "/streamshls/pack_" . $vodPackage->getId() . "/index.m3u8";
                    $vodPackage->setLive($live);
                    $vodPackage->setStartTime(new \DateTime());
                    $em->persist($vodPackage);
                    $em->flush();
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            throw new \Exception("The transcoder is not allowed for this vod package");
        }
    }

    /**
     * @param VodPackage $vodPackage
     * @return bool Funcion utilizada para detener el transcoder a un vodpackage
     * Funcion utilizada para detener el transcoder a un vodpackage
     */
    public function stopTranscoderVodPackage(VodPackage $vodPackage)
    {
        /**
         * Inicialmente verifico si el transcoder esta detenido.
         */
        if (!$vodPackage->getTranscoderRunning()) {
            return false;
        } else {
            $transcoderBasePath = $this->container->getParameter('transcoder_vodpack') . "/" . $vodPackage->getId();
            if (file_exists($transcoderBasePath)) {
                /**
                 * Creo el fichero utilizado para que el file transcoder.sh termine su ejecucion,
                 * en caso que este marcada la opcion repeat
                 */
                if ($vodPackage->getRepeatTranscoderProcess()) {
                    $transcoderStop = $transcoderBasePath . "/transcoder.stop";
                    if (!file_exists($transcoderStop)) {
                        touch($transcoderStop);
                    }
                }

                /**
                 * Elimino la folder donde se almacenan los files generados por el transcoder
                 */
                $vodPackageStorage = $this->container->getParameter('vod_package_hls_destination') . "/" . $vodPackage->getId();
                if (file_exists($vodPackageStorage)) {
                    $command = "rm -Rf $vodPackageStorage";
                    exec($command);
                }

                /**
                 * Actualizo la entidad
                 */
                $em = $this->container->get('doctrine.orm.entity_manager');
                $vodPackage->setTranscoderRunning(false);
                $vodPackage->setTranscoderPid(null);
                $vodPackage->setLive(null);
                $em->persist($vodPackage);
                $em->flush();
                return true;
            }
            return false;
        }
    }

    /**
     * Funcion utilizada para iniciar el transcoder a un vod
     * @param Vod $vod
     * @return bool
     * @throws \Exception
     */
    public function startTranscoderVod(Vod $vod)
    {

        /**
         * Creo el fichero que sera utilizado para ejecutar el transcoder.
         * Antes de crear el fichero verifico que no exista
         */
        $transcoderBasePath = $this->container->getParameter('transcoder_vod') . "/" . $vod->getId();
        if (file_exists($transcoderBasePath)) {
            $this->container->get('app.util.services')->dropDirectory($transcoderBasePath);
        }
        mkdir($transcoderBasePath);

        $transcoderSh = $transcoderBasePath . "/transcoder.sh";
        touch($transcoderSh);

        file_put_contents($transcoderSh, "#!/bin/sh");
        file_put_contents($transcoderSh, "\n", FILE_APPEND);
        file_put_contents($transcoderSh, "echo \"Transcoder started\";", FILE_APPEND);
        file_put_contents($transcoderSh, "\n", FILE_APPEND);
        /**
         * Inicializo todos los parametros necesarios para crear el command del transcoder
         */
        $sources = $vod->getSources();
        $new_sources = array();
        foreach ($sources as $source) {
            $path = $source->getVideo();
            $path_parts = pathinfo($path);
            $output = $path_parts['dirname'] . '/' . $vod->getId() . '-' . md5($path_parts['filename']) . 'mp4';
            $new_sources[] = $output;
            $command = $this->ffmpegBin . " -i \"$path\" -acodec aac -strict experimental -vcodec libx264 -s 720x560 -y \"$output\";";
            file_put_contents($transcoderSh, $command, FILE_APPEND);
        }

        file_put_contents($transcoderSh, "\n", FILE_APPEND);
        file_put_contents($transcoderSh, "echo \"Transcoder stoped\";", FILE_APPEND);
        file_put_contents($transcoderSh, "\n", FILE_APPEND);
        file_put_contents($transcoderSh, "exit 0;", FILE_APPEND);

        /**
         * Ejecuto el proceso de transcoder para el paquete y
         * guardo en un log la salida del transcoder
         */
        $transcoderLog = $transcoderBasePath . "/transcoder.log";
        $transcoderPid = $transcoderBasePath . "/transcoder.pid";
        $commandSh = "(sh $transcoderSh > $transcoderLog 2>&1 & echo $! > $transcoderPid) &";

        exec($commandSh);
        sleep(3);

        if (file_exists($transcoderPid) && ($pid = file_get_contents($transcoderPid))) {
            return array('pid' => $pid);
        } else {
            return false;
        }
    }

    /**
     * Funcion utilizada para iniciar el transcoder a un vod
     * @param Vod $vod
     * @return bool
     * @throws \Exception
     */
    public function startTranscoderVodSource(/*Vod $entity,*/
        $transcoding_jobs = array())
    {
        /**
         * Creo el fichero que sera utilizado para ejecutar el transcoder.
         * Antes de crear el fichero verifico que no exista
         */
        $transcoderBasePath = $this->container->getParameter('transcoder_vod');
        $appConsole = rtrim($this->container->get('kernel')->getRootDir(), '/\\') . '/console';

        //if (file_exists($transcoderBasePath)) {
        //    $this->container->get('app.util.services')->dropDirectory($transcoderBasePath);
        //}
        //mkdir($transcoderBasePath);
        $vod_id = 1/*$entity->getId()*/
        ;
        $base_path = $transcoderBasePath . "/transcode." . $vod_id . ".src";
        $transcoderSh = $base_path . ".sh";
        $transcoderLog = $base_path . ".log";
        $transcoderPid = $base_path . ".pid";
        touch($transcoderSh);
        touch($transcoderLog);
        touch($transcoderPid);
        file_put_contents($transcoderSh, "#!/bin/sh\n");
        file_put_contents($transcoderSh, "echo $$ > $transcoderPid\n", FILE_APPEND);
        file_put_contents($transcoderSh, "echo \"Transcoder started\"\n", FILE_APPEND);
        /**
         * Inicializo todos los parametros necesarios para crear el command del transcoder
         */
        $videos = "";

        foreach ($transcoding_jobs as $transcoding_job) {
            $jobs = explode(';', $transcoding_job);
            $source = $jobs[0];

            if (file_exists($source)) {
                $output = $jobs[1];
                //$command = $this->ffmpegBin . " -i \"$source\" -acodec aac -strict experimental -vcodec libx264 -s 720x560 -y \"$output\" -progress /usr/share/besttranscoder/web/transcoder/vod/test.txt";
                $command = $this->ffmpegBin . " -i \"$source\" -acodec aac -strict experimental -vcodec libx264 -s 720x560 -y \"$output\"";
                //$command = $this->ffmpegBin ."  -i /home/adrian/Vídeos/boty.mp4 -acodec aac -strict experimental -vcodec libx264 -s 720x560 -y /home/adrian/Vídeos/boty2.mp4 1> /usr/share/besttranscoder/web/transcoder/vod/test.txt";
                //shell_exec($command);
                //file_put_contents($transcoderSh, $command . "\n", FILE_APPEND);

                file_put_contents($transcoderSh, $command . " 1> $transcoderLog 2>&1\n", FILE_APPEND);
                file_put_contents($transcoderSh, "code=$?\n", FILE_APPEND);
                //file_put_contents($transcoderSh, "test \$code -eq 0 && rm -f \"$source\" && rm -f $base_path.*\n", FILE_APPEND);
                $videos = $videos . ' ' . $output;
            }
        }
        file_put_contents($transcoderSh, "echo \"Updating sources metadata\"\n", FILE_APPEND);
        //todo: ejecutar comando php para actualizar los sources
        file_put_contents($transcoderSh, "php $appConsole vod:sources:update $videos --vod=$vod_id\n", FILE_APPEND);
        file_put_contents($transcoderSh, "echo \"Transcoder stoped\"\n", FILE_APPEND);
        file_put_contents($transcoderSh, "exit \$code", FILE_APPEND);

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

    /**
     * @param $command
     * @param $model
     *
     * @return int
     */
    function vlcHttp(&$command,Channel $model) {
        //vlc -vvv "Input URL " --sout0=”#standard{access=http,mux=ts,dst=<server ip>:< HTTP Base PORT>/Channel_<id>.ts}" vlc://quit;
        $_liveurl = trim($model->getSource());
        $_outputurl = trim($model->getLive());
        $_outputurl = str_replace(array("http://","rtmp://","mms://", 'rtsp://','udp://'), "", $_outputurl);
//        $_outputurlArr = explode(":", $_outputurl);
//        $ip = $_outputurlArr[0];
//        $entity = $this->em->getRepository('AppBundle:Config')->findOneBy(array());
//        $httpPort = $entity->getHttpPort();
//        $name = "channel_{$model->getId()}.ts";
//        $command = "vlc -vvv \"$_liveurl\" --sout=\"#standard{access=http,mux=ts,dst={$ip}:{$httpPort}/{$name}}\" :sout-keep vlc://quit;";
        $command = "vlc -vvv \"$_liveurl\" --sout=\"#standard{access=http,mux=ts,dst={$_outputurl}.ts}\" :sout-keep vlc://quit;";
        return 1;
    }
}
