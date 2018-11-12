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

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\Settings;

/**
 * Controller managing the registration
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class RegistrationController extends Controller
{
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		
		$result = json_decode($this->get("app.util.services")->ega123Obfuscated($em));
	
		if($result->code == 0)
		  return $this->render('AppBundle:themes/default/Home:errorconnection.html.twig');
		else if($result->code == 2)
		        return $this->redirectToRoute('validate');
		else if($result->code == 3)	
				return $this->redirectToRoute('validate');
        
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $user->addRole("ROLE_RESELLER");
            $user->setEnabled(1);
            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                // $url = $this->generateUrl('fos_user_registration_confirmed');
                $url = $this->generateUrl('home');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            $setting = new Settings();
            $setting->setServerName("Besttranscoder2");
            $setting->setTimeZone("America/Havana");
            $setting->setLogo("favico.ico");
            $setting->setPlayerLogo("favico.ico");
            $setting->setUser($user);

            $em->persist($setting);
            $em->flush();

            $url = $this->generateUrl('home');
            $response = new RedirectResponse($url);

            return $response;
        }

        return $this->render('AppBundle:themes/default/FOSUser/Registration:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction()
    {
        $em = $this->getDoctrine()->getManager();
		
		$result = json_decode($this->get("app.util.services")->ega123Obfuscated($em));
	
		if($result->code == 0)
		  return $this->render('AppBundle:themes/default/Home:errorconnection.html.twig');
		else if($result->code == 2)
		        return $this->redirectToRoute('validate');
		else if($result->code == 3)	
				return $this->redirectToRoute('validate');
        
        $email = $this->get('session')->get('fos_user_send_confirmation_email/email');
        $this->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }

        return $this->render('AppBundle:themes/default/FOSUser/Registration:checkEmail.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Receive the confirmation token from user email provider, login the user
     */
    public function confirmAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();
		
		$result = json_decode($this->get("app.util.services")->ega123Obfuscated($em));
	
		if($result->code == 0)
		  return $this->render('AppBundle:themes/default/Home:errorconnection.html.twig');
		else if($result->code == 2)
		        return $this->redirectToRoute('validate');
		else if($result->code == 3)	
				return $this->redirectToRoute('validate');
        
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user->setConfirmationToken(null);
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRM, $event);

        $userManager->updateUser($user);

        if (null === $response = $event->getResponse()) {
            $url = $this->generateUrl('fos_user_registration_confirmed');
            $response = new RedirectResponse($url);
        }

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRMED, new FilterUserResponseEvent($user, $request, $response));

        return $response;
    }

    /**
     * Tell the user his account is now confirmed
     */
    public function confirmedAction()
    {
        $em = $this->getDoctrine()->getManager();
		
		$result = json_decode($this->get("app.util.services")->ega123Obfuscated($em));
	
		if($result->code == 0)
		  return $this->render('AppBundle:themes/default/Home:errorconnection.html.twig');
		else if($result->code == 2)
		        return $this->redirectToRoute('validate');
		else if($result->code == 3)	
				return $this->redirectToRoute('validate');
        
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('AppBundle:themes/default/FOSUser/Registration:confirmed.html.twig', array(
            'user' => $user,
            'targetUrl' => $this->getTargetUrlFromSession(),
        ));
    }

    private function getTargetUrlFromSession()
    {        
        // Set the SecurityContext for Symfony <2.6
        if (interface_exists('Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface')) {
            $tokenStorage = $this->get('security.token_storage');
        } else {
            $tokenStorage = $this->get('security.context');
        }

        $key = sprintf('_security.%s.target_path', $tokenStorage->getToken()->getProviderKey());

        if ($this->get('session')->has($key)) {
            return $this->get('session')->get($key);
        }
    }
}
