<?php

namespace Dmcl\StbBundle\Controller;

use Dmcl\StbBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StbController extends Controller
{
    function __construct()
    {
        $locale_allowed = array(
            "en","ru","pl","el","uk"
        );
        $lang= "en";
        if(isset($_COOKIE['stb_lang'])){
            $lang=$_COOKIE['stb_lang'];
            $lang = substr($lang, 0, 2);
            if(!in_array($lang,$locale_allowed)){
                $lang= "en";
            }
        }
        $this->initLocale($lang);
    }


    public  function handshakeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $mac = $request->cookies->get("mac");
        $user =  null;
        $accessToken =  array(
            "token"=> uniqid(),
            "class"=>null,
            "id"=>-1
        );

        $userClasses = $this->container->getParameter("stb_mag")["user_class"];
        foreach ( $userClasses as $userClass) {
            $user = $em->getRepository($userClass)->findByMacForStb($mac);
            if($user){
                $user = $user[0];
                $userClasses = $userClass;
                break;
            }else{
                $user = $em->getRepository($userClass)->findByIpForStb($request->getClientIp());
                if($user){
                    $user = $user[0];
                    $userClasses = $userClass;
                    break;
                }
            }
        }

        if($user){
            $accessToken =  array(
                "token"=> uniqid(),
                "class"=>$userClasses,
                "id"=>$user->getId()
            );
        }
        $request->getSession()->set("access_token",$accessToken);
        $js=array(
            "token"=>$request->getSession()->get("access_token")["token"]
        );
        return $this->response($js,"");
    }

    public function get_localizationAction(Request $request){
        require_once str_replace("Controller/../","/",__DIR__ . '/../Resources/locale/lang/stb.php');
        return $this->response($words,"");
    }

    public function get_modulesAction(Request $request){
        $js= array(
            "all_modules"=>["tv","apps","epg","epg.simple","vclub","ex","olltv","megogo","ivi","vidimax","tvzavr","zoombytv","pomogator","youtube","widget.audio","game.lines","game.memory","game.sudoku","picasa","cityinfo","horoscope","anecdote","game.mastermind","internet"],
            "switchable_modules"=>["infoportal"],
            "disabled_modules"=>["infoportal"],
            "restricted_modules"=>[],
            "template"=>"digital"
        );
        return $this->response($js,"");
    }

    public function get_profileAction(Request $request){
        $js =  array(
            'status' => 1,
            'show_channel_logo_in_preview' => 1,
            'msg' => 'Your STB not authorized.<br/> Call the provider.',
            'block_msg' => _('Your STB not authorized.<br/> Call the provider.')
        );
        $em = $this->getDoctrine()->getManager();
        if($request->getSession()->get("access_token")){
            $access_token = $request->getSession()->get("access_token");
            $token = isset($access_token["token"])?$access_token["token"]:null;
            if($token==$request->get("bearer-token")&&$token!=null){
                $id = isset($access_token["id"])?$access_token["id"]:null;
                if($id && $id>=0){
                    if(isset($access_token["class"])){
                        $user = $em->getRepository($access_token["class"])->findOneBy(array("id"=>$id,"enabled"=>true));
                        if(!$user){
                            $js["status"]=1;
                        }else{
                            $js=[];
                            $js["status"]=0;
                            $js["show_channel_logo_in_preview"]=1;
                            $js["account_page_by_password"]="";
                            $js["additional_services_on"]=1;
                            $js["allow_subscription_from_stb"]="";
                            $js["allowed_stb_types"]= ['mag200', 'mag245', 'mag250', 'mag254', 'mag255', 'mag260', 'mag270', 'mag275', 'aurahd', 'wr320'];
                            $js["allowed_stb_types"]= ['mag245', 'mag250', 'mag254', 'mag255', 'mag270', 'mag275', 'aurahd'];
                            $js["always_enabled_subtitles"]="";
                            $js["aspect"]=16;
                            $js["audio_out"]=1;
                            $js["bright"]=200;
                            $js["cas_additional_params"]=[];
                            $js["cas_hw_descrambling"]=0;
                            $js["cas_ini_file"]="";
                            $js["cas_params"]=null;
                            $js["cas_type"]=0;
                            $js["city_id"]=0;
                            $js["comment"]=null;
                            $js["contrast"]=127;
                            $js["country"]="";
                            $js["created"]=null;
                            $js["default_led_level"]=10;
                            $js["default_locale"]="ru_RU.utf8";
                            $js["default_timezone"]="";
                            $js["demo_video_url"]="";
                            $js["deny_720p_gmode_on_mag200"]=1;
                            $js["display_menu_after_loading"]="";
                            $js["enable_arrow_keys_setpos"]="";
                            $js["enable_buffering_indication"]=1;
                            $js["enable_connection_problem_indication"]=1;
                            $js["enable_service_button"]=1;
                            $js["enable_stream_error_logging"]="";
                            $js["enable_stream_losses_logging"]="";
                            $js["enable_tariff_plans"]=1;
                            $js["epg_update_time_range"]="0.2";
                            $js["external_payment_page_url"]="";
                            $js["fading_tv_retry_timeout"]=1;
                            $js["fav_itv_on"]=0;
                            $js["fname"]=$user->getName();
                            $js["hd"]=1;
                            $js["hd_content"]=0;
                            $js["hdmi_event_reaction"]=1;
                            $js["hw_version"]="1.7-BD-00";
                            $js["id"]=$user->getId();
                            $js["image_version"]=216;
                            $js["invert_channel_switch_direction"]="";
                            $js["ip"]="";
                            $js["is_moderator"]=false;
                            $js["just_started"]=0;
                            $js["keep_alive"]=new \DateTime("now");
                            $js["kinopoisk_rating"]="";
                            $js["lang"]="";
                            $js["last_active"]=null;
                            $js["last_change_status"]=null;
                            $js["last_itv_id"]=1;
                            $js["last_start"]=new \DateTime("now");
                            $js["last_watchdog"]=null;
                            $js["locale"]="en_GB.utf8";
                            $js["logarithm_volume_control"]="";
                            $js["login"]=$user->getEmail();
                            $js["ls"]="";
                            $js["mac"]= $request->cookies->get("mac");
                            $js["main_notify"]=1;
                            $js["max_local_recordings"]=10;
                            $js["name"]=$user->getName();
                            $js["now_playing_content"]="";
                            $js["now_playing_link_id"]=0;
                            $js["now_playing_start"]=null;
                            $js["now_playing_streamer_id"]=0;
                            $js["now_playing_streamer_id"]=0;
                            $js["now_playing_start"]= null;
                            $js["now_playing_streamer_id"]= "0";
                            $js["now_playing_type"]= "0";
                            $js["num_banks"]= "1";
                            $js["openweathermap_city_id"]= "0";
                            $js["operator_id"]= "0";
                            $js["parent_password"]= "0000";
                            $js["pass"]= "";
                            $js["password"]= "";
                            $js["phone"]= "";
                            $js["plasma_saving"]= "0";
                            $js["plasma_saving_timeout"]= "600";
                            $js["play_in_preview_by_ok"]= null;
                            $js["play_in_preview_only_by_ok"]= true;
                            $js["playback_buffer_bytes"]= "0";
                            $js["playback_buffer_size"]= "0";
                            $js["playback_limit"]= 0;
                            $js["pri_audio_lang"]= "";
                            $js["pri_subtitle_lang"]= "";
                            $js["record_max_length"]= 180;
                            $js["rtsp_flags"]= "0";
                            $js["rtsp_type"]= "4";
                            $js["saturation"]= "127";
                            $js["screensaver_delay"]= "10";
                            $js["sec_audio_lang"]= "";
                            $js["sec_subtitle_lang"]= "";
                            $js["show_after_loading"]= "";
                            $js["show_channel_logo_in_preview"]= "1";
                            $js["show_purchased_filter"]= "";
                            $js["show_tv_channel_logo"]= "1";
                            $js["show_tv_only_hd_filter_option"]= "";
                            $js["sname"]= "";
                            $js["standby_led_level"]= "90";
                            $js["status"]= "0";
                            $js["stb_lang"]= "en";
                            $js["stb_type"]= "MAG250";
                            $js["storage_name"]= "";
                            $js["storages"]= [];
                            $js["store_auth_data_on_stb"]= false;
                            $js["strict_stb_type_check"]= "";
                            $js["tariff_plan_id"]= "0";
                            $js["test_download_url"]= "";
                            $js["tester"]= false;
                            $js["time_last_play_tv"]= null;
                            $js["time_last_play_video"]= null;
                            $js["timeslot"]= 120;
                            $js["timeslot_ratio"]= 1;
                            $js["timezone_diff"]= -21600;
                            $js["ts_action_on_exit"]= "no_save";
                            $js["ts_buffer_use"]= "cyclic";
                            $js["ts_delay"]= "on_pause";
                            $js["ts_enable_icon"]= "1";
                            $js["ts_enabled"]= "0";
                            $js["ts_max_length"]= "3600";
                            $js["ts_path"]= "";
                            $js["tv_archive_continued"]= "";
                            $js["tv_channel_default_aspect"]= "fit";
                            $js["tv_playback_retry_limit"]= "0";
                            $js["tv_quality"]= "high";
                            $js["tv_quality_filter"]= "";
                            $js["update_url"]= "";
                            $js["updated"]= null;
                            $js["use_embedded_settings"]= "1";
                            $js["user_roles"]= "ROLE_USER";
                            $js["verified"]= "1";
                            $js["version"]= "ImageDescription: 0.2.16-r2; ImageDate: Fri Oct 25 17:28:41 EEST 2013; PORTAL version: iptv; API Version: ";
                            $js["video_clock"]= "Off";
                            $js["video_out"]= "rca";
                            $js["video_rating"]= null;
                            $js["volume"]= "100";
                            $js["watchdog_timeout"]= "120";
                            $js["web_proxy_exclude_list"]= "";
                            $js["web_proxy_host"]= "";
                            $js["web_proxy_pass"]= "";
                            $js["web_proxy_port"]= "";
                            $js["web_proxy_user"]= "";
                        }
                    }else{
                        $js["status"]=2;
                    }
                }else{
                    $js["status"]=2;
                }
            }else{
                $js["status"]=1;
            }

        }
        return $this->response($js,"");

    }

    public function do_authAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $username = $request->get("login");
        $pass = $request->get("password");
        $user = null;

        $userClasses = $this->container->getParameter("stb_mag")["user_class"];
        foreach ( $userClasses as $userClass) {
            $user = $em->getRepository($userClass)->findOneBy(array("username"=>$username,"enabled"=>true));
            if($user){
                $userClasses = $userClass;
                break;
            }
        }

        if($user){
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            if($encoder->encodePassword($pass, $user->getSalt()) == $user->getPassword()){
                $accessToken =  array(
                    "token"=> uniqid(),
                    "class"=>$userClasses,
                    "id"=>$user->getId()
                );
                $request->getSession()->set("access_token",$accessToken);
                $js=array(
                    "token"=>$request->getSession()->get("access_token")["token"]
                );
                return $this->response($js,"");
            }
        }
        return new Response(null,200);
    }

    public function do_auth_codeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $code = $request->get("code");
        $user = null;

        $userClasses = $this->container->getParameter("stb_mag")["user_class"];
        foreach ( $userClasses as $userClass) {
            $user = $em->getRepository($userClass)->findOneBy(array("code"=>$code,"enabled"=>true));
            if($user){
                $userClasses = $userClass;
                break;
            }
        }
        if($user){
            $accessToken =  array(
                "token"=> uniqid(),
                "class"=>$userClasses,
                "id"=>$user->getId()
            );
            $request->getSession()->set("access_token",$accessToken);
            $js=array(
                "token"=>$request->getSession()->get("access_token")["token"]
            );
            return $this->response($js,"");
        }

        return new Response(null,200);
    }

    private  function initLocale($lang) {

        setlocale(LC_MESSAGES, $lang);
        putenv('LC_MESSAGES=' . $lang);

        if (!function_exists('bindtextdomain')) {
            throw $this->createNotFoundException("php-gettext extension not installed.");
        }

        if (!function_exists('locale_accept_from_http')) {
            throw $this->createNotFoundException("php-intl extension not installed.");
        }

        bindtextdomain('stb', str_replace("Controller/../","/",__DIR__ . '/../Resources/locale'));
        textdomain('stb');
        bind_textdomain_codeset('stb', 'UTF-8');
    }

}

