<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Entity\ActivationCode;
use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Entity\ChannelsPackage;
use Dmcl\AppBundle\Entity\CodeMessage;
use Dmcl\AppBundle\Entity\Customers;
use Dmcl\AppBundle\Entity\Device;
use Dmcl\AppBundle\Entity\CustomerOrders;
use Dmcl\AppBundle\Entity\ActivationCodeHistory;
use Dmcl\AppBundle\Entity\EpgChannels;
use Dmcl\AppBundle\Entity\ExternalContacts;
use Dmcl\AppBundle\Entity\Message;
use Dmcl\AppBundle\Entity\Playlists;
use Dmcl\AppBundle\Entity\Programme;
use Dmcl\AppBundle\Entity\User;
use Dmcl\AppBundle\Utils\Util;
use Dmcl\AppBundle\Entity\Vod;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dmcl\AppBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class ApiController
 *
 * @package Dmcl\AppBundle\Controller
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class ApiController extends Controller
{ 
    const ENCRYPTION_METHOD = "AES-256-CBC";

    private function isBlockedDomain(Channel $channel, $domain){
		$sites = array();
		
        if($channel){
            $sites = explode(',', $channel->getSites());
		}
		
		$block = false;
		
        foreach ($sites as $site){
            if(strpos($site, $domain) !== false){
                $block = true;
                break;
            }
		}
		
        return $block;
    }

    private function getRandomAds(Channel $channel){
        $count = $channel->getAds()->count();
        if($count == 0){
            return null;
        }
        if($count == 1){
            return $channel->getAds()->get(0);
        }
        return $channel->getAds()->get(rand(0, $count -1));
    }

    private function encrypt($text, $password) {
        return @openssl_encrypt($text, self::ENCRYPTION_METHOD, $password);
    }

    private function sendRequest($route, $data=array(), $method='POST', $file=false)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        
        $dns = 'king-box.club';
        
        switch($method){
            // case "GET":
            //     $url = "http://$serverAddress/api.php?$route";
            //     $data['user_data']['username'] = $username; 
            //     $data['user_data']['password'] = $password;     
            // break;
           
            case "POST":
                $url = "http://$dns/api.php?$route";
                // $data['user_data']['username'] = $username; 
                // $data['user_data']['password'] = $password;     
            break;           
        }
    //  $url = 'http://king-box.club/api.php?action=user&sub=edit';
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); 
        curl_setopt($ch, CURLOPT_HEADER, "application/x-www-form-urlencoded"); 

        // if($file)
        //     curl_setopt($ch, CURLOPT_HEADER, "Content-type: multipart/form-data"); 

        $data = http_build_query($data);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);		
        
        $response = curl_exec($ch);      
        curl_close($ch);

        return $response;
    }

    /**
     * This method playback a channel timeshift by id
     * @ApiDoc(
     * description="",
     * requirements={
     *      {
     *          "name"="ip",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Server Transcoder`s address"
     *      },
     *      {
     *          "name"="idchannel",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Channel`s id"
     *      },
     *      {
     *          "name"="email",
     *          "dataType"="string",
     *          "requirement"="\s+",
     *          "description"="User`s email"
     *      },
     *      {
     *          "name"="startdate",
     *          "dataType"="string",
     *          "requirement"="\s+",
     *          "description"="Y-m-d"
     *      },
     *      {
     *          "name"="starttime",
     *          "dataType"="string",
     *          "requirement"="\s+",
     *          "description"="H:i:s"
     *      },
     *      {
     *          "name"="enddate",
     *          "dataType"="string",
     *          "requirement"="\s+",
     *          "description"="Y-m-d"
     *      },
     *      {
     *          "name"="endtime",
     *          "dataType"="string",
     *          "requirement"="\s+",
     *          "description"="H:i:s"
     *      }
     * },  
     * statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     */
    public function playbackChannelInfoAction(Request $request)
    {            
        $response = array('success' => 200, 'data' => ''); 

        $em = $this->container->get('doctrine.orm.entity_manager');
        $m3u8file = '';

        $idchannel = $request->get('idchannel');
        $email = $request->get('email');
        $startdate = $request->get('startdate');
        $starttime = $request->get('starttime');
        $enddate = $request->get('enddate');
        $endtime = $request->get('endtime');
        $ip = $request->get('ip');

        try{
            if($ip == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => "Field 'ip' is required",
                    'data' => ''
                ), 200); 

            if($idchannel == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "id" is required',
                    'data' => ''
                ), 200);  

            if($email == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "email" is required',
                    'data' => ''
                ), 200); 

            if($startdate == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "startdate" is required',
                    'data' => ''
                ), 200); 

            if($starttime == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "starttime" is required',
                    'data' => ''
                ), 200);  

            if($enddate == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "enddate" is required',
                    'data' => ''
                ), 200);   

            if($endtime == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "endtime" is required',
                    'data' => ''
                ), 200);

            $server = $em->getRepository('AppBundle:StreamsServer')->findOneByServerAddress($ip);
            
            $route = $idchannel . '/' . $startdate . '/' . $starttime . '/' . $startdate . '/' . $endtime . '/' . $server->getServerAddress() . '/' . $server->getBroadcastHTTPPort();
    
            $response = $this->sendRequest($this::ROUTE_PLAYBACK_CHANNEL_INFO.$route, $ip, $email);           
        }catch (\Exception $e) {
            return new JsonResponse(array(
                'success' => 500,
                'msg' => $e->getMessage(),
                'data' => ''
            ), 200);
        } 
       
        return new Response($response);
    }

    /**
     * @ApiDoc(
     * description="This method is used for login an user from a device throw your activation code.",
     * requirements={
     *   {
     *     "name"="ip",
     *     "dataType"="integer",
     *     "requirement"="\d+",
     *     "description"="Streams transcoder`s address"
     *   },
     *   {
     *     "name"="email",
     *     "dataType"="string",
     *     "requirement"="\s+",
     *     "description"="User`s email"
     *   },
     *   {
     *     "name"="activationCode",
     *     "dataType"="string",
     *     "requirement"="\s+",
     *     "description"="Activation code for login a reseller"
     *   },
     *   {
     *     "name"="serialNumber",
     *     "dataType"="string",
     *     "requirement"="\s+",
     *     "description"="Device's serial number"
     *   }
     * },  
     * parameters={
     *      {"name"="mac", "dataType"="string", "required"=false, "description"="Device's mac"},
     *      {"name"="deviceModel", "dataType"="string", "required"=false, "description"="Device model"},
     *      {"name"="modelNumber", "dataType"="string", "required"=false, "description"="Device's model number"},
     *  },
     *     statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     */
    public function activationCodeLoginAction(Request $request)
    {
        try {
            $response = array('success' => 200, 'data' => '');
            
            $code = $request->get('activationCode');
            $serialNumber = $request->get('serialNumber');
            $mac = $request->get('mac');
            $deviceModel = $request->get('deviceModel');
            $modelNumber = $request->get('modelNumber');
            $ip = $request->get('ip');
            $email = $request->get('email');

            if($ip == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "ip" is required',
                    'data' => ''
                ), 200); 

            if($email == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "email" is required',
                    'data' => ''
                ), 200);   
            
            if($code == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "code" is required',
                    'data' => ''
                ), 200);

            if($serialNumber == "")
                return new JsonResponse(array(
                    'success' => 401,
                    'msg' => 'Field "serialNumber" is required',
                    'data' => ''
                ), 200);

            $em = $this->getDoctrine()->getManager();
            $autenticarUsuario = false;
            /**
             * @var ActivationCode $activationCode
             */
            $activationCode = $em->getRepository('AppBundle:ActivationCode')->findOneBy(array('code' => $code));

            if ($activationCode && $serialNumber) {
                //Verifico que el codigo no este vencido
                $currentDate = date_create_from_format('d-m-Y', date('d-m-Y'));
                if ($activationCode->getEndDate() && $activationCode->getEndDate() <= $currentDate) {
                    $response = array(
                        'success' => 400,
                        'msg' => 'The activation code has expired',
                        'data' => null
                    );
                } else {
                    //Si el codigo no esta vencido verifico si es la primera vez que se autentica
                    if ($device = $activationCode->getDevice()) {
                        //Verifico que el device sea el dispositivo que esta intentando autenticarse
                        if ($device->getSerialNumber() == $serialNumber) {
                            $autenticarUsuario = true;
                        } else {
                            $response = array(
                                'success' => 200,
                                'msg' => 'Code is already activated',
                                'data' => null
                            );
                        }
                    } else {
                        $autenticarUsuario = true;
                    }
                }
            }
            else {
                $response = array(
                    'success' => 400,
                    'msg' => 'Invalid activation code',
                    'data' => null
                );
            }

            if ($autenticarUsuario) {
                if (!$activationCode->getEndDate()) {
                    $activationCode->setEnabled(true);
                    $activationCode->setStartDate(clone $currentDate);
                    $increment = $activationCode->getPeriod();
                    $endDate = date_add($currentDate, date_interval_create_from_date_string("$increment days"));
                    $activationCode->setEndDate($endDate);
                    $activationCode->setIp($ip);
                }

                if (!$activationCode->getDevice()) {
                    $device = new Device();
                    $device->setMac($mac);
                    $device->setDeviceModel($deviceModel);
                    $device->setModelNumber($modelNumber);
                    $device->setSerialNumber($serialNumber);
                    $device->setActivationCode($activationCode);
                    $em->persist($device);
                }

                $activationCodeHistory = new ActivationCodeHistory();
                $activationCodeHistory->setMac($mac);
                $activationCodeHistory->setDeviceModel($deviceModel);
                $activationCodeHistory->setModelNumber($modelNumber);
                $activationCodeHistory->setSerialNumber($serialNumber);
                $activationCodeHistory->setActivationCodeId($activationCode);
                $activationCodeHistory->setActivationCode($activationCode->getCode());
                $activationCodeHistory->setResetLogin("Login");
                $em->persist($activationCodeHistory);

                $activationCode->setHash(Util::hash(array($mac, $serialNumber, time())));
                $em->persist($activationCode);

                $em->flush();

                $channelsP = $activationCode->getChannelsPackage();    
                $vodsP = $activationCode->getVodsPackage();    
                $seriesP = $activationCode->getSeriesPackage();

                $channel_packages = [];

                foreach($channelsP as $channelP){
                    $streamsServers = json_decode($channelP->getChannels(), true);
        
                    foreach($streamsServers as $streamsServer){
                        $ip = $streamsServer['server'];
                        $channels = $streamsServer['channels'];
        
                        $server = $em->getRepository("AppBundle:StreamsServer")->findOneByServerAddress($ip);
        
                        $data = array(
                            'serveraddress' => $ip,
                            'rtmpport' => $server->getBroadcastRtmpPort(),
                            'httpport' => $server->getBroadcastHttpPort()
                        );

                        $packChannels = [];
                       
                        foreach($channels as $channel){
                            $id = $channel['id'];
        
                            $response = $this->sendRequest($this::ROUTE_CHANNEL_BYID.$id, $ip, $email);
                            $response = json_decode($response);
                            
                            if($response != null){
                                $code = $response->success;
                                                 
                                if($code != 401 && $code != 404 && $code != 500 && $code != 403){
                                    $channel = new Channel($response->data);

                                    $category = $em->getRepository("AppBundle:ChannelCategories")->find($channel->getCategory());

                                    $url = "http://$ip/iptvtranscoderclient";

                                    $logo = "$url/uploads/".$channel->getLogo();

                                    if(!file_exists($logo))
                                      $logo = "$url/uploads/channel-logo.png";

                                    if($channel->getSnaptshot()){
                                        $logo = "$url/uploads/screenshot/img-channel-$id.png";

                                        if(!file_exists($logo))
                                            $logo = "$url/uploads/channel-logo.png";
                                    }

                                    $packChannels[] = [
                                        'id' => $channel->getId(),
                                        'name' => $channel->getName(),
                                        'live' => $channel->getLive(),
                                        'price' => $channel->getPrice(),
                                        'logo' =>  $logo,
                                        'status' => $channel->getEnabled(),
                                        'parental_lock' => $channel->isParentalLock(),
                                        'idcategory' => $category->getId(),
                                        'category' => $category->getName()
                                    ];
                                }
                            }  
                        }

                        array_push($channel_packages, array(
                            'idchannelPackage' => $channelP->getId(),
                            'channelPackage' => $channelP->getName(),
                            'channels' => $packChannels
                        ));
                    }
                }

                $vods_packages = [];
        
                foreach($vodsP as $vodP){
                    $streamsServers = json_decode($vodP->getVods(), true);
                    
                    foreach($streamsServers as $streamsServer){
                        $ip = $streamsServer['server'];
                        $vodsId = $streamsServer['vods'];
        
                        $server = $em->getRepository("AppBundle:StreamsServer")->findOneByServerAddress($ip);

                        $packVods = array();
        
                        foreach($vodsId as $vodId){
                            $id = $vodId['id'];
        
                            $response = $this->sendRequest($this::ROUTE_VODS_BYID.$id, $ip, $email);
                            $response = json_decode($response);
        
                            if($response != null){
                                $code = $response->success;
                                                 
                                if($code != 401 && $code != 404 && $code != 500 && $code != 403){
                                    $vod = new Vod($response->data);

                                    $genresIds = $vod->getGenres();
                                    $genres = [];

                                    foreach($genresIds as $id){
                                        $genre =  $em->getRepository("AppBundle:VodGenres")->find($id);
                                        
                                        $url = "http://$ip/iptvtranscoder";

                                        $logo = "$url/uploads/".$genre->getCategorieLogo();

                                        if(!file_exists($logo))
                                            $logo = "$url/uploads/channel-logo.png";

                                        if($genre)                                        
                                            $genres[] = [
                                                'id' => $genre->getId(),
                                                'name' => utf8_encode($genre->getName()),
                                                'logo' => $logo
                                            ];
                                    }

                                    $url = "http://$ip/iptvtranscoderclient";

                                    $cover = "$url/uploads/vod_cover".$vod->getCover();

                                    if(!file_exists($cover))
                                      $cover = "$url/uploads/channel-logo.png";
                                    
                                    $sourcesEntities = $vod->getSources();
                                    $sources = [];

                                    foreach($sourcesEntities as $source){
                                        $sources[] = [
                                            'id' => $source->getId(),
                                            'video' => $source->getVideo(),
                                            'duration' => $source->getDuration(),
                                            'size' => $source->getSize(),
                                            'enabled' => $source->getEnabled()
                                        ];
                                    }

                                    $packVods[] = [
                                        'id' => $vod->getId(),
                                        'title' => $vod->getTitle(),
                                        'enabled' => $vod->getEnabled(),
                                        'genres' => $genres, 
                                        'typevod' => $vod->getTypeVod(),
                                        'token' => $vod->getToken(),
                                        'trailer' => $vod->getTrailer(),
                                        'sources' => $sources,
                                        'year' => $vod->getYear(),
                                        'director' => $vod->getDirector(),
                                        'description' => $vod->getDescription(),
                                        'cover' => $cover
                                    ];
                                }
                            }
                        }

                        $vods_packages[] = array(
                            'id' => $vodP->getId(),
                            'name' => $vodP->getName(),
                            'enabled' => $vodP->getEnabled(),
                            "vods" => $packVods,
                            "description" => $vodP->getDescription(),
                            'live' => $vodP->getLive()
                        );
                    }
                }

                $series_packages = [];
        
                foreach($seriesP as $serieP){
                    $streamsServers = json_decode($serieP->getVods(), true);
                    
                    foreach($streamsServers as $streamsServer){
                        $ip = $streamsServer['server'];
                        $series = $streamsServer['vods'];
        
                        $server = $em->getRepository("AppBundle:StreamsServer")->findOneByServerAddress($ip); 
                        
                        $packSeries = [];
        
                        foreach($series as $serie){
                            $id = $serie['id'];
        
                            $response = $this->sendRequest($this::ROUTE_SERIES_BYID.$id, $ip, $email);
                            $response = json_decode($response);
        
                            if($response != null){
                                $code = $response->success;
                                                 
                                if($code != 401 && $code != 404 && $code != 500 && $code != 403){
                                    $vod = new Vod($response->data);

                                    $genresIds = $vod->getGenres();
                                    $genres = [];

                                    foreach($genresIds as $id){
                                        $genre =  $em->getRepository("AppBundle:VodGenres")->find($id);
                                        
                                        $url = "http://$ip/iptvtranscoder";

                                        $logo = "$url/uploads/".$genre->getCategorieLogo();

                                        if(!file_exists($logo))
                                            $logo = "$url/uploads/channel-logo.png";

                                        if($genre)                                        
                                            $genres[] = [
                                                'id' => $genre->getId(),
                                                'name' => utf8_encode($genre->getName()),
                                                'logo' => $logo
                                            ];
                                    }

                                    $url = "http://$ip/iptvtranscoderclient";

                                    $cover = "$url/uploads/vod_cover".$vod->getCover();

                                    if(!file_exists($cover))
                                      $cover = "$url/uploads/channel-logo.png";
                                    
                                    $sourcesEntities = $vod->getSources();
                                    $sources = [];

                                    foreach($sourcesEntities as $source){
                                        $sources[] = [
                                            'id' => $source->getId(),
                                            'video' => $source->getVideo(),
                                            'duration' => $source->getDuration(),
                                            'size' => $source->getSize(),
                                            'enabled' => $source->getEnabled()
                                        ];
                                    }

                                    $packSeries[] = [
                                        'id' => $vod->getId(),
                                        'title' => $vod->getTitle(),
                                        'enabled' => $vod->getEnabled(),
                                        'genres' => $genres, 
                                        'typevod' => $vod->getTypeVod(),
                                        'token' => $vod->getToken(),
                                        'trailer' => $vod->getTrailer(),
                                        'sources' => $sources,
                                        'year' => $vod->getYear(),
                                        'director' => $vod->getDirector(),
                                        'description' => $vod->getDescription(),
                                        'cover' => $cover
                                    ];
                                }
                            }
                        }

                        $series_packages[] = [
                            'id' => $serieP->getId(),
                            'name' => $serieP->getName(),
                            'enabled' => $serieP->getEnabled(),
                            "vods" => $packSeries,
                            "description" => $serieP->getDescription(),
                            'live' => $serieP->getLive()
                        ];
                    }
                }

                $customer = $activationCode->getCustomer();
                $name = $customer->getName();
                $email = $customer->getEmail();
                $username = $customer->getUsername();

                $userData = array(
                    'name' => $name,
                    'email' => $email,
                    'username' => $username,
                );

                $response = array(
                    'success' => 200,
                    'msg' => 'User logged successfully',
                    'data' => array(
                        'channelPackage' => $channel_packages,
                        'vodsPackage' => $vods_packages,
                        'seriesPackage' => $series_packages,
                        'user' => $userData,
                        'end_date' => $activationCode->getEndDate()
                    )
                );
            }
        }catch (\Exception $ex) {
            $response = array(
                'error' => true,
                'msg' => $ex->getMessage(),
                'data' => null
            );
        }

        return new JsonResponse($response);
    }

    // /**
    //  * Return the messages unread for an activation code.
    //  *
    //  * @ApiDoc(
    //  * description="Return the messages unread for an activation code.",
    //  *   requirements={
    //  *      {
    //  *          "name"="code",
    //  *          "dataType"="integer",
    //  *          "requirement"="\d+",
    //  *          "description"="Activation's code"
    //  *      }
    //  *  },
    //  *     statusCodes={
    //  *         200="Returned when successful",
    //  *         404={
    //  *           "Returned when the activation code is not found"
    //  *         }
    //  *     }
    //  * )
    //  */
    // public function getMessagesForActivationCodeAction($code)
    // {
    //     if ($code != null) {
    //         $response = $this->get("app.util.services")->sendRequest($this::ROUTE_API_ACTIVATIONCODE_MESSAGES.$code);
    //         $response = json_decode($response, true);
            
    //         $code = $response['success'];
                                            
    //         if($code == 401 || $code == 404 || $code == 500)
    //             return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
    //                 'msg' => $response['msg'],
    //                 'data' =>  $response['data']
    //                 )); 
                                        
    //         if($code === 403)
    //             return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
    //                     'msg' => $response['msg'],
    //                     'password' =>  $response['data']['password'],
    //                     'apikey' =>  $response['data']['apikey']
    //                 )); 

    //         return new JsonResponse($response);
    //     }

    //     return new JsonResponse("Activation code not found", Response::HTTP_NOT_FOUND);
    // }

    /**
    * This method return a collection of all servers transcoder by the user
    * @ApiDoc(
    * description="This method return a collection of all servers transcoder by the user` id",
    * requirements={
    *    {
    *        "name"="email",
    *        "dataType"="integer",
    *        "requirement"="\d+",
    *        "description"="User` email"
    *    }
    * },
    * statusCodes={
    *         200="Returned when successful"
    *     }
    * )
    */
   public function getServersTranscoderByUserAction(Request $request)
   {
       $response = array('success' => 200, 'data' => '');     
       $em = $this->getDoctrine()->getManager();
       $email = $request->get('email'); 

       if($email == "")
           return new JsonResponse(array(
               'success' => 401,
               'msg' => 'Field "email" is required',
               'data' => ''
           ), 200);   

       $user = $em->getRepository('AppBundle:User')->findOneByEmail($email);

       if(!$user){
         $response = array('success' => 404, 'data' => 'User was not found'); 
         return new JsonResponse($response, 200);
       }
       
       $servers = $em->getRepository('AppBundle:StreamsServer')->findByUser($user);

       if ($servers) {
           foreach($servers as $server){
                $response['data'][] = [
                    'name' => $server->getName(),
                    'ip' => $server->getServerAddress(),
                    'rtmpport' => $server->getBroadcastRTMPPort(),
                    'nodejsport' => $server->getNodejsPort(),
                    'httpport' => $server->getBroadcastHTTPPort()
                ];
           }            
       }

       return new JsonResponse($response, 200);
   }  

    /**
     * This method return a collection of all Categories
     * @ApiDoc(
     * description="Returns a collection of Categories",
     * statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     */
    public function categoriesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $categories = $em->getRepository('AppBundle:ChannelCategories')->findAll();

        $ip = $this->get('app.twig.extension.utils')->getServerAddress();

        $url = "http://$ip/iptvtranscoder";

        foreach($categories as $category){ 
            $logo = "$url/uploads/channel-logo.png";

            if($category->getCategorieLogo() != null){
                if(!file_exists($logo))
                    $logo = "$url/uploads/".$category->getCategorieLogo();
            }

            $response['data'][] = array(
                'id' => $category->getId(),
                'name' => $category->getName(),
                'logo' => $logo,
                'updatedAt' => $category->getUpdatedAt()?$category->getUpdatedAt()->format('Y-m-d H:m:s'):'',
                'createdAt' => $category->getCreatedAt()?$category->getCreatedAt()->format('Y-m-d H:m:s'):''
            );  
        }
        
        return new JsonResponse($response, 200);
    }

    /**
     * This method return a collection of all Vod Genres
     * @ApiDoc(
     * description="Returns a collection of Vod Genres",
     * statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     */
    public function vodGenresAction(Request $request)
    {
        $response = ['success' => 200, 'data' => ''];

        $em = $this->getDoctrine()->getManager();

        $ip = $this->get('app.twig.extension.utils')->getServerAddress();

        $url = "http://$ip/iptvtranscoder";
        
        $genres = $em->getRepository('AppBundle:VodGenres')->findAll();

        foreach($genres as $genre){ 
            $logo = "$url/uploads/channel-logo.png";

            if($genre->getCategorieLogo() != null){
                if(!file_exists($logo))
                    $logo = "$url/uploads/vod_cover/".$genre->getCategorieLogo();
            }

            $response['data'][] = array(
                'id' => $genre->getId(),
                'name' => $genre->getName(),
                'logo' => $logo,
                'updatedAt' => $genre->getUpdatedAt()?$genre->getUpdatedAt()->format('Y-m-d H:m:s'):'',
                'createdAt' => $genre->getCreatedAt()?$genre->getCreatedAt()->format('Y-m-d H:m:s'):''
            );  
        } 

        return new JsonResponse($response, 200);
    }

    /**
     * This method return a collection of all current programmes for a channel
     * @ApiDoc(
     * description="Returns a collection of Programmes",
     * parameters={
     *      {"name"="date", "dataType"="date", "required"=false, "description"="programme's date"},
     *  },
     *   requirements={
     *      {
     *          "name"="channelId",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="Channel's Id"
     *      }
     *  },
     *     statusCodes={
     *         200="Returned when successful",
     *         404={
     *           "Returned when the Programme is not found",
     *         }
     *     }
     * )
     */
    public function channelProgrammeAction(Request $request)
    {
        $data = array(
            'channelId' => $request->get('channelId'),
            'date' => $request->get('date')
        );
        
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_API_CHANNELS_PROGRAMES_BYID, $data, 'POST');
        $response = json_decode($response, true);
        
        $code = $response['success'];
                                        
        if($code == 401 || $code == 404 || $code == 500)
            return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                'msg' => $response['msg'],
                'data' =>  $response['data']
                )); 
                                    
        if($code === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response['msg'],
                    'password' =>  $response['data']['password'],
                    'apikey' =>  $response['data']['apikey']
                )); 

        return new JsonResponse($response, 200);
    }
    /**
     * This method return a collection of all channels with  programmes
     * @ApiDoc(
     * description="Returns a collection of channels with  programmes",
     *   requirements={
     *      {
     *          "name"="date",
     *          "dataType"="date",
     *          "description"="Date programmes"
     *      }
     *  },
     *     statusCodes={
     *         200="Returned when successful",
     *         404={
     *           "Returned when the channels is not found",
     *         }
     *     }
     * )
     */
    public function channelsWithProgrammeAction(Request $request, $date)
    {
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_API_CHANNELS_PROGRAMES.$date);
        $response = json_decode($response, true);
        
        $code = $response['success'];
                                        
        if($code == 401 || $code == 404 || $code == 500)
            return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                'msg' => $response['msg'],
                'data' =>  $response['data']
                )); 
                                    
        if($code === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response['msg'],
                    'password' =>  $response['data']['password'],
                    'apikey' =>  $response['data']['apikey']
                )); 

        return new JsonResponse($response, $code);
    }

    /**
     * This method return a collection of all channels with  programmes between two dates
     * @ApiDoc(
     * description="Returns a collection of channels with  programmes between two dates",
     * requirements={
     *      {
     *          "name"="startDate",
     *          "dataType"="date",
     *          "description"="Start date programmes"
     *      },{
     *          "name"="endDate",
     *          "dataType"="date",
     *          "description"="End date programmes"
     *      }
     *  },
     *     statusCodes={
     *         200="Returned when successful",
     *         404={
     *           "Returned when the channels is not found",
     *         }
     *     }
     * )
     */
    public function channelsWithProgrammeBetweenDatesAction(Request $request, $startDate, $endDate)
    {
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_API_CHANNELS_PROGRAMES_DATERANGE.$startDate.'/'.$endDate);
        $response = json_decode($response, true);
        
        $code = $response['success'];
                                        
        if($code == 401 || $code == 404 || $code == 500)
            return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                'msg' => $response['msg'],
                'data' =>  $response['data']
                )); 
                                    
        if($code === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response['msg'],
                    'password' =>  $response['data']['password'],
                    'apikey' =>  $response['data']['apikey']
                )); 

        return new JsonResponse($response, $code);
    }
    
    /**
     * This method return a collection of all current programmes for a day
     * @ApiDoc(
     * description="Returns a collection of Programmes",
     * parameters={
     *      {"name"="date", "dataType"="date", "required"=false, "description"="programmes's date"},
     *  },
     *     statusCodes={
     *         200="Returned when successful",
     *         404={
     *           "Returned when the Programme is not found",
     *         }
     *     }
     * )
     */
    public function programmesAction(Request $request)
    {
        $response = array(
            'status' => 404,
            'programmes' => array()
        );

        $em = $this->getDoctrine()->getManager();
        $date = new \DateTime("today");
        if ($request->get("date")) {
            $date = new \DateTime($request->get("date"));
        }
        $entities = $em->getRepository('AppBundle:Programme')->findBy(array("day" => $date), array("startAt" => "ASC"));
        if ($entities) {
            $response['status'] = 200;

            foreach ($entities as $programme) {
                $response['programmes'][] = array(
                    "id" => $programme->getId(),
                    "title" => $programme->getTitle(),
                    "day" => $programme->getDay()->format("Y-m-d"),
                    "start" => $programme->getStartAt()->format("H:t:s"),
                    "xmltvStart" => $programme->getStartAtXMLTV(),
                    "end" => $programme->getEndAt()->format("H:t:s"),
                    "xmltvEnd" => $programme->getEndAtXMLTV()
                );
            }
        }
        return new Response(json_encode($response), $response['status']);
    }

    /**
     * @ApiDoc(
     * description="This method is used for requesting a trial activation code.",
     * parameters={
     *      {"name"="email", "dataType"="string", "required"=true, "description"="User's email"},
     *      {"name"="mac", "dataType"="string", "required"=false, "description"="Device's mac"},
     *      {"name"="deviceModel", "dataType"="string", "required"=false, "description"="Device model"},
     *      {"name"="modelNumber", "dataType"="string", "required"=false, "description"="Device's model number"},
     *      {"name"="serialNumber", "dataType"="string", "required"=true, "description"="Device's serial number"}
     *  },
     *     statusCodes={
     *         200="Returned when successful"
     *     }
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function requestTrialActivationCodeAction(Request $request)
    {
        $data = array(
            'email' => $request->get('email'),
            'mac' => $request->get('mac'),
            'deviceModel' => $request->get('deviceModel'),
            'modelNumber' => $request->get('modelNumber'),
            'serialNumber' => $request->get('serialNumber'),
        );
        
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_API_TRIAL_ACTIVATIONCODE, $data, 'POST');
        $response = json_decode($response, true);
        
        $code = $response['success'];
                                        
        if($code == 401 || $code == 404 || $code == 500)
            return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                'msg' => $response['msg'],
                'data' =>  $response['data']
                )); 
                                    
        if($code === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response['msg'],
                    'password' =>  $response['data']['password'],
                    'apikey' =>  $response['data']['apikey']
                )); 
        
        return new JsonResponse($response, 200);
    }

    /****************************************************************************** API XTREAMCODE ***************************************************/

    /**
     * This method return a collection of all channels with  programmes between two dates
     * @ApiDoc(
     * description="Returns a collection of channels with  programmes between two dates",
     * requirements={
     *      {
     *          "name"="email",
     *          "dataType"="string",
     *          "description"=""
     *      }
     *  },
     * statusCodes={
     *    200="Returned when successful"
     * }
     * )
     */
    public function newLineAction(Request $request)
    {
        $response = ['success' => 200, 'data' => ''];

        // $em = $this->getDoctrine()->getManager();
        
        // $email = $request->get('email');

        // if($email == "")
        //     return new JsonResponse(array(
        //         'success' => 401,
        //         'msg' => "Field 'email' is required",
        //         'data' => ''
        //     ), 200); 
        
        $data = [];
        
        // $reseller = 1;
        // $max_connections = 1;
        // $bouquet_ids = [1, 2, 3];
        // $expire_date = strtotime( "+1 month" );

        // $data = [
        //     'user_data' => [
        //         'username' => '',
        //         'password' => '',
        //         'max_connections' => $max_connections,
        //         'is_restreamer' => $reseller,
        //         'exp_date' => $expire_date,
        //         'bouquet' => json_encode($bouquet_ids) 
        //     ]
        // ];

        $response = $this->sendRequest($this::ROUTE_LINE_CREATE, $data);
        $response = json_decode($response, true);

        return new JsonResponse($response, 200);
    }

    /**
     * This method return a collection of all channels with  programmes between two dates
     * @ApiDoc(
     * description="Returns a collection of channels with  programmes between two dates",
     * requirements={
     *      {
     *          "name"="email",
     *          "dataType"="string",
     *          "description"=""
     *      }
     *  },
     * statusCodes={
     *    200="Returned when successful"
     * }
     * )
     */
    public function editLineAction(Request $request)
    {
        $response = ['success' => 200, 'data' => ''];

        $em = $this->getDoctrine()->getManager();
        
        $email = $request->get('email');

        if($email == "")
            return new JsonResponse(array(
                'success' => 401,
                'msg' => "Field 'email' is required",
                'data' => ''
            ), 200); 

        $user = $em->getRepository('AppBundle:User')->findOneByEmail($email);

        if(!$user){
            $response = array('success' => 404, 'data' => 'User was not found'); 
            return new JsonResponse($response, 200);
        }       

        $username = $user->getUsername();
        $password = $user->getPassword();
        
        $data = [];
        
        $expire_date = strtotime( "+1 month" );

        $data = [            
            'username' => 'qRK8mfXeEx',//$username,
                'password' => 'MppBWVs8ur',//$password
            'user_data' => [
                'max_connections' => 10,
                'exp_date' => $expire_date
            ]
        ];

        $response = $this->sendRequest($this::ROUTE_LINE_EDIT, $data);
        $response = json_decode($response, true);


//         $panel_url = 'http://king-box.club/';
// $username = 'qRK8mfXeEx';
// $password = 'MppBWVs8ur';
// $max_connections = 10;
// $expire_date = strtotime( "+1 month" ); //from the time now, not from line's expire date.

// ###############################################################################
// $post_data = array(
//     'username' => $username,
//     'password' => $password,
//     'user_data' => array(
//         'max_connections' => $max_connections,
//         'exp_date' => $expire_date ) );

// $opts = array( 'http' => array(
//         'method' => 'GET',
//         'header' => 'Content-type: application/x-www-form-urlencoded',
//         'content' => http_build_query( $post_data ) ) );

// $context = stream_context_create( $opts );
// $api_result = json_decode( file_get_contents( $panel_url . "api.php?action=user&sub=edit", false, $context ) );

        return new JsonResponse($response, 200);
    }

    /**
     * This method return a collection of all channels with  programmes between two dates
     * @ApiDoc(
     * description="Returns a collection of channels with  programmes between two dates",
     * requirements={
     *      {
     *          "name"="email",
     *          "dataType"="string",
     *          "description"=""
     *      }
     *  },
     * statusCodes={
     *    200="Returned when successful"
     * }
     * )
     */
    public function infoLineAction(Request $request)
    {
        $response = ['success' => 200, 'data' => ''];

        $em = $this->getDoctrine()->getManager();
        
        $email = $request->get('email');

        if($email == "")
            return new JsonResponse(array(
                'success' => 401,
                'msg' => "Field 'email' is required",
                'data' => ''
            ), 200); 

        $user = $em->getRepository('AppBundle:User')->findOneByEmail($email);

        if(!$user){
            $response = array('success' => 404, 'data' => 'User was not found'); 
            return new JsonResponse($response, 200);
        }       

        $username = $user->getUsername();
        $password = $user->getPassword();
        
        $data = [];
        
        $data = [
            'username' => 'K6ReLT4pt7',//$username,
            'password' => '2XlRSdZBhy'//$password
        ];

        // $data = [
        //     'username' => $username,
        //     'password' => $password
        // ];

        $response = $this->sendRequest($this::ROUTE_LINE_INFO, $data);
        $response = json_decode($response, true);

        return new JsonResponse($response, 200);
    }
}