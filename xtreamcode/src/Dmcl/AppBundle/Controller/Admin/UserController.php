<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Doctrine\ORM\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Dmcl\AppBundle\Controller\BaseController as Controller,
    Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Dmcl\AppBundle\Entity\User;
use Dmcl\AppBundle\Entity\RegUsers;
use Dmcl\AppBundle\Entity\RegUserlog;
use Dmcl\AppBundle\Form\RegUsersType;

class UserController extends Controller
{
    /**
     * Lists all Users entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:RegUsers')->findUsers($this->getUser()->getId());

        return $this->render('@App/themes/default/Admin/User/index.html.twig', array(
            'users' => $entities
        )); 
    }

    /**
     * Lists all Users entities.
     *
     */
    public function indexResellersAction()
    {
//        print_r('sss'); exit;
        return $this->render('@App/themes/default/Admin/User/resellers.html.twig');
    }
    
    /**
     * Lists all Users entities.
     *
     */
    public function ajaxResellersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $request->get('page');
        $rpp = $request->get('rpp');

        $response = array('success' => 200, 'data' => array());

        $id = $this->getUser()->getId();

        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
            $id = '';

        $entities = $em->getRepository('AppBundle:RegUsers')->findResellers($id, $page, $rpp);

        foreach($entities as $entity){
            $date = '';
            $hore = '';
            $dateLogin = '';
            $horeLogin = '';

            if($entity->getDateRegistered()){
                $create = new \DateTime('@'.$entity->getDateRegistered());
                $date = $create->format('m/d/Y');
                $hore = $create->format('H:i:s');
            }

            if($entity->getDateRegistered()){
                $create = new \DateTime('@'.$entity->getDateRegistered());
                $dateLogin = $create->format('m/d/Y');
                $horeLogin = $create->format('H:i:s');
            }

            $status = '';

            $routeVerified = $this->generateUrl('user_change_verified', array('id' => $entity->getId())).'?ajax=true';
            $routeDelete = $this->generateUrl('user_delete', array('id' => $entity->getId()));
            $routeUpdate = $this->generateUrl('user_update', array('id' => $entity->getId()));

            if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                if($entity->getUsername() != 'admin'){
                    if($entity->getStatus()){
                        $status = '<a class="verified label-success label label-sm"
                                        data-href="'.$routeVerified.'"
                                        href="javascript:;">'.$this->get('translator')->trans('enabled').'</a>';
                    }
                    else{
                        $status = '<a class="verified label-success label label-sm"
                                        data-href="'.$routeVerified.'"
                                        href="javascript:;">'.$this->get('translator')->trans('disabled').'</a>';
                    }
                }
                else{
                    $status = $entity->getStatus()?$this->get('translator')->trans('enabled'):$this->get('translator')->trans('disabled');
                }
            }
            else{
                $status = $entity->getStatus()?$this->get('translator')->trans('enabled'):$this->get('translator')->trans('disabled');
            }
           
