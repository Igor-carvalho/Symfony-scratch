<?php

namespace Dmcl\StbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{

    public function response($js,$txt,$code=200){
        $response = array(
            "js"=>$js,
            "text"=>$txt
        );
        return new Response(json_encode($response),$code);
    }


}

