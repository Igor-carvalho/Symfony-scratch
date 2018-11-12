<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\Ads;
use Dmcl\AppBundle\Form\AdsType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Statistics controller.
 *
 */
class StatisticsController extends Controller
{

    public function channelsAction(Request $request){
        $em = $this->getDoctrine()->getManager();
		
		$result = json_decode($this->get("app.util.services")->ega123Obfuscated($em));
	
		if($result->code == 0)
		  return $this->render('AppBundle:themes/default/Home:errorconnection.html.twig');
		else if($result->code == 2)
		        return $this->redirectToRoute('validate');
		else if($result->code == 3)	
				return $this->redirectToRoute('validate');
        $totalPlayback = $em->getRepository('AppBundle:PlayBackHistory')->mediaTotalPlayback("channel");
        $totalPlaying = $em->getRepository('AppBundle:PlayBackHistory')->mediaTotalPlaying("channel");
        $totalSales = $em->getRepository('AppBundle:Subscriptions')->getTotalSalesByType("channel");
        $salesData = $em->getRepository('AppBundle:Subscriptions')->totalForDashboard("channel");
        return $this->render("AppBundle:themes/default/Admin/Statistics:channels.html.twig",array(
            "totalSales"=>$totalSales,
            "totalPlayback"=>$totalPlayback,
            "totalPlaying"=>$totalPlaying,
            "salesData"=>$salesData,
        ));
    }

    public function vodAction(Request $request){

        $em = $this->getDoctrine()->getManager();
		
		$result = json_decode($this->get("app.util.services")->ega123Obfuscated($em));
	
		if($result->code == 0)
		  return $this->render('AppBundle:themes/default/Home:errorconnection.html.twig');
		else if($result->code == 2)
		        return $this->redirectToRoute('validate');
		else if($result->code == 3)	
				return $this->redirectToRoute('validate');
        $totalPlayback = $em->getRepository('AppBundle:PlayBackHistory')->mediaTotalPlayback("vod");
        $totalPlaying = $em->getRepository('AppBundle:PlayBackHistory')->mediaTotalPlaying("vod");
        $totalSales = $em->getRepository('AppBundle:Subscriptions')->getTotalSalesByType("vod");
        $salesData = $em->getRepository('AppBundle:Subscriptions')->totalForDashboard("vod");
        return $this->render("AppBundle:themes/default/Admin/Statistics:vod.html.twig",array(
            "totalSales"=>$totalSales,
            "totalPlayback"=>$totalPlayback,
            "totalPlaying"=>$totalPlaying,
            "salesData"=>$salesData,
        ));
    }

    public function playbackWordAction(Request $request,$type){
        $em = $this->getDoctrine()->getManager();
		
        $mapData=array();
        $countries = $em->getRepository('AppBundle:CountryPlaybackHistory')->findByMediaType($type);
        foreach ($countries as $country) {
            if(!isset($mapData[strtolower($country->getCountry())])){
                $mapData[strtolower($country->getCountry())]=0;
            }
            $mapData[strtolower($country->getCountry())]+=$country->getTotal();
        }

        return new Response(json_encode($mapData),200);
    }
}
