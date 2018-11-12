<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Entity\ChannelCategories;
use Dmcl\AppBundle\Entity\ChannelsPackage;
use Dmcl\AppBundle\Entity\Customers;
use Dmcl\AppBundle\Form\ChannelTranscoderType;
use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Form\ChannelType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Store controller.
 *
 */
class StoreController extends Controller
{

    public function channelsForSaleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $channels = $em->getRepository('AppBundle:Channel')->findBy(array("enabled" => true, "owner" => "admin"));
        return $this->render('AppBundle:themes/default/Store:channels-for-sale.html.twig', array('entities' => $channels));
    }

    public function channelsPackageForSaleAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl("home"));
        }
        $em = $this->getDoctrine()->getManager();
        $packages = $em->getRepository('AppBundle:ChannelsPackage')->findForSale();
        return $this->render('AppBundle:themes/default/Store:channels-package-for-sale.html.twig', array('entities' => $packages));
    }

    public function vodForSaleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $vods = $em->getRepository('AppBundle:Vod')->findBy(array("enabled" => true, "owner" => "admin"));
        return $this->render('AppBundle:themes/default/Store:vod-for-sale.html.twig', array('entities' => $vods));
    }

    public function vodPackagesForSaleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $packages = $em->getRepository('AppBundle:VodPackage')->findForSale();
        return $this->render('AppBundle:themes/default/Store:vod-packages-for-sale.html.twig', array('entities' => $packages));
    }

    public function shoppingCartAction(Request $request)
    {
        $productsSupported = array(
            "channel" => $this->get("translator")->trans("cart.types.channel"),
            "channels_package" => $this->get("translator")->trans("cart.types.channels_package"),
            "vod" => $this->get("translator")->trans("cart.types.vod"),
            "vod_package" => $this->get("translator")->trans("cart.types.vod_package"),
        );
        $car = $request->getSession()->get("cart_products");
        if (!$car) {
            $car = array();
        }
        return $this->render("AppBundle:themes/default/Store:shopping-cart.html.twig", array("cart" => $car, "types" => $productsSupported));

    }

    public function chackOutAction(Request $request)
    {
        $productsSupported = array(
            "channel" => $this->get("translator")->trans("cart.types.channel"),
            "channels_package" => $this->get("translator")->trans("cart.types.channels_package"),
            "vod" => $this->get("translator")->trans("cart.types.vod"),
            "vod_package" => $this->get("translator")->trans("cart.types.vod_package"),
        );
        $car = $request->getSession()->get("cart_products");
        if (!$car) {
            $car = array();
        }
        return $this->render("AppBundle:themes/default/Store:checkout.html.twig", array("cart" => $car, "types" => $productsSupported));
    }

    /*
     * Activation Code
     */
    public function activationCodeForSaleAction($code)
    {
        $em = $this->getDoctrine()->getManager();
        $activationCode = $em->getRepository("AppBundle:ActivationCode")->findOneBy(array("code" => $code));

        $packages = $activationCode->getChannelsPackage();
        $channels = array();
        /**
         * @var ChannelsPackage $package
         */
        foreach ($packages as $package) {
            /**
             * @var Channel $channel
             */
            foreach ($package->getChannels() as $channel) {
                $channels[] = array(
                    'name' => $channel->getName(),
                    'category' => $channel->getCategory()->getName(),
                    'logo' => $channel->getLogo()
                );
            }
        }

//        $package->getName();
//        $package->getDescription();
//        $package->getPrice();
//        $package->getSubscriptionPeriod();
//        $package->getSubscriptionInterval();
//
//        /**
//         * @var Channel $channel
//         */
//        $channel = $package->getChannels();
//        $channel->getName();
//        /**
//         * @var ChannelCategories $category
//         */
//        $category = $channel->getCategory();
//        $category->setName();
//        $channel->getDescription();
//        $channel->getLogo();
//
//        /**
//         * @var Customers $customer
//         */
//        $customer = $activationCode->getCustomer();
//        $customer->getName();
//        $customer->getEmail();
//        $customer->getCode();

//        $customer = $acticationCode->getCustomer();
//        $email = $acticationCode->getCustomer()->getPaypalId();

        return $this->render(
            "@App/themes/default/Store/activation-code-for-sale.html.twig",
            array("data" => $activationCode, 'channels' => $channels)
        );
    }

}
