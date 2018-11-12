<?php

namespace Dmcl\AppBundle\Twig\Extension;

use Dmcl\AppBundle\Entity\BillingConfiguration;
use Dmcl\AppBundle\Entity\Settings;
use Dmcl\AppBundle\Entity\VodPackage;
use Dmcl\AppBundle\Entity\Vod;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Dmcl\AppBundle\Controller\BaseController;

/**
 * Class UtilsExtension
 *
 * @package Dmcl\AppBundle\Twig\Extension
 * @author dani
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class UtilsExtension extends \Twig_Extension
{

    private $em;
    private $container;
    protected $tokenStorage;

    function __construct(EntityManager $em, ContainerInterface $container, TokenStorage $tokenStorage)
    {
        $this->em = $em;
        $this->container = $container;
        $this->tokenStorage = $tokenStorage;
    }

    public function getName()
    {
        return "besttranscoder_utils";
    }

    public function getFunctions()
    {
        return array(
            'project_name' => new \Twig_Function_Method($this, '_getProjectName'),
            'style_layout' => new \Twig_Function_Method($this, '_getStyleLayout'),
            'style_color' => new \Twig_Function_Method($this, '_getStyleColor'),
            'selected_bouquet' => new \Twig_Function_Method($this, 'selectedBouquet'),
            'selected_format' => new \Twig_Function_Method($this, 'selectedFormat'),
            'company_phone' => new \Twig_Function_Method($this, '_getCompanyPhone'),
            'company_address' => new \Twig_Function_Method($this, '_getCompanyAddress'),
            'company_email_support' => new \Twig_Function_Method($this, '_getCompanyEmailSupport'),
            'get_favico' => new \Twig_Function_Method($this, '_getFavIco'),
            'get_player_logo' => new \Twig_Function_Method($this, '_getPlayerLogo'),
            'get_hls' => new \Twig_Function_Method($this, '_getHls'),
            'get_rtmp' => new \Twig_Function_Method($this, '_getRtmp'),
            'get_rtsp' => new \Twig_Function_Method($this, '_getRtsp'),
            'get_udp' => new \Twig_Function_Method($this, '_getUdp'),
            'get_http' => new \Twig_Function_Method($this, '_getHttp'),
            'get_refresh' => new \Twig_Function_Method($this, '_getRefresh'),
            'get_time_zone' => new \Twig_Function_Method($this, '_getTimeZone'),
            'billing_config' => new \Twig_Function_Method($this, '_getBillingConfig'),
            'build_cart' => new \Twig_Function_Method($this, '_buildCart'),
            'get_gateways' => new \Twig_Function_Method($this, '_getGateways'),
            'file_get_contents' => new \Twig_Function_Method($this, 'fileGetContents'),
            'preg_match' => new \Twig_Function_Method($this, 'pregmatch'),
            'nodejs_port' => new \Twig_Function_Method($this, 'nodeJsPort'),
            'nginx_port' => new \Twig_Function_Method($this, 'nginxPort'),
            'rtmp_port' => new \Twig_Function_Method($this, 'rtmpPort'),
            'dash_port' => new \Twig_Function_Method($this, 'dashPort'),
            'get_server_nginx' => new \Twig_Function_Method($this, 'getServerNginx'),
            'get_rtmp_server_address' => new \Twig_Function_Method($this, 'getRtmpServerAddress'),
            'get_hls_server_address' => new \Twig_Function_Method($this, 'getHlsServerAddress'),
            'settings' => new \Twig_Function_Method($this, 'settings'),
            'get_serveraddress' => new \Twig_Function_Method($this, 'getServerAddress'),
            'get_country_by_code' => new \Twig_Function_Method($this, 'get_country_by_code'),
            'user_connection_status' => new \Twig_Function_Method($this, 'userConnectionStatus')
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('get_currency', array($this, '_getCurrency')),
            new \Twig_SimpleFilter('genre_name', array($this, 'genre_name')),
            new \Twig_SimpleFilter('get_country', array($this, '_getCountry')),
            new \Twig_SimpleFilter('get_language', array($this, '_getLanguage')),
            new \Twig_SimpleFilter('json_decode', array($this, '_jsonDecode')),
            new \Twig_SimpleFilter('price_humanize', array($this, '_priceHumanize')),
            new \Twig_SimpleFilter('get_url', array($this, 'getUrl')),
            new \Twig_SimpleFilter('format_video_list_element', array($this, 'formatVideoListElement'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('preg_match', array($this, 'pregmatch')),
            new \Twig_SimpleFilter('is_url', array($this, 'isUrl')),
            new \Twig_SimpleFilter('expiredPeriod', array($this, 'expiredPeriod')),
            new \Twig_SimpleFilter('remaining', array($this, 'remaining')),
            new \Twig_SimpleFilter('getMac', array($this, 'getMac')),
            new \Twig_SimpleFilter('convert', array($this, 'convert')),
            new \Twig_SimpleFilter('get_time', array($this, 'getTime')),
            new \Twig_SimpleFilter('showIssues', array($this, 'showIssues')),
            new \Twig_SimpleFilter('format_bytes', array($this, 'formatBytes')),
            new \Twig_SimpleFilter('errorBoxMsgFilter', array($this, 'errorBoxMsgFilter'), array('is_safe' => array('html')))
        );
    }

    public function _getGateways()
    {
        $wategays = $this->em->getRepository("AppBundle:Gateways")->findByEnabled(true);
        if (!$wategays) {
            $wategays = array();
        }
        return $wategays;
    }

    public function genre_name($id)
    {
       $entity = $this->em->getRepository('AppBundle:VodGenres')->find($id);

       if(!$entity) 
         throw $this->createNotFoundException('Unable to find VodGenres entity.');

       $name = $entity->getName();

       return $entity->getName();
    }

    public function fileGetContents($val)
    {
        return file_get_contents($val);
    }

    public function pregmatch($key)
    {
        if (strpos($key, 'https://image.tmdb.org/t/p/original') !== false) {
            return true;
        }
        return false;
    }

    function _buildCart()
    {
        $shopCart = $this->container->get("request")->getSession()->get("cart_products");
        if (!is_array($shopCart)) {
            $shopCart = array();
        }
        $productsSupported = array(
            "channel" => $this->container->get("translator")->trans("cart.types.channel"),
            "channels_package" => $this->container->get("translator")->trans("cart.types.channels_package"),
            "vod" => $this->container->get("translator")->trans("cart.types.vod"),
            "vod_package" => $this->container->get("translator")->trans("cart.types.vod_package"),
        );

        return $this->container->get("templating")->render("@App/themes/default/Store/cart.html.twig", array("cart" => $shopCart, "types" => $productsSupported));

    }

    function _priceHumanize($price)
    {
        //$billingConfig = $this->_getBillingConfig();
        return $price ? $price/* . " " . $billingConfig->getCurrency()*/ : $this->container->get('translator')->trans('pages.channels_for_sale.free');
    }

    function _jsonDecode($value)
    {
        return json_decode($value);
    }

    function _getCurrency($currency)
    {
        \Locale::setDefault($this->container->get("request")->getLocale());
        return Intl::getCurrencyBundle()->getCurrencyName($currency);
    }

    function _getCountry($country)
    {
        \Locale::setDefault($this->container->get("request")->getLocale());
        return Intl::getRegionBundle()->getCountryName($country);
    }

    function _getLanguage($language)
    {
        \Locale::setDefault($this->container->get("request")->getLocale());
        return Intl::getLanguageBundle()->getLanguageName($language);
    }

    function _getProjectName()
    {
        $token = $this->tokenStorage->getToken();
       
		$gs = $this->em->getRepository("AppBundle:Settings")->find(1);
        
        if (!$gs) {
            return "Best Transcoder 2";
        }

        return $gs->getServerName();
    }

    function _getStyleLayout()
    {
        $token = $this->tokenStorage->getToken();

        $gs = $this->em->getRepository("AppBundle:Settings")->find(1);

        return $gs->getStyleLayout();
    }

    function _getStyleColor()
    {
        $token = $this->tokenStorage->getToken();

        $gs = $this->em->getRepository("AppBundle:Settings")->find(1);

        return $gs->getStyleColor();
    }

    function selectedBouquet($id, $selecteds)
    {
        foreach($selecteds as $select){
            if($select == $id){
                echo 'selected';
                return;
            }
        }

        echo '';
    }

    function _getBillingConfig()
    {
        $token = $this->tokenStorage->getToken();
        // $bc = $this->em->getRepository("AppBundle:BillingConfiguration")->findOneByUser($token->getUser()->getId());
        $bc = $this->em->getRepository("AppBundle:BillingConfiguration")->findOneByUser(1);

        if (!$bc) {
            if (!$bc) {
                if($this->container->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')){
                    $bc = new BillingConfiguration();
                    $bc->setCurrency("EUR");
                    $bc->setSalesAddress("address");
                    $bc->setSalesEmail("sales@domain.com");
                    $bc->setUser($token->getUser()->getId());

                    $this->em->persist($bc);
                    $this->em->flush();
                }
                else
                    $bc = $this->em->getRepository("AppBundle:BillingConfiguration")->findOneByUser($token->getUser()->getOwnerId());
            }
        }

        return $bc;
    }

    function _getTimeZone()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser($token->getUser()->getId());

        if (!$gs) {
            return "America/Havana";
        }

        return $gs->getTimeZone();
    }

    function _getCompanyPhone()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser(1);

        if (!$gs) {
            return "-";
        }

        return $gs->getCompanyPhone();
    }

    function _getCompanyAddress()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser(1);

        if (!$gs) {
            return "";
        }

        return $gs->getCompanyAddress();
    }

    function _getCompanyEmailSupport()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser(1);

        if (!$gs) {
            return "-";
        }

        return $gs->getCompanyEmailSupport();
    }

    function _getFavico()
    {
        return "/xtreamcode/favicon.ico";
    }

    function _getPlayerLogo()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser($token->getUser()->getId());

        if (!$gs) {
            return "player.png";
        }

        if (is_file($this->container->getParameter("kernel.root_dir") . "/../web/" . $gs->getPlayerLogo())) {
            return $gs->getPlayerLogo();
        }

        return "player.png";
    }

    function _getHls()
    {
        $token = $this->tokenStorage->getToken();
        $setting = $this->em->getRepository("AppBundle:Settings")->findOneByUser($token->getUser()->getId());
        
        return "http://" . $setting->getServerAddress() . ":" . $setting->getBroadcastHTTPPort() . "/streamshls/";
    }

    function _getUdp()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser($token->getUser()->getId());
        
        $serveraddress = $gs->getServerAddress();
        
        return "udp://$serveraddress:5555/";
    }

    function _getRtmp()
    {                     
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser($token->getUser()->getId());
        
        $rtmpport = $gs->getBroadcastRTMPPort();
        $serveraddress = $gs->getServerAddress();
        
        return "rtmp://$serveraddress:$rtmpport/live/";
    }

    function _getRtsp()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser($token->getUser()->getId());
       
        $serveraddress = $gs->getServerAddress();
        $rtspport = $gs->getRtspPort();
        
        return "rtsp://$serveraddress:$rtspport/live/";
    }

    function _getHttp()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:Settings")->findOneByUser($token->getUser()->getId());
       
        $serveraddress = $gs->getServerAddress();
        
        return "http://$serveraddress/";
    }

    function _getRefresh()
    {
        $token = $this->tokenStorage->getToken();
        $gs = $this->em->getRepository("AppBundle:TranscoderConfig")->findOneBy(
            array(
                'user' => $token->getUser()
        ));

        if (!$gs) {
            return 1;
        }

        return $gs->getTimeForUpdates();
    }

    public function getUrl($path)
    {
        return $this->container->get('app.util.services')->getUrl($path);
    }

    public function formatVideoListElement($id)
    {
        $htmlPlayList = "";
        
        $response = $this->container->get("app.util.services")->sendRequest(BaseController::ROUTE_VODPACKAGES_BYID.$id);
        $response = json_decode($response); 

        $code = $response->success;
                                   
        if($code === 403)
            return $this->continer->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response->msg,
                    'password' =>  $response->data->password,
                    'apikey' =>  $response->data->apikey
                ));
                
        if($code === 500){
            return $this->continer->render('AppBundle:themes/default/Home:error500.html.twig', array(
                'msg' => $response->msg,
                'data' =>  $response->data
            ));
        }          

        $vodPackage = new VodPackage($response->data);

        // $videoStart = $vodPackage->getStartTime();
        // $videoEnd = clone $videoStart;

        foreach ($vodPackage->getVods() as $vod) {
            $response = $this->container->get("app.util.services")->sendRequest(BaseController::ROUTE_VODS_BYID.$vod);
            $response = json_decode($response); 

            $code = $response->success;
                                    
            if($code === 403)
                return $this->continer->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                        'msg' => $response->msg,
                        'password' =>  $response->data->password,
                        'apikey' =>  $response->data->apikey
                    ));
                    
            if($code === 500){
                return $this->continer->render('AppBundle:themes/default/Home:error500.html.twig', array(
                    'msg' => $response->msg,
                    'data' =>  $response->data
                ));
            }          

            $vod = new Vod($response->data);
            /*$duration = explode(':', $vod->getDuration()?: '00:00:00');
            $interval = 'PT' . $duration[0] . 'H' . $duration[1] .'M' . $duration[2] . 'S';
            date_add($videoEnd, new \DateInterval($interval));*/

            $currentDate = new \DateTime();
            //if ($currentDate >= $videoStart && $currentDate < $videoEnd) {
                $labelClass = 'label-primary';
            //} else {
                //$labelClass = 'label-default-no-background';
            //}

            $htmlPlayList .= '<li><span class="label ' . $labelClass . '" style="white-space: normal; font-size: 85%"><i class="fa fa-circle"></i> ' . $vod->getTitle() . '</span></li>';
                //. ' ' .
                //$vod->getDuration() .
                //'<i>' . $this->container->get('translator')->trans('pages.vod_package.playback.start_at') . ' ' . date_format($currentDate, 'h:i') . '</i></span></li>';

            //date_add($videoStart, new \DateInterval($interval));
        }

        return $htmlPlayList;
    }

    public function isUrl($url)
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        return $scheme;
    }

    public function showIssues($issues)
    {
        $tags = '<div>';

        foreach($issues as $issue)
            $tags .= '<span class="badge badge-danger badge-rounded mr-3">'.$issue.'</span>';
          
        $tags .= '</div>';
        
        echo $tags;
    }

    public function expiredPeriod($expDate)
    {
        $date = new \DateTime('now');
        $date = date_timestamp_get($date);

        if($expDate <= $date)
          return 0;
            
        return 1;
    }

    public function remaining($expDate)
    {
        $interval = '';
        
        if($expDate){
            $date = new \DateTime('now');
            $expDate = new \DateTime("@$expDate");
            $expDate = $expDate->format('Y-m-d H:i:s');

            $expDate = date_create_from_format('Y-m-d H:i:s', $expDate);
            $interval = date_diff($date, $expDate);

            $interval = $interval->format('%a days');
        }

        return $interval;
    }

    public function getMac($id)
    {
        $em = $this->container->get("doctrine.orm.xtreamcode_entity_manager");
        $user = $em->getRepository("AppBundle:Users")->find($id);
        $mag = $em->getRepository("AppBundle:MagDevices")->findOneByUser($user);

        $mac = '';

        if($mag)
          $mac = base64_decode($mag->getMac());

        return $mac;
    }

    public function nodeJsPort()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();
        /**
         * @var Settings $setting
         */
        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(
            array(
                'user' => $token->getUser()
            ));

        return $setting->getNodeJsPort();
    }

    public function nginxPort()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();
        /**
         * @var Settings $setting
         */
        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(
            array(
                'user' => $token->getUser()
            ));

        return $setting->getBroadcastHTTPPort();
    }

    public function rtmpPort()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();
        /**
         * @var Settings $setting
         */
        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(
            array(
                'user' => $token->getUser()
            ));

        return $setting->getBroadcastRTMPPort();
    }

    public function dashPort()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();
        /**
         * @var Settings $setting
         */
        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(
            array(
                'user' => $token->getUser()
            ));

        return $setting->getBroadcastDASHPort();
    }
    
    public function getServerAddress()
    {        
        return str_replace('::1', '127.0.0.1', $_SERVER['SERVER_ADDR']);
    }

    function getServerNginx()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();
        /**
         * @var Settings $setting
         */
        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(
            array(
                'user' => $token->getUser()
        ));
        
        return "http://" . $setting->getServerAddress() . ":" . $setting->getBroadcastHTTPPort();
    }

    function getRtmpServerAddress()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();
        /**
         * @var Settings $setting
         */
        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(
            array(
                'user' => $token->getUser()
        ));

        return "rtmp://" . $setting->getServerAddress() . ":" . $setting->getBroadcastRTMPPort();
    }

    function getHlsServerAddress()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();
        /**
         * @var Settings $setting
         */
        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(
            array(
                'user' => $token->getUser()
        ));

        return "http://" . $setting->getServerAddress() . ":" . $setting->getBroadcastHTTPPort();
    }

    public function settings()
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $token = $this->tokenStorage->getToken();

        $setting = $em->getRepository("AppBundle:Settings")->findOneById(
            array(
                'user' => $token->getUser()
            ));

        return $setting;
    }

    /**
     * Convert from bytes to MB or GB
     * @param $size Size in bytes
     * @return number|string
     */
    public function convert($size)
    {
        $size = ($size /= pow(1024, 2)) > 1024 ? round(($size / 1024), 2) . " GB" : round($size, 2) . " MB";
        return $size;
    }

    function formatBytes($bytes, $precision = 2) {
////        $units = array('b', 'Kb', 'Mb', 'Gb', 'Tb');
//        $units = array('Kb', 'Mb', 'Gb', 'Tb');
//        $bytes = max($bytes, 0);
//        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
//        $pow = min($pow, count($units) - 1);
//
//        // Uncomment one of the following alternatives
////         $bytes /= pow(1024, $pow);
////         $bytes /= (1 << (10 * $pow));
//
//        return round($bytes, $precision) . ' ' . $units[$pow];
//
////        $unit = ["B", "KB", "MB", "GB"];
////        $exp = floor(log($bytes, 1024)) | 0;
////        return @round($bytes / (pow(1024, $exp)), $precision).$unit[$exp];
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;
        $terabyte = $gigabyte * 1024;

//        if (($bytes >= 0) && ($bytes < $kilobyte)) {
//            return $bytes . ' B';
//
//        } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
//            return round($bytes / $kilobyte, $precision) . ' Kb';
//
//        } else
        if (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
            return round($bytes / $megabyte, $precision) . ' Mb';

        } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
            return round($bytes / $gigabyte, $precision) . ' Gb';

        } elseif ($bytes >= $terabyte) {
            return round($bytes / $terabyte, $precision) . ' Tb';
        } else {
//            return $bytes . ' b';
            return round($bytes / $kilobyte, $precision) . ' Kb';
        }
    }

    public function getTime($time){
        $seg = $time / 1000;
        $d = floor($seg / 86400);
        $h = floor(($seg - ($d * 86400)) / 3600);
        $m = floor(($seg - ($d * 86400) - ($h * 3600)) / 60);
        $s = $seg % 60;
        $result = array();
        if($d > 0){
            $result[] = "$d d";
        }
        if($h > 0){
            $result[] = "$h h";
        }
        if($m > 0){
            $result[] = "$m m";
        }
        if($s > 0){
            $result[] = "$s s";
        }
        return implode(' ', $result);
    }

    public function get_country_by_code($code)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $country = $em->getRepository("AppBundle:Country")->findOneByCode($code);
        return $country;
    }

    public function userConnectionStatus(Users $user)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $retorno = "Offline";
        if ($em->getRepository('AppBundle:Sessions')->findOneBy(array('user' => $user))) {
            $retorno = "Online via WEB";
        } else {
            if ($devices = $user->getDevices()) {
                foreach ($devices as $device) {
                    if ($device->getAuthToken()) {
                        switch ($device->getDeviceType()) {
                            case Device::ANDROID:
                                $retorno = "Online via ANDROID";
                                break;
                            case Device::IOS:
                                $retorno = "Online via IOS";
                                break;
                            case Device::PC:
                                $retorno = "Online via PC";
                                break;
                        }
                    }
                }
            }
        }

        return $retorno;
    }

    /**
     * @param $msg
     * @description Filtro de twig utilizada para mostrar los mensajes de error con los estilos de bootstrap.
     * @return string
     */
    public function errorBoxMsgFilter($msg)
    {
        $html = "";
        if (is_array($msg)) {
            if (count($msg) > 0) {
                $html = '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">�</button>';
                foreach($msg as $aux) {
                    $html .= $aux;
                }
                $html .= '</div>';
            }
        } elseif (strlen($msg) > 0) {
            $html = '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">�</button>' . $msg . '</div>';
        }
        return $html;
    }
}
