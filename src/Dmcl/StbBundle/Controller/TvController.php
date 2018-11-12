<?php

namespace Dmcl\StbBundle\Controller;
use Dmcl\StbBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TvController extends Controller
{

    public function get_genresAction(Request $request){
        $em = $this->container->get("doctrine.orm.entity_manager");
        $categories = $em->getRepository('AppBundle:ChannelCategories')->findByEnabled(true);
        $js = array();
        $js[]=array("id"=>"*","title"=>"All","alias"=>"All");
        foreach ($categories as $category) {
            $js[]=array("id"=>$category->getId(),"title"=>$category->getName(),"alias"=>$category->getName());
        }
        return $this->response($js,"");
    }

    public function get_all_channelsAction(Request $request){
        $js = ["total_items"=>0,"max_page_items"=>14,"selected_item"=>0,"cur_page"=>0,"data"=>[]];
        return $this->response($js,"");
    }


    public function get_ordered_listAction(Request $request){
        $em = $this->container->get("doctrine.orm.entity_manager");
//        $sortby = $request->get("sortby")=="number"?"c.id":"c.name";
//        $criteria = $request->get("genre")=="*" ? "":"c.category=".$request->get("genre");
        $category = $request->get("genre");
        $page = $request->get('p');
        $page_items = 14;

        $js = [
            "total_items"=>0,
            "max_page_items"=>0,
            "selected_item"=>0,
            "cur_page"=>1,
            "data"=>[]
        ];

        if($request->getSession()->get("access_token")) {
            $access_token = $request->getSession()->get("access_token");
            $id = isset($access_token["id"]) ? $access_token["id"] : null;
            if ($id && $id >= 0) {
                $user = $em->getRepository($access_token["class"])->find($id);
                if ($user) {
                    if ($page == 0){
                        $page = 1;
                    }
                    $channels=[];
                    foreach ($user->getPlaylists() as $playlist) {
                        $now = new \DateTime("now");
                        $expire =  new \DateTime($playlist->getExpireAt());
                        if($expire > $now){
                            foreach ($playlist->getChannels() as $channel) {
                                if($channel->getEnabled() && ($category==$channel->getCategory()->getId() || $category == "*")){
                                    $channels[$channel->getId()]=$channel;
                                }
                            }
                            foreach ($playlist->getChannelsPackages() as $package) {
                                foreach ($package->getChannels() as $channel) {
                                    if(!isset($channels[$channel->getId()])){
                                        if($channel->getEnabled() && ($category==$channel->getCategory()->getId() || $category == "*")){
                                            $channels[$channel->getId()]=$channel;
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $js = [
                        "total_items"=>count($channels),
                        "max_page_items"=>$page_items,
                        "selected_item"=>0,
                        "cur_page"=>$page,
                        "data"=>[]
                    ];
                    $channels = array_slice($channels, ($page-1)*$page_items, $page_items);

                    foreach ($channels as $channel) {

                        $live = $this->container->get("app.stream.security.services")->secureChannel($channel,null,$user->getId(),new \DateTime('now + 1 day'));
                        if($live){
                            $js["data"][]=[
                                'allow_local_pvr'=> "",
                                'allow_local_timeshift'=>"0",
                                'allow_pvr'=>"",
                                'archive'=>0,
                                'base_ch'=>"0",
                                'bonus_ch'=>"0",
                                'censored'=>"0",
                                'cmd'=>$live,
                                'cmd_1'=>"",
                                'cmd_2'=>"",
                                'cmd_3'=>"",
                                'cmds'=>[
                                    'ch_id'=>"1",
                                    'changed'=>"0000-00-00 00:00:00",
                                    'enable_balancer_monitoring'=>0,
                                    'flussonic_tmp_link'=>0,
                                    'id'=>0,
                                    'nginx_secure_link'=>0,
                                    'priority'=>0,
                                    'status'=>0,
                                    'url'=>$live,
                                    'use_http_tmp_link'=>0,
                                    'use_load_balancing'=>0,
                                    'user_agent_filter'=>0,
                                    'wowza_tmp_link'=>0
                                ],
                                'correct_time'=>"0",
                                'count'=>"0",
                                'created'=>"0000-00-00 00:00:00",
                                'cur_playing'=>[],
                                'enable_monitoring'=>"0",
                                'enable_tv_archive'=>"0",
                                'enable_wowza_load_balancing'=>"0",
                                'epg'=>[],
                                'fav'=>0,
                                'genres_str'=>"",
                                'hd'=>"0",
                                'id'=>$channel->getId(),
                                'lock'=>0,
                                'logo'=>$this->generateUrl('_home', array(), true) .'uploads/' . $channel->getLogo(),
                                'mc_cmd'=>"",
                                'modified'=>null,
                                'monitoring_status'=>"0",
                                'monitoring_status_updated'=>null,
                                'name'=>$channel->getName(),
                                'nginx_secure_link'=>"0",
                                'number'=>$channel->getId(),
                                'open'=>1,
                                'pvr'=>0,
                                'service_id'=>"",
                                'tv_archive_duration'=>"168",
                                'tv_genre_id'=>$channel->getCategory()->getId(),
                                'use_http_tmp_link'=>0,
                                'use_load_balancing'=>0,
                                'wowza_dvr'=>"0",
                                'wowza_tmp_link'=>0,
                            ];
                        }
                    }
                }
            }
        }
        return $this->response($js,"");
    }

//    public function get_ordered_listForResellerAction(Request $request){
//        $em = $this->container->get("doctrine.orm.entity_manager");
//        $sortby = $request->get("sortby")=="number"?"c.id":"c.name";
//        $criteria = $request->get("genre")=="*" ? "":"c.category=".$request->get("genre");
//        $page = $request->get('p');
//        $page_items = 14;
//
//        $js = [
//            "total_items"=>0,
//            "max_page_items"=>0,
//            "selected_item"=>0,
//            "cur_page"=>1,
//            "data"=>[]
//        ];
//
//        if($request->getSession()->get("access_token")) {
//            $access_token = $request->getSession()->get("access_token");
//            $id = isset($access_token["id"])?$access_token["id"]:null;
//            if($id && $id>=0){
//                $user = $em->getRepository($access_token["class"])->find($id);
//                if($user){
//                    $reseller = $user->getReseller();
//                    $channelsId=[-1];
//                    $subscriptions = $em->getRepository('AppBundle:Subscriptions')->findBy(array("expired"=>false,"user"=>$reseller,"productType"=>"channel"));
//                    foreach ($subscriptions as $subscription) {
//                        $channelsId[]=$subscription->getProductId();
//                    }
//                    $channelsPackagesId=[];
//                    $subscriptions = $em->getRepository('AppBundle:Subscriptions')->findBy(array("expired"=>false,"user"=>$reseller,"productType"=>"channels_package"));
//                    foreach ($subscriptions as $subscription) {
//                        $channelsPackagesId[]=$subscription->getProductId();
//                    }
//
//                    foreach ($channelsPackagesId as $package) {
//                        $packageEntity = $em->getRepository('AppBundle:ChannelsPackage')->find($package);
//                        if($packageEntity){
//                            foreach ($packageEntity->getChannels() as $ch) {
//                                if(!in_array($ch->getId(),$channelsId)){
//                                    $channelsId[]=$ch->getId();
//                                }
//                            }
//                        }
//                    }
//
//                    $channels = $em->createQueryBuilder("c")
//                        ->select("c")
//                        ->from("AppBundle:Channel","c")
//                        ->where("c.enabled = true $criteria AND ( c.owner = :owner OR c.id in (:subscriptions) )")
//                        ->setParameter("owner",$reseller->getId())
//                        ->setParameter("subscriptions",$channelsId)
//                        ->orderBy($sortby,"ASC")
////                        ->setMaxResults($page_items)
////                        ->setFirstResult($page*$page_items)
//                        ->getQuery()
//                        ->getResult();
//
//                    if ($page == 0){
//                        $page = 1;
//                    }
//
//                    $js = [
//                        "total_items"=>count($channels),
//                        "max_page_items"=>$page_items,
//                        "selected_item"=>0,
//                        "cur_page"=>$page,
//                        "data"=>[]
//                    ];
//                    $channels = array_slice($channels, ($page-1)*$page_items, $page_items);
//
//                    foreach ($channels as $channel) {
//                        $js["data"][]=[
//                            'allow_local_pvr'=> "",
//                            'allow_local_timeshift'=>"0",
//                            'allow_pvr'=>"",
//                            'archive'=>0,
//                            'base_ch'=>"0",
//                            'bonus_ch'=>"0",
//                            'censored'=>"0",
//                            'cmd'=>$channel->getLive(),
//                            'cmd_1'=>"",
//                            'cmd_2'=>"",
//                            'cmd_3'=>"",
//                            'cmds'=>[
//                                'ch_id'=>"1",
//                                'changed'=>"0000-00-00 00:00:00",
//                                'enable_balancer_monitoring'=>0,
//                                'flussonic_tmp_link'=>0,
//                                'id'=>0,
//                                'nginx_secure_link'=>0,
//                                'priority'=>0,
//                                'status'=>0,
//                                'url'=>$channel->getLive(),
//                                'use_http_tmp_link'=>0,
//                                'use_load_balancing'=>0,
//                                'user_agent_filter'=>0,
//                                'wowza_tmp_link'=>0
//                            ],
//                            'correct_time'=>"0",
//                            'count'=>"0",
//                            'created'=>"0000-00-00 00:00:00",
//                            'cur_playing'=>[],
//                            'enable_monitoring'=>"0",
//                            'enable_tv_archive'=>"0",
//                            'enable_wowza_load_balancing'=>"0",
//                            'epg'=>[],
//                            'fav'=>0,
//                            'genres_str'=>"",
//                            'hd'=>"0",
//                            'id'=>$channel->getId(),
//                            'lock'=>0,
//                            'logo'=>"../../../../uploads/".$channel->getLogo(),
//                            'mc_cmd'=>"",
//                            'modified'=>null,
//                            'monitoring_status'=>"0",
//                            'monitoring_status_updated'=>null,
//                            'name'=>$channel->getName(),
//                            'nginx_secure_link'=>"0",
//                            'number'=>$channel->getId(),
//                            'open'=>1,
//                            'pvr'=>0,
//                            'service_id'=>"",
//                            'tv_archive_duration'=>"168",
//                            'tv_genre_id'=>$channel->getCategory()->getId(),
//                            'use_http_tmp_link'=>0,
//                            'use_load_balancing'=>0,
//                            'wowza_dvr'=>"0",
//                            'wowza_tmp_link'=>0,
//                        ];
//                    }
//
//                }
//            }
//        }
//        return $this->response($js,"");
//    }

    public function get_short_epgAction(Request $request){
        $em = $this->container->get("doctrine.orm.entity_manager");
        $id = $request->get("ch_id");

        $currentProgramme = $em->createQueryBuilder("p")
            ->select("p")
            ->from("AppBundle:Programme","p")
            ->leftJoin("p.channel","ec")
            ->where("ec.channel = :ch_id")
            ->andWhere("p.startAt<=:start")
            ->setParameter("ch_id",$id)
            ->setParameter("start",new \DateTime("now"))
            ->orderBy("p.startAt","DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        if(!$currentProgramme){
            return $this->response([],"");
        }


        $programmes = $em->createQueryBuilder("p")
            ->select("p")
            ->from("AppBundle:Programme","p")
            ->leftJoin("p.channel","ec")
            ->where("ec.channel = :ch_id")
            ->andWhere("p.startAt>=:start")
            ->setParameter("ch_id",$id)
            ->setParameter("start",$currentProgramme[0]->getStartAt())
            ->orderBy("p.startAt","DESC")
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        $js=[];
        foreach ($programmes as $programme) {
            $js[]=[
                "mark_memo"=>0,
                "mark_archive"=>$programme->getEndAt()<= new \DateTime("now")?1:0,
                "id"=>$programme->getId(),
                "duration"=>$programme->getDuration(),
                "name"=>$programme->getTitle(),
                "category"=>$programme->getCategory(),
                "t_time"=>$programme->getStartAt()->format("H:i")
            ];
        }
        return $this->response($js,"");
    }

}

