<?php

namespace Dmcl\StbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    private $types;

    function __construct()
    {
        $this->types=array(
            "stb"=> new StbController(),
            "vod"=> new VodController(),
            "itv"=> new TvController(),
            "epg"=> new EpgController(),
        );
    }


    public function indexAction($name)
    {
        return $this->render("StbBundle:default:index.html.twig");
    }


    public function handleAction(Request $request){

        $response = array(
            "js"=>array(),
            "text"=>""
        );
        if(isset($this->types[$request->get("type")])){
            if(method_exists($this->types[$request->get("type")],$request->get("action")."Action")){
                $type= ucfirst($request->get("type"));
                if($type=="Itv"){
                    $type ="Tv";
                }
                $action = $request->get("action");
                return $this->forward("StbBundle:$type:$action",array(),$request->query->all());
            }
        }
        return new Response(json_encode($response));
    }



}

