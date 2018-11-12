<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\User;
use Dmcl\AppBundle\Form\DataTransformer\VodPackageTransformer;
use Dmcl\AppBundle\Repository\PlaylistsRepository;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Dmcl\AppBundle\Entity\UserPaypal;
use Dmcl\AppBundle\Form\UserPaypalType;

use Dmcl\AppBundle\Entity\Dealer;
use Dmcl\AppBundle\Form\DealerType;


class ResellersController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $resellers = $em->getRepository('AppBundle:User')->findAll();
        return $this->render("AppBundle:themes/default/Admin/Resellers:index.html.twig", array("resellers" => $resellers));
    }

    public function profileAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        //dump($user);die;
        if (!$user) {
            throw $this->createNotFoundException('Unable to find Reseller entity.');
        }
        return $this->render('AppBundle:themes/default/FOSUser/Profile:show.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * Displays a form to edit an existing Reseller entity.
     *
     */
    public function editResellerAction(Request $request, $id)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find Customers entity.');
        }
        $form = $formFactory->createForm();

        $form
            ->add('playlistAssigned', "entity", array(
                'class' => 'AppBundle:Playlists',
                'query_builder' => function (PlaylistsRepository $pr) {
                    return $pr->createQueryBuilder('p')
                        ->where("p.enabled = true");
                },
                "multiple" => true,
                "required" => false,
                "attr" => array("class" => "form-control select2 ")
            ))
            ->add('playlistExpiration', 'datetime', array('widget' => 'single_text',
                "attr" => array("class" => "form-control")));

        $form->setData($user);

        /*Dealer form start*/
        $em = $this->getDoctrine()->getManager();
        $dealerEntity = $em->getRepository('AppBundle:Dealer')->findOneByReseller($user);
        $dealer = true;
        if (!$dealerEntity) {
            $dealer = false;
            $dealerEntity = new Dealer();
        }

        $dealerForm = $this->createForm(new DealerType(), $dealerEntity);
        /*Dealer form end*/


        /*Paypal form start*/
        $userPaypalEntity = $em->getRepository('AppBundle:UserPaypal')->findOneByUserId($user);

        if (!$userPaypalEntity) {
            $userPaypalEntity = new UserPaypal();
            $userPaypalForm = $this->createForm(new UserPaypalType(), $userPaypalEntity);
        } else {
            $userPaypalForm = $this->createForm(new UserPaypalType(), $userPaypalEntity);
        }
        /*Paypal form end*/
        $form->handleRequest($request);
        $dealerForm->handleRequest($request);
        $userPaypalForm->handleRequest($request);

        // Validating form
        $flag = false;
        $errors = $form->getErrors();
        $errorsLength = $errors->count();
        if ($errorsLength == 0 || ($errorsLength == 1 && $errors->current()->getMessage() == 'fos_user.password.blank')
        ) {
            $flag = true;
        }

        if ($form->isSubmitted() && $flag) {
            /*insert paypal for user start*/
            $userPaypalEntity->setPaypalId($request->get('appbundle_user_paypal')['paypalId']);
            $userPaypalEntity->setUserId($user->getId());
            $em->persist($userPaypalEntity);
            $em->flush();
            /*insert paypal for user end*/

            if ($request->get('appbundle_dealer_allowDealer') && !$dealer) {
                $dealerEntity->setReseller($user);
                $em->persist($dealerEntity);
                $em->flush();
            } else if (!$request->get('appbundle_dealer_allowDealer') && $dealer) {
                $em->remove($dealerEntity);
                $em->flush();
            }

            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);


            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.resellers.updated_success"));
            return $this->redirect($this->generateUrl("reseller"));
        }

        return $this->render('AppBundle:themes/default/Admin/Resellers:edit.html.twig', array(
            'form' => $form->createView(),
            'userPaypalForm' => $userPaypalForm->createView(),
            'dealer' => $dealer,
            'dealerForm' => $dealerForm->createView()
        ));

    }

    public function addResellerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        /**
         * @var User $user
         */
        $user = $userManager->createUser();
        $user->setEnabled(true);

        $form = $formFactory->createForm();

        $form
            ->add('playlistAssigned', "entity", array(
                'class' => 'AppBundle:Playlists',
                'query_builder' => function (PlaylistsRepository $pr) {
                    return $pr->createQueryBuilder('p')
                        ->where("p.enabled = true");
                },
                "multiple" => true,
                "required" => false,
                "attr" => array("class" => "form-control select2 ")
            ))
            ->add('playlistExpiration', 'datetime', array('widget' => 'single_text',
                "attr" => array("class" => "form-control")));

        $form->setData($user);


        /*Dealer form start*/
        $dealerEntity = new Dealer();
        $dealerForm = $this->createForm(new DealerType(), $dealerEntity);
        /*Dealer form end*/

        /*Paypal form start*/
        /**
         * @var UserPaypal $userPaypalEntity
         */
        $userPaypalEntity = new UserPaypal();
        $userPaypalForm = $this->createForm(new UserPaypalType(), $userPaypalEntity);
        /*Paypal form end*/

        $form->handleRequest($request);
        $dealerForm->handleRequest($request);
        $userPaypalForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->addRole("ROLE_RESELLER");
            $user->setEnabled(true);
            $user->setLastActivityAt(new \DateTime());
            $userManager->updateUser($user);
            //print_r($_POST);die;

            /*insert dealer start*/
            $dealerEntity->setReseller($user);
            $em = $this->getDoctrine()->getManager();
            if ($request->get('appbundle_dealer_allowDealer')) {
                $em->persist($dealerEntity);
                $em->flush();
            }
            /*insert dealer end*/

            /*insert paypal for user start*/
            $userPaypalEntity->setPaypalId($userPaypalEntity->getPaypalId()->getId());
            $userPaypalEntity->setUserId($user->getId());
            $em->persist($userPaypalEntity);
            $em->flush();
            /*insert paypal for user end*/

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.resellers.created_success"));
            return $this->redirect($this->generateUrl("reseller"));
        }

        return $this->render('AppBundle:themes/default/Admin/Resellers:add.html.twig', array(
            'form' => $form->createView(),
            'userPaypalForm' => $userPaypalForm->createView(),
            'dealerForm' => $dealerForm->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:User')->find($id);

        if (!$entity) {
            if ($request->isXmlHttpRequest()) {
                $response = array(
                    "status" => 400,
                    "msg" => $this->get("translator")->trans("pages.resellers.msg_delete_error")
                );

                return new Response(json_encode($response), 200);
            }
            throw $this->createNotFoundException('Unable to find Reseller entity.');
        }

        $em->remove($entity);
        $em->flush();

        if ($request->isXmlHttpRequest()) {
            $response = array(
                "status" => 200,
                "msg" => $this->get("translator")->trans("pages.resellers.msg_delete_success")
            );

            return new Response(json_encode($response), 200);
        }
        return $this->redirect($this->generateUrl('reseller'));
    }

    public function generatePlaylistAction(User $user)
    {
        $zip = new \ZipArchive;
        $dir_zip = tempnam("/tmp", "playlist");
        $res = $zip->open($dir_zip, \ZipArchive::CREATE);

//        $em = $this->getDoctrine()->getManager();
//        $customer = $em->getRepository('AppBundle:Customers')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find Reseller.');
        }

        $zip->addFromString('playlists', "");

        foreach ($user->getPlaylistAssigned() as $playlist) {
            $m3u_data = $this->get("app.m3u.services")->generateM3U_V2($playlist, $user->getPlaylistHash());
            if ($res === TRUE) {
                $zip->addFromString($playlist->getName() . '-' . time() . '.m3u', $m3u_data);
            }
        }
        $zip->close();
        return new Response(file_get_contents($dir_zip), 200, array(
            'Content-Type' => "application/zip",
            'Content-Disposition' => 'attachment; filename="playlists.zip"',
        ));
    }
}
