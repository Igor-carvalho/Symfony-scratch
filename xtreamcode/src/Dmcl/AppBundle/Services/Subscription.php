<?php

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\Subscriptions;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Description of Subscription
 *
 * @author dmanuelcl@gmail.com
 */
class Subscription {

    private $container;

    function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function createFromOrder($order){
        $em = $this->container->get("doctrine.orm.entity_manager");

        if(!$order->getVerified()){
            $now = new \DateTime("now");
            if($now < $order->getExpireAt()){
                $products = $order->getProducts();

                $customer = $em->getRepository('AppBundle:User')->find($order->getCustomer());
                if($customer){
                    foreach($products as $type => $productsList){
                        foreach($productsList as $product){
                            $this->createSubscription($customer,$type,$product["id"]);
                        }
                    }
                    $em->flush();
                }

                $order->setVerified(true);
                $order->setVerifiedAt(new \DateTime("now"));
                $em->flush();
            }
        }
    }

    public function createSubscription($customer,$type,$id,$forTest=false){
        $productsSupported = $this->container->getParameter("medias_support");
        $em = $this->container->get("doctrine.orm.entity_manager");
        $productEntity = $em->getRepository('AppBundle:'.$productsSupported[$type])->find($id);
        $expireAt = new \DateTime("now + ".($forTest?$productEntity->getSubscriptionPeriodForTest():$productEntity->getSubscriptionPeriod())." ".($forTest?$productEntity->getSubscriptionIntervalForTest():$productEntity->getSubscriptionInterval()));
        if($productEntity){
            if($forTest){
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "productId"=>$productEntity->getId(),
                    "productType"=>$type,
                    "forTest"=>true
                ));
                if($subscription){
                    return;
                }else{
                    $subscription = new Subscriptions();
                }
            }else{
                $oldSubscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "productId"=>$productEntity->getId(),
                    "productType"=>$type,
                    "expired"=>false,
                    "forTest"=>true
                ));
                if($oldSubscription){
                    $oldSubscription->setExpired(true);
                    $em->flush();
                }
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "productId"=>$productEntity->getId(),
                    "productType"=>$type,
                    "forTest"=>false
                ));
                if(!$subscription){
                    $subscription = new Subscriptions();
                }
            }
            $subscription->setExpireAt($expireAt);
            $subscription->setUser($customer);
            $subscription->setProductId($productEntity->getId());
            $subscription->setExpired(false);
            $subscription->setForTest($forTest);
            $subscription->setProductType($type);
            $em->persist($subscription);
            $em->flush();
        }
    }
}
