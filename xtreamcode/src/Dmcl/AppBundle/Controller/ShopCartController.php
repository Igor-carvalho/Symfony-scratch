<?php

namespace Dmcl\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\BillingConfiguration;
use Dmcl\AppBundle\Form\BillingConfigurationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * ShopCar controller.
 *
 */
class ShopCartController extends Controller
{

    public function addProductAction(Request $request){
        $car = $request->getSession()->get("cart_products");
        if(!$car){
            $car = array();
        }
        if(!isset($car[$request->get("_type")])){
            $car[$request->get("_type")]=array();
        }
        if(!isset($car[$request->get("_type")][$request->get("_product")])){
            $car[$request->get("_type")][$request->get("_product")]=array();
            $car[$request->get("_type")][$request->get("_product")]["total"]=1;
            $car[$request->get("_type")][$request->get("_product")]["details"]=array(
                "name"=>$request->get("_name"),
                "price"=>$request->get("_price"),
                "dicountCode"=>$request->get("_discountCode"),
                "dicountValue"=>$request->get("_discountValue"),
                "image"=>$request->get("_image")
            );
        }else{
            $car[$request->get("_type")][$request->get("_product")]["total"]+=1;
        }
        $request->getSession()->set("cart_products",$car);

//      setcookie("besttranscoder-shop-cart", base64_encode($this->renderCart($car)), null, "/");
//        return new Response(json_encode($car),200);
        return $this->renderCart($car);
    }


    private  function renderCart($car){

        $productsSupported = array(
            "channel" =>  $this->get("translator")->trans("cart.types.channel"),
            "channels_package" => $this->get("translator")->trans("cart.types.channels_package"),
            "vod" => $this->get("translator")->trans("cart.types.vod"),
            "vod_package" => $this->get("translator")->trans("cart.types.vod_package"),
        );

        return $this->render("AppBundle:themes/default/Store:cart.html.twig",array("cart"=>$car,"types"=>$productsSupported));
    }

    public function removeProductAction(Request $request){
        $car = $request->getSession()->get("cart_products");
        if(!$car){
            $car = array();
        }
        if(!isset($car[$request->get("_type")])){
            $car[$request->get("_type")]=array();
        }
        if(isset($car[$request->get("_type")][$request->get("_product")])){
            unset($car[$request->get("_type")][$request->get("_product")]);
            if(count($car[$request->get("_type")])==0){
                unset($car[$request->get("_type")]);
            }
        }
        $request->getSession()->set("cart_products",$car);
//        setcookie("besttranscoder-shop-cart", base64_encode($this->renderCart($car)), null, "/");
//        return new Response(json_encode($car),200);
        return $this->renderCart($car);
    }

    public function getCarAction(Request $request){
        $car = $request->getSession()->get("cart_products");
        if(!$car){
            $car = array();
        }
        return new Response(json_encode($car),200);
    }

    public function clearCarAction(Request $request){
        if (!$this->getUser()) {
            throw new AccessDeniedHttpException();
        }
        $request->getSession()->set("cart_products", array());
        $car = $request->getSession()->get("cart_products");
//        setcookie("besttranscoder-shop-cart", base64_encode($this->renderCart($car)), null, "/");
//        return new Response(json_encode($car),200);
        return $this->renderCart($car);
    }

}
