<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Form\ProfileFormType;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Dmcl\AppBundle\Controller\BaseController as Controller;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();
        
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('AppBundle:themes/default/FOSUser/Profile:show.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();

		if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $oldEmail = $user->getEmail();

        $form = $this->createForm(new ProfileFormType(), $user);		
		
        $form->handleRequest($request);

        if ($form->isValid()) {
            // $newEmail = $user->getEmail();

            // if($oldEmail != $newEmail){
            //     $data = array(
            //         'newapikey' => $newEmail
            //     ); 
                
            //     $user->setEmail($oldEmail);
                
            //     $responseAPI = $this->get("app.util.services")->sendRequest($this::ROUTE_APIKEY_CHANGE, $data, 'POST');
            //     $responseAPI = json_decode($responseAPI); 
                
            //     $code = $responseAPI->success;
                                            
            //     if($code == 401 || $code == 404 || $code == 500)
            //         return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
            //             'msg' => $responseAPI->msg,
            //             'data' =>  $responseAPI->data
            //         )); 
                                            
            //     if($code === 403)
            //         return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
            //                 'msg' => $responseAPI->msg,
            //                 'password' =>  $responseAPI->data->password,
            //                 'apikey' =>  $responseAPI->data->apikey
            //         )); 

            //     $user->setEmail($newEmail);
            // }

            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }
			
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

		$array['form'] = $form->createView();
        $array['user'] = $user;
        
        return $this->render('AppBundle:themes/default/FOSUser/Profile:edit.html.twig', $array);
    }
}
