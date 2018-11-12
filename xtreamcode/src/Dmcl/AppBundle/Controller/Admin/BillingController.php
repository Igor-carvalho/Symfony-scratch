<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\BillingConfiguration;
use Dmcl\AppBundle\Form\BillingConfigurationType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Billing controller.
 *
 */
class BillingController extends Controller
{

    public function customersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $customers = $em->getRepository('AppBundle:User')->findAll();
        foreach ($customers as $index => $customer) {
            if (in_array("ROLE_SUPER_ADMIN", $customer->getRoles())) {
                unset($customers[$index]);
            }
        }
        return $this->render('AppBundle:themes/default/Admin/Billing:customers.html.twig', array('customers' => $customers));
    }

    public function customerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $customers = $em->getRepository('AppBundle:Customers')->findAll();

        return $this->render('AppBundle:themes/default/Admin/Billing:customer.html.twig', array('customers' => $customers));
    }

    public function customerProductsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $user = $em->getRepository('AppBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find Customer.');
        }

        $channels = array();
        $channelsPackages = array();
        $vod = array();
        $vodPackages = array();

        $subscriptions = $em->getRepository('AppBundle:Subscriptions')->findBy(
            array(
                "user" => $user,
                "expired" => false,
                "forTest" => false
            )
        );

        $products = array(
            "channel" => array(-1),
            "channels_package" => array(-1),
            "vod" => array(-1),
            "vod_package" => array(-1),
        );

        $productsAvailable = array(
            "channel" => array(-1),
            "channels_package" => array(-1),
            "vod" => array(-1),
            "vod_package" => array(-1),
        );

        foreach ($subscriptions as $subscription) {
            if (isset($products[$subscription->getProductType()])) {
                $products[$subscription->getProductType()][] = $subscription->getProductId();
            }
        }

        $productsAvailable["channel"] = $em->getRepository('AppBundle:Channel')->findChannelsAvailableForAdd($products["channel"]);
        $products["channel"] = $em->getRepository('AppBundle:Channel')->findById($products["channel"]);

        $productsAvailable["channels_package"] = $em->getRepository('AppBundle:ChannelsPackage')->findChannelsAvailableForAdd($products["channels_package"]);
        $products["channels_package"] = $em->getRepository('AppBundle:ChannelsPackage')->findById($products["channels_package"]);

        $productsAvailable["vod"] = $em->getRepository('AppBundle:Vod')->findChannelsAvailableForAdd($products["vod"]);
        $products["vod"] = $em->getRepository('AppBundle:Vod')->findById($products["vod"]);

        $productsAvailable["vod_package"] = $em->getRepository('AppBundle:VodPackage')->findChannelsAvailableForAdd($products["vod_package"]);
        $products["vod_package"] = $em->getRepository('AppBundle:VodPackage')->findById($products["vod_package"]);

        return $this->render('AppBundle:themes/default/Admin/Billing:customer_products.html.twig', array(
            'customer' => $user,
            'products' => $products,
            'productsAvailable' => $productsAvailable
        ));
    }

    private function processRole($role)
    {
        $roles = array('ADMIN', 'RESELLER', 'CUSTOMER', 'DEALER',);
        $role_arr = explode("_", $role);
        $new_role = $role_arr[count($role_arr) - 1];
        if (in_array($new_role, $roles))
            return ucwords(strtolower($new_role));
        return "";
    }

    public function ordersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode= $this->getDoctrine()->getManager('xtreamcode');

        $orders = $emXtreamcode->getRepository('AppBundle:Orders')->findAll();

        $roles = array();
        $resellers = array();

        foreach ($orders as $order) {
            $customer = $em->getRepository('AppBundle:RegUsers')->find($order->getCustomer());

            $role = "";
            $id = $order->getId();

            $resellers[$id] = $customer->getUsername();

            $role = $this->processRole('ROLE_RESELLER');

            $roles[$id] = $role;
        }

        return $this->render('AppBundle:themes/default/Admin/Billing:orders.html.twig', array(
            'orders' => $orders,
            'roles' => $roles,
            'resellers' => $resellers
        ));
    }

    public function customerOrdersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode= $this->getDoctrine()->getManager('xtreamcode');

        $customer = $em->getRepository('AppBundle:RegUsers')->find($this->getUser()->getId());

        if (!$customer) {
            throw $this->createNotFoundException("Unable to find Customer.");
        }

        $orders = $emXtreamcode->getRepository('AppBundle:Orders')->findByCustomer($customer->getId());

        return $this->render('AppBundle:themes/default/Admin/Billing:customer_orders.html.twig', array('orders' => $orders, "customer" => $customer));
    }

    public function customersOrdersAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $customer = $em->getRepository('AppBundle:Customers')->find($id);
        if (!$customer) {
            throw $this->createNotFoundException("Unable to find Customer.");
        }
        $orders = $em->getRepository('AppBundle:CustomerOrders')->findByCustomer($customer);
        return $this->render('AppBundle:themes/default/Admin/Billing:customers_orders.html.twig', array('orders' => $orders, "customer" => $customer));
    }

    public function orderDetailsAction(Request $request, $transactionId)
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode = $this->getDoctrine()->getManager('xtreamcode');

        $order = $emXtreamcode->getRepository('AppBundle:Orders')->findOneByTransactionId($transactionId);

        if (!$order) {
            throw $this->createNotFoundException('Unable to find Order.');
        }

        $customer = $em->getRepository('AppBundle:RegUsers')->find($order->getCustomer());

        return $this->render('AppBundle:themes/default/Admin/Billing:order_detail.html.twig', ['order' => $order, 'customer' => $customer]);
    }

    public function customerOrderDetailsAction(Request $request, $customer, $transactionId)
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode = $this->getDoctrine()->getManager('xtreamcode');

        $customer = $em->getRepository('AppBundle:RegUsers')->find($customer);

        if (!$customer) {
            throw $this->createNotFoundException("Unable to find Customer.");
        }

        $order = $emXtreamcode->getRepository('AppBundle:Orders')->findOneBy(array(
            "customer" => $customer->getId(),
            "transactionId" => $transactionId
        ));

        if (!$order) {
            throw $this->createNotFoundException('Unable to find Order.');
        }

        return $this->render('AppBundle:themes/default/Admin/Billing:customer_order_detail.html.twig', ['customer' => $customer, 'order' => $order]);
    }

    public function customersOrderDetailsAction(Request $request, $customer, $transactionId)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $customer = $em->getRepository('AppBundle:Customers')->find($customer);
        if (!$customer) {
            throw $this->createNotFoundException("Unable to find Customer.");
        }
        $order = $em->getRepository('AppBundle:CustomerOrders')->findOneBy(array(
            "customer" => $customer,
            "transactionId" => $transactionId
        ));
        if (!$order) {
            throw $this->createNotFoundException('Unable to find Order.');
        }
        return $this->render('AppBundle:themes/default/Admin/Billing:customers_order_detail.html.twig', array('customer' => $customer, 'order' => $order));
    }

    public function statisticsAction(Request $request)
    {
        return $this->render('AppBundle:themes/default/Admin/Billing:statistics.html.twig');
    }

    public function removeProductAction(Request $request, $customer, $type, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(
            array(
                "user" => $customer,
                "productType" => $type,
                "productId" => $id
            )
        );
        if (!$subscription) {
            if ($request->isXmlHttpRequest()) {
                $response = array(
                    "status" => 400,
                    "msg" => $this->get("translator")->trans("pages.billing.customer_products.index.msgs.$type.msg_remove_error")
                );

                return new Response(json_encode($response), 200);
            }
            throw $this->createNotFoundException('Unable to find Subscription entity.');
        }
        $subscription->setExpired(true);
        $em->flush();
        if ($request->isXmlHttpRequest()) {
            $response = array(
                "status" => 200,
                "msg" => $this->get("translator")->trans("pages.billing.customer_products.index.msgs.$type.msg_remove_success")
            );

            return new Response(json_encode($response), 200);
        }
        return $this->redirect($this->generateUrl('billing_customers_products', array("id" => $customer)));
    }

    public function addProductsAction(Request $request, $customer, $type)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $customerEntity = $em->getRepository('AppBundle:User')->find($customer);
        if (!$customerEntity) {
            $this->get('session')->getFlashBag()->add('error', $this->get("translator")->trans("pages.billing.customer_products.index.msgs.$type.create_error"));
            return $this->redirect($this->generateUrl('billing_customers_products', array("id" => $customer)));
        }
        $productsSupported = $this->container->getParameter("medias_support");
        $productsEntity = $em->getRepository('AppBundle:' . $productsSupported[$type])->findById($request->get("products"));
        foreach ($productsEntity as $product) {
            $this->get("app.subscriptions.services")->createSubscription($customerEntity, $type, $product->getId());
        }
        $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.billing.customer_products.index.msgs.$type.created_success"));

        return $this->redirect($this->generateUrl('billing_customers_products', array("id" => $customer)));
    }

}
