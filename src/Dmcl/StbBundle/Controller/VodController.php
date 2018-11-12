<?php

namespace Dmcl\StbBundle\Controller;
use Dmcl\StbBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VodController extends Controller
{

    public function get_categoriesAction(Request $request){
//       die(var_dump($request->headers->all()));
        $em = $this->container->get("doctrine.orm.entity_manager");
        $categories = $em->getRepository('AppBundle:VodGenres')->findByEnabled(true);
        $js = array();
        $js[]=array("id"=>"*","title"=>"All","alias"=>"All");
        foreach ($categories as $category) {
            $js[]=array("id"=>$category->getId(),"title"=>$category->getName(),"alias"=>$category->getName());
        }
        return $this->response($js,"");
    }

    public function get_ordered_listAction(Request $request){
        $em = $this->container->get("doctrine.orm.entity_manager");
//        $sortby = $request->get("sortby")=="added"?"v.id":"v.name";
//        $criteria = $request->get("category")=="*" ? "":"v.genre=".$request->get("category");
        $genre = $request->get("category");
        $page = $request->get('p');
        $page_items = 14;

        $js = [
            "total_items"=>0,
            "max_page_items"=>0,
            "selected_item"=>0,
            "cur_page"=>1,
            "data"=>[]
        ];


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
                    $vods=[];
                    foreach ($user->getPlaylists() as $playlist) {
                        $now = new \DateTime("now");
                        $expire =  new \DateTime($playlist->getExpireAt());
                        if($expire > $now){
                            foreach ($playlist->getVods() as $vod) {
                                if($vod->getEnabled() && ($genre==$vod->getGenre()->getId() || $genre == "*")){
                                    $vods[$vod->getId()]=$vod;
                                }
                            }
                            foreach ($playlist->getVodPackages() as $package) {
                                foreach ($package->getVods() as $vod) {
                                    if(!isset($vods[$vod->getId()])){
                                        if($vod->getEnabled() && ($genre==$vod->getGenre()->getId() || $genre == "*")){
                                            $vods[$vod->getId()]=$vod;
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $js = [
                        "total_items"=>count($vods),
                        "max_page_items"=>$page_items,
                        "selected_item"=>0,
                        "cur_page"=>$page,
                        "data"=>[]
                    ];
                    $vods = array_slice($vods, ($page-1)*$page_items, $page_items);

                    foreach ($vods as $vod) {

                        $source = $this->container->get("app.stream.security.services")->secureVod($vod,null,$user->getId(),new \DateTime("now + 1 day"));
                        if($source){
                            $js["data"][]=[
                                "director"=>$vod->getDirector(),
                                "id"=>$vod->getId(),
                                "screenshot_uri"=>$this->generateUrl('_home', array(), true) .'uploads/' . $vod->getCover(),
                                "description"=>$vod->getDescription()?$vod->getDescription():"-",
                                "time"=>$vod->getDuration(),
                                "cmd"=>$source,
                                "name"=>$vod->getTitle(),
                                "o_name"=>$vod->getGenre()->getName(),
                                "year"=>$vod->getYear(),
                                "actors"=>"-",
                                "genres_str"=>$vod->getGenre()->getName(),
                                "lock"=>0,
                                "for_rent"=>0,
                                "low_quality"=>0,
                                "open"=>1,
                                "series"=>[],
                            ];
                        }
                    }
                }
            }
        }
        return $this->response($js,"");
    }

//
//    public function get_ordered_listForResellersAction(Request $request){
//        $em = $this->container->get("doctrine.orm.entity_manager");
//        $sortby = $request->get("sortby")=="added"?"v.id":"v.name";
//        $criteria = $request->get("category")=="*" ? "":"v.genre=".$request->get("category");
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
//                    $vodsId=[-1];
//                    $subscriptions = $em->getRepository('AppBundle:Subscriptions')->findBy(array("expired"=>false,"user"=>$reseller,"productType"=>"vod"));
//                    foreach ($subscriptions as $subscription) {
//                        $vodsId[]=$subscription->getProductId();
//                    }
//                    $vodPackagesId=[];
//                    $subscriptions = $em->getRepository('AppBundle:Subscriptions')->findBy(array("expired"=>false,"user"=>$reseller,"productType"=>"vod_package"));
//                    foreach ($subscriptions as $subscription) {
//                        $vodPackagesId[]=$subscription->getProductId();
//                    }
//
//                    foreach ($vodPackagesId as $package) {
//                        $packageEntity = $em->getRepository('AppBundle:VodPackage')->find($package);
//                        if($packageEntity){
//                            foreach ($packageEntity->getVods() as $vod) {
//                                if(!in_array($vod->getId(),$vodsId)){
//                                    $vodsId[]=$vod->getId();
//                                }
//                            }
//                        }
//                    }
//
//                    $vods = $em->createQueryBuilder("v")
//                        ->select("v")
//                        ->from("AppBundle:Vod","v")
//                        ->where("v.enabled = true $criteria AND ( v.owner = :owner OR v.id in (:subscriptions) )")
//                        ->setParameter("owner",$reseller->getId())
//                        ->setParameter("subscriptions",$vodsId)
//                        ->orderBy($sortby,"ASC")
////                        ->setMaxResults($page_items)
////                        ->setFirstResult($page*$page_items)
//                        ->getQuery()
//                        ->getResult();
//
//
//                    if ($page == 0){
//                        $page = 1;
//                    }
//
//                    $js = [
//                        "total_items"=>count($vods),
//                        "max_page_items"=>$page_items,
//                        "selected_item"=>0,
//                        "cur_page"=>$page,
//                        "data"=>[]
//                    ];
//                    $vods = array_slice($vods, ($page-1)*$page_items, $page_items);
//
//                    foreach ($vods as $vod) {
//                        $js["data"][]=[
//                            "director"=>$vod->getDirector(),
//                            "id"=>$vod->getId(),
//                            "screenshot_uri"=>$this->generateUrl('_home', array(), true) .'uploads/' . $vod->getCover(),
//                            "description"=>$vod->getDescription()?$vod->getDescription():"-",
//                            "time"=>$vod->getDuration(),
//                            "cmd"=>$vod->getSource(),
//                            "name"=>$vod->getTitle(),
//                            "o_name"=>$vod->getGenre()->getName(),
//                            "year"=>$vod->getYear(),
//                            "actors"=>"-",
//                            "genres_str"=>$vod->getGenre()->getName(),
//                            "lock"=>0,
//                            "for_rent"=>0,
//                            "low_quality"=>0,
//                            "open"=>1,
//                            "series"=>[],
//                        ];
//                    }
//                }
//            }
//        }
//        return $this->response($js,"");
//
//    }

    public function get_yearsAction(Request $request){
        $em = $this->container->get("doctrine.orm.entity_manager");
        $vods = $em->getRepository('AppBundle:Vod')->findAll();
        $years = [];
        foreach ($vods as $vod) {
            $years[]=["id"=>$vod->getYear(),"title"=>$vod->getYear()];

        }

        return $this->response($years,"");
    }

}

