<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Entity\ActivationCodeHistory;
use Dmcl\AppBundle\Entity\ChannelsPackage;
use Dmcl\AppBundle\Entity\CustomerOrders;
use Dmcl\AppBundle\Entity\TicketsResellers;
use Dmcl\AppBundle\Entity\TicketsRepliesResellers;
use Dmcl\AppBundle\Entity\Customers;
use Dmcl\AppBundle\Entity\Orders;
use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\Subscriptions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Stripe\Stripe;

class PaymentsController extends Controller
{

    public function payAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('home'));
        }

        $em = $this->getDoctrine()->getManager('xtreamcode');

        $customer = $this->getUser();
        $id = $request->get("id");
        
        $product = $em->getRepository('AppBundle:PackagesLocal')->findOneById($id);

        $productsStore[] = [
            "id" => $product->getId(),
            "displayName" => $product->getName(),
            "credits" => $product->getCredits(),
            "superReseller" => $product->getSuperReseller()?'Yes':'No',
            "count" => 1,
            "unitPrice" => $product->getPrice(),
            "discount" => 0
        ];
        
        $request->getSession()->set("cart_products", array());

        $gateway = $request->get("gateway");

        $gatewayEntity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName($gateway);

        if (!$gatewayEntity) {
            throw $this->createNotFoundException($this->get("translator")->transChoice("pages.billing.payment.gateways.404", 0, array("%gateway%" => $gateway)));
        }

        $billingConfig = $em->getRepository('AppBundle:BillingConfiguration')->findOneBy(array());
        if (!$billingConfig) {
            throw $this->createNotFoundException($this->get("translator")->trans("pages.billing_config.unconfigured"));
        }

        $order = new Orders();
        if (count($productsStore) > 0) {
            $order->setAmount($productsStore[0]['unitPrice']);
            $order->setAmountReal($productsStore[0]['unitPrice']);
            $order->setDiscount(0);
            $order->setCustomer($customer->getId());
            $order->setCustomerEmail($customer->getEmail());
            $order->setCustomerName($customer->getUsername());
            $order->setExpireAt(new \DateTime("now + " . $billingConfig->getOrdersTtl() . " " . $billingConfig->getOrdersTtlInterval()));
            $order->setProducts($productsStore);
            $order->setGateway($gatewayEntity);
            $order->setCurrency($billingConfig->getCurrency());

            $em->persist($order);
            $em->flush();
            
            $ticket = new TicketsResellers();
            $replies = new TicketsRepliesResellers();

            $message = "Hellow. I bought a package named '" . $productsStore[0]['displayName'] . "'. The transactionId to the order is: " . $order->getTransactionId();

            $ticket->setTo($this->getUser()->getOwnerId());
            $ticket->setFrom($this->getUser()->getId());
            $ticket->setIssue("Payments");
        
            $em->persist($ticket);
            $em->flush();

            $replies->setTicket($ticket);
            $replies->setMessage($message);
        
            $em->persist($replies);
            $em->flush();
        }

        $array = ['order' => $order, 'config' => $billingConfig, 'gateway' => $gatewayEntity];

        if ($gatewayEntity->getUniqueName() == "creditcard") {
            return $this->creditCardCheckAction($request, $order, $gatewayEntity, $billingConfig->getCurrency());
        }

        return $this->render("AppBundle:themes/default/Admin/Gateways/submit:$gateway.html.twig", $array);
    }

    function successAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $message = $this->get('translator')->trans('pages.billing.payment.purchase.success');
        $this->get('session')->getFlashBag()->add('success', $message);

        return $this->redirect($this->generateUrl('home'));
    }

    function errorAction(Request $request)
    {
        return $this->render('AppBundle:themes/default/Admin/Billing:error.html.twig');
    }

    public function paypalCheckAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
       
        $order = $em->getRepository('AppBundle:Orders')->findOneBy([
            "transactionId" => $request->get('item_number'), 
            "verified" => false
        ]);

        if ($order) {
            $isValid = $this->get('app.payments.paypal')->processIpn();

            if ($isValid) {
                return $this->buySuccess($request, $order);
            }
        }
        return $this->buyFaild($request);
    }

    public function moneybookersCheckAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');		
		
        $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName("moneybookers");

        if ($entity) {
            $isValid = $this->get('app.payments.moneybookers')->processIpn($entity->getShopIdPublicKey(), $entity->getSecretKey());

            if ($isValid) {
                $order = $em->getRepository('AppBundle:Orders')->findOneBy([
                    "transactionId" => $request->get('transaction_id'),
                    "verified" => false
                ]);

                if ($order) {
                    return $this->buySuccess($request, $order);
                }
            }
        }
        return $this->buyFaild($request);
    }

    public function interkassaCheckAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');		
		
        $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName("interkassa");

        if ($entity) {
            $isValid = $this->get('app.payments.interkassa')->processIpn($entity->getShopIdPublicKey(), $entity->getSecretKey());

            if ($isValid) {
                $order = $em->getRepository('AppBundle:Orders')->findOneBy([
                    "transactionId" => $request->get('ik_payment_id'),
                    "verified" => false
                ]);

                if ($order) {
                    return $this->buySuccess($request, $order);
                }
            }
        }
        return $this->buyFaild($request);
    }

    public function webmoneyCheckAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager('xtremcode');
		
        $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName("webmoney");

        if ($entity) {
            $order = $em->getRepository('AppBundle:Orders')->findOneBy([
                "transactionId" => $request->get('LMI_PAYMENT_NO'),
                "verified" => false
            ]);

            if ($order) {
                $webmoney = $this->get('app.payments.webmoney');

                if ($webmoney->processIpn() != 2) {
                    if ($webmoney->CheckMD5($entity->getShopIdPublicKey(), $order->getAmount(), $order->getTransactionId(), $entity->getSecretKey()) == 0) {
                        return $this->buySuccess($request, $order);
                    }
                }
            }
        }
        return $this->buyFaild($request);
    }

    public function onPayCheckAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');		
		
        $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName("onpay");
        $order = $em->getRepository('AppBundle:Orders')->findOneBy([
            "transactionId" => $request->get('pay_for'),
            "verified" => false
        ]);

        if ($entity && $order) {
            $isValid = $this->get('app.payments.onpay')->processIpn($entity->getSecretKey(), $order->to_float(), $order->getCurrency(), $order->getTransactionId(), $order->getAmount());

            if ($isValid) {
                return $this->buySuccess($request, $order);
            }
        }
        return $this->buyFaild($request);
    }

    public function creditCardCheckAction(Request $request, $order, $gateway, $currency)
    {                
        try {
            $message = $this->get('translator')->trans('pages.billing.payment.purchase.success');

            Stripe::setApiKey($gateway->getSecretKey());

            $response = Stripe/Stripe_Charge::create(
                array(
                    "amount" => $order->getAmount() * 100,
                    "currency" => $currency,
                    "card" => $request->get("stripeToken"),
                    "description" => $message)
            );

            return $this->buySuccess($request, $order);
        } catch (\Exception $e) {
            return $this->buyFaild($request, $this->get('translator')->trans('pages.billing.payment.purchase.error'));
        }
    }

    public function buySuccess(Request $request, $order)
    {
        $em = $this->getDoctrine()->getManager();		
		
        if (!$order->getVerified()) {
            $now = new \DateTime("now");

            if ($now < $order->getExpireAt()) {
                //$this->get("app.subscriptions.services")->createFromOrder($order);
                $order->setVerified(true);
                $order->setVerifiedAt(new \DateTime("now"));

                $em->flush();

                return $this->redirect($this->generateUrl('payments_success'));
            }
        }

        $message = $this->get('translator')->trans('pages.billing.payment.purchase.error');
        return $this->buyFaild($request, $message);

    }

    /*
    Create subsription if amount is free
    */
    public function addSubscriptionsAction(Request $request, $type, $id)
    {		
        $referer = $request->headers->get('referer');
        $em = $this->getDoctrine()->getManager();
        $customer = $this->getUser();
        $this->get("app.subscriptions.services")->createSubscription($customer, $type, $id);
        return $this->redirect($referer);

    }

    public function buyFaild(Request $request, $msg = null)
    {
        return $this->render('AppBundle:themes/default/Admin/Billing:error.html.twig', array("msg" => $msg ? $msg : $this->get('translator')->trans('pages.billing.payment.purchase.error')));
    }

    /*
     * Activation Code Payment
     */
    public function payActivationCodeAction(Request $request)
    {
        $code = $request->get('code');
        $em = $this->getDoctrine()->getManager();
        $activationCode = $em->getRepository("AppBundle:ActivationCode")->findOneBy(array("code" => $code));

        $customer = $activationCode->getCustomer();
        $name = $customer->getName();
        $paypalId = $customer->getPaypalId();

        if (!$paypalId) {
            throw $this->createNotFoundException($this->get("translator")->trans("pages.paypal.not_found"));
        }

        $billingConfig = $em->getRepository('AppBundle:BillingConfiguration')->findOneBy(array());
        if (!$billingConfig) {
            throw $this->createNotFoundException($this->get("translator")->trans("pages.billing_config.unconfigured"));
        }

        $packages = $activationCode->getChannelsPackage();
        $amount = 0;
        /**
         * @var ChannelsPackage $package
         */
        foreach ($packages as $package) {
            $amount += $package->getPrice();
        }

        $gateway = $em->getRepository("AppBundle:Gateways")->findOneBy(array("uniqueName" => 'paypal'));

        $order = new CustomerOrders();
        if (count($packages) > 0) {
            $order->setAmount($amount);
            $order->setAmountReal($amount);
            $order->setDiscount(0);
            $order->setCustomer($customer);
            $order->setCustomerEmail($customer->getEmail());
            $order->setCustomerName($customer->getName());
            $order->setExpireAt(new \DateTime("now + " . $billingConfig->getOrdersTtl() . " " . $billingConfig->getOrdersTtlInterval()));
            $order->setCode($code);
            $order->setGateway($gateway);
            $order->setCurrency($billingConfig->getCurrency());

            $em->persist($order);
            $em->flush();
        }

        return $this->render(
            "AppBundle:themes/default/Admin/Gateways/submit:paypal_for-activation-code.html.twig",
            array('order' => $order, 'config' => $billingConfig, 'paypal' => $paypalId)
        );
    }
    /*
     * Pay Activation Code Payment Credit Card
     */
    public function payCreditCardActivationCodeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		        
        $code = $request->get('code');
        
        $activationCode = $em->getRepository("AppBundle:ActivationCode")->findOneBy(array("code" => $code));

        $customer = $activationCode->getCustomer();
        $name = $customer->getName();