            $response['data'][] = array(
                'id' => $entity->getId(),
                'username' => $entity->getUsername(),
                'email' => $entity->getEmail(),
                'enabled' => $status,
                'startdate' => '<div class="table__cell-widget">
                                    <span class="table__cell-widget-name">'.$date.'</span>
                                    <span class="table__cell-widget-description color-gray">
                                        '.$hore.'
                                    </span>
                                </div>',
                'lastlogin' => '<div class="table__cell-widget">
                                    <span class="table__cell-widget-name">'.$dateLogin.'</span>
                                    <span class="table__cell-widget-description color-gray">
                                        '.$horeLogin.'
                                    </span>
                                </div>',
                'details' => '<div style="display: block;" class="table__cell-actions-wrap">
                                    <a href="'.$routeUpdate.'" class="table__cell-actions-item table__cell-actions-icon">
                                        <span class="ua-icon-pencil"></span>
                                    </a>
                                    <a href="" data-href="'.$routeDelete.'" class="delete table__cell-actions-item table__cell-actions-icon">
                                        <span class="ua-icon-trash"></span>
                                    </a>
                                </div>'
            );
        }

        return new JsonResponse($response, 200);
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if ($entity = $em->getRepository('AppBundle:RegUsers')->findOneById($id)) {

            $owner = $em->getRepository('AppBundle:RegUsers')->findOneById($this->getUser()->getId());
            $logs = new RegUserlog();
            $logs->setUsername($entity->getUsername());
            $logs->setUser($owner);
//                $logs->setDate(new \DateTime('now'));
            $logs->setPassword(md5(time()));
            $logs->setType('[<b>UserPanel</b> -> <u>Sub-reseller</u>] Delete');
            $em->persist($logs);

            $em->remove($entity);
            $em->flush();

            $message = $this->get('translator')->trans('page.user.msg_user_delete_success');
        }  else {
            $message = $this->get('translator')->trans('page.user.msg_user_not_found');
        }

        return new JsonResponse(array('status' => 200, 'msg' => $message));
    }
    
    public function changeVerifiedAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);

        if (!$user) {
            return new Response(json_encode(array('type' => 0, 'message' => $this->get('translator')->trans('page.user.msg_user_not_found'))), 200);
        }

        $user->setEnabled(!$user->isEnabled());
        $em->flush();

        $name = $user->getName();

        $text = $user->isEnabled()?$this->get('translator')->trans('page.user.msg_user_enabled'):$this->get('translator')->trans('page.user.msg_user_disabled');
       
        return new JsonResponse(array('type' => 1, 'verified' => $user->isEnabled(), 200));
    }

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new RegUsers();

        $form = $this->createForm(new RegUsersType(), $entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $vars = $request->get('dmcl_appbundle_user');

            $username = $vars['username'];
            $email = $vars['email'];
            $credits = $vars['credits'];

            $exist = false;
            
            $user = $em->getRepository('AppBundle:RegUsers')->findOneByEmail($email);

            if($user){
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('pages.user.msg_user_exist_email'));
                $exist = true;
            } 

            $user = $em->getRepository('AppBundle:RegUsers')->findOneByUsername($username);

            if($user){
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('pages.user.msg_user_exist_username'));
                $exist = true;
            }

            $owner = $em->getRepository('AppBundle:RegUsers')->findOneById($this->getUser()->getId());

            if($owner->getCredits() < $credits) {
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('You have only '.$credits.' credits'));
                $exist = true;
            }
            if(!$exist){
                $ip = $request->getClientIp();
                $group = $em->getRepository('AppBundle:MemberGroups')->find(5);

                $entity->setPassword(md5(time()));
                $entity->setIp($ip);
                $entity->setOwnerId($this->getUser()->getId());
                $entity->setMemberGroup($group);

                $em->persist($entity);

//                 discount credits to creater
                $owner->setCredits($owner->getCredits() - $credits);
//                 log Create Action
                $logs = new RegUserlog();
                $logs->setUsername($username);
                $logs->setUser($owner);
//                $logs->setDate(new \DateTime('now'));
                $logs->setPassword(md5(time()));
                $logs->setType('[<b>UserPanel</b> -> <u>Sub-reseller</u>] Create');
                $em->persist($logs);

                $em->flush();

                return $this->redirect($this->generateUrl('user_resellers'));
            }
        }

        return $this->render('@App/themes/default/Admin/User/register.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:RegUsers')->find($id);

        $username1 = $entity->getUsername();
        $email1 = $entity->getEmail();
        $credits1 = $entity->getCredits();

        $form = $this->createForm(new RegUsersType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $vars = $request->get('dmcl_appbundle_user');

            $username = $vars['username'];
            $email = $vars['email'];
            $credits = $vars['credits'];
            $exist = false;
            
            $user = $em->getRepository('AppBundle:RegUsers')->findOneByEmail($email);

            if($user && $email != $email1){
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('pages.user.msg_user_exist_email'));
                $exist = true;
            } 

            $user = $em->getRepository('AppBundle:RegUsers')->findOneByUsername($username);

            if($user && $username != $username1){
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('pages.user.msg_user_exist_username'));
                $exist = true;
            }     
           
            if(!$exist){
                $owner = $em->getRepository('AppBundle:RegUsers')->findOneById($this->getUser()->getId());
//                 discount credits to creater
                $oldCredits = $owner->getCredits();
                $owner->setCredits($oldCredits - $credits + $credits1);
                $logs = new RegUserlog();
                $logs->setUsername($username);
                $logs->setUser($owner);
//                $logs->setDate(new \DateTime('now'));
                $logs->setPassword(md5(time()));
                $logs->setType('[<b>UserPanel</b> -> <u>Sub-reseller</u>] Credits: <font color=\"green\">'.$oldCredits.'</font> ->' .($oldCredits - $credits + $credits1).'<font color=\"red\"></font> Edit');
                $em->persist($logs);
                $em->flush();    
                
                return $this->redirect($this->generateUrl('user_resellers'));
            }
        }

        return $this->render('@App/themes/default/Admin/User/update.html.twig', array(
            'form' => $form->createView(),
            'entity' => $entity
        ));
    }

    private function checkLocalDBPassword($user, $password) 
    {
      $factory = $this->get('security.encoder_factory');    
      $encoder = $factory->getEncoder($user); 
      
      if($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt()))
        return true;
     
      return false;         
    }
    
    public function loginAction($authenticated = true, $username = '', $message = 'User or password is wrong')
    {
        $error = array('message' => '', 'state' => true);
            
        if(!$authenticated) 
            $error = array('message' => $message, 'state' => false);

        return $this->render('@App/themes/default/Admin/User/login.html.twig',
            array(
                'last_username' => $username,
                'error'         => $error,
                'app_name'      => 'siii'
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function checkAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:RegUsers')->findOneBy(array(
            'username'  => $request->get('_username'),
            'status' => 1
        ));

        // $factory = $this->get('security.encoder_factory');
               
        // $encoder = $factory->getEncoder($user);
        // $password = $encoder->encodePassword($request->get('_password'), $user->getSalt());
        // echo $password; 
        // echo "\n";
        // die('sii');
        if($user)
        { 
            $message = 'User or password is wrong';
          
            $authenticated = $this->checkLocalDBPassword($user, $request->get('_password'));
            
            if($authenticated)
            {        
                $roles = array('ROLE_RESELLER');

                if($user->getMemberGroup()->getIsAdmin())
                    $roles = array('ROLE_SUPER_ADMIN');
                
                $token = new UsernamePasswordToken($user, null, 'main', $roles);
                $this->container->get('security.context')->setToken($token);  
                
                $request->getSession()->set('_security_main', serialize($token));
                
                return $this->redirect($this->generateUrl('app_dashboard'));        
            }          
            else 
                return $this->forward('AppBundle:Admin/User:login', array('authenticated' => false, 'username' => $user->getUsername(), 'message' => $message));           
        }
        else         
            return $this->forward('AppBundle:Admin/User:login', array('authenticated' => false));
    }
    
    /**
     * Show the user
     */
    public function profileAction()
    {
        return $this->render('@App/themes/default/Admin/User/profile.html.twig');
    }
    
    /**
     * Show the user
     */
    public function profileUpdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $username = $request->get('username');
        $email = $request->get('email');

        $user->setUsername($username);
        $user->setEmail($email);

        $em->persist($user);
        $em->flush($user);

        return new JsonResponse(200);
    }
    
    /**
     * Show the user
     */
    public function changePasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $response = array('success' => false);

        $oldPassword = $request->get('oldPassword');
        $password = $request->get('password');

        $authenticated = $this->checkLocalDBPassword($user, $oldPassword);
            
        if($authenticated)
        {
            $factory = $this->get('security.encoder_factory');    
            $encoder = $factory->getEncoder($user); 

            $hashedPassword = $encoder->encodePassword($password, $user->getSalt());
            $user->setPassword($hashedPassword);
            $user->eraseCredentials();

            $em->persist($user);
            $em->flush($user);
            $request->getSession()->getFlashBag()->add('success', $this->get('translator')->trans('pages.user.msg_user_change_password'));

            $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_SUPER_ADMIN'));
            $this->container->get('security.context')->setToken($token);  
            
            $request->getSession()->set('_security_main', serialize($token));

            $response['success'] = true;

//            return $this->render('@App/themes/default/Admin/User/profile.html.twig');

        }

        return new JsonResponse($response, 200);
    }
}