//        $paypalId = $customer->getPaypalId();
//
//        if (!$paypalId) {
//            throw $this->createNotFoundException($this->get("translator")->trans("pages.paypal.not_found"));
//        }

        $billingConfig = $em->getRepository('AppBundle:BillingConfiguration')->findOneBy(array());
        if (!$billingConfig) {
            throw $this->createNotFoundException($this->get("translator")->trans("pages.billing_config.unconfigured"));
        }

        $packages = $activationCode->getChannelsPackage();
        $amount = 0;
        /**
         * @var ChannelsPackage $package
         */
        foreach ($packages as $package) {
            $amount += $package->getPrice();
        }

        $gateway = $em->getRepository("AppBundle:Gateways")->findOneBy(array("uniqueName" => 'creditcard'));

        $order = new CustomerOrders();
        if (count($packages) > 0) {
            $order->setAmount($amount);
            $order->setAmountReal($amount);
            $order->setDiscount(0);
            $order->setCustomer($customer);
            $order->setCustomerEmail($customer->getEmail());
            $order->setCustomerName($customer->getName());
            $order->setExpireAt(new \DateTime("now + " . $billingConfig->getOrdersTtl() . " " . $billingConfig->getOrdersTtlInterval()));
            $order->setCode($code);
            $order->setGateway($gateway);
            $order->setCurrency($billingConfig->getCurrency());

            $em->persist($order);
            $em->flush();
        }

        return $this->creditCardCheckAction($request, $order, $gateway, $billingConfig->getCurrency());
//        return $this->render(
//            "AppBundle:themes/default/Admin/Gateways/submit:paypal_for-activation-code.html.twig",
//            array('order' => $order, 'config' => $billingConfig, 'creditcard' => $gateway)
//        );
    }

    public function paymentSuccessForActivationCodeAction() {        
        $message = $this->get('translator')->trans('pages.billing.payment.purchase.success');
        $this->get('session')->getFlashBag()->add('success', $message);
        return $this->redirect($this->generateUrl('home'));
    }

    function paymentErrorForActivationCodeAction(Request $request)
    {        
        return $this->render('AppBundle:themes/default/Admin/Billing:error.html.twig');
    }

    public function paypalCheckForActivationCodeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();		
		
        $order = $em->getRepository('AppBundle:CustomerOrders')->findOneBy(
            array("transactionId" => $request->get('item_number'),
                "verified" => false)
        );
        if ($order) {
            $isValid = $this->get('app.payments.paypal')->processIpn();
            if ($isValid) {
                $em = $this->getDoctrine()->getManager();

                if (!$order->getVerified()) {
                    $now = new \DateTime("now");
                    if ($now < $order->getExpireAt()) {
                        $order->setVerified(true);
                        $order->setVerifiedAt($now);
                        $em->persist($order);
                        $em->flush();

                        // Activate action
                        $code = $order->getCode();
                        $activationCode = $em->getRepository("AppBundle:ActivationCode")->findOneBy(array("code" => $code));

                        if($activationCode) {
                            $activationCode->setEnabled(true);
                            $activationCode->setStartDate($now);
                            $activationCode->setEndDate($now->modify("+" . $activationCode->getPeriod() + 'days'));
                            $em->persist($activationCode);

                            $activationCodeHistory = new ActivationCodeHistory();
                            $activationCodeHistory->setResetDate($now);
                            $activationCodeHistory->setActivationCodeId($activationCode);
                            $activationCodeHistory->setActivationCode($code);

//                            $activationCodeHistory->setMac($mac);
//                            $activationCodeHistory->setDeviceModel($deviceModel);
//                            $activationCodeHistory->setModelNumber($modelNumber);
//                            $activationCodeHistory->setSerialNumber($serialNumber);
//                            $activationCodeHistory->setActivationCodeId($activationCode);
//                            $activationCodeHistory->setActivationCode($activationCode->getCode());

                            $em->persist($activationCodeHistory);
                            $em->flush();

                            return $this->redirect($this->generateUrl('payments_success'));
                        }
                    }
                }
                $message = $this->get('translator')->trans('pages.billing.payment.purchase.error');
                return $this->buyFaild($request, $message);
            }
        }
        return $this->buyFaild($request);
    }
}
