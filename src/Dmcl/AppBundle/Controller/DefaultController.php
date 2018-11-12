<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Dmcl\AppBundle\Entity\Tickets;
use Dmcl\AppBundle\Entity\Issues;
use Dmcl\AppBundle\Entity\License;

use Dmcl\AppBundle\Form\LicenseType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
		
		$issues = $em->getRepository('AppBundle:Issues')->findAll();

		return $this->render('AppBundle:themes/default/Home:index.html.twig', array(
			'issues' => $issues,
		));
    }

    public function afterLoginAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        if($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')){
            return $this->redirect($this->generateUrl("app_dashboard"));
        }
            return $this->redirect($this->generateUrl("app_resellers_dashboard"));
    }

    public function showAnouncementsAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $anouncements = $this->getDoctrine()->getRepository('AppBundle:Anouncement')->findAll();
        return $this->render('@App/themes/default/Admin/Anouncement/showAnouncements.html.twig', array(
            'anouncements' => $anouncements
        ));
    }

    public function navbarDateAction()
    {        
        return $this->render('@App/themes/default/base-admin/navbarDate.html.twig', array(
            'currentDate' => date_format(new \DateTime(), 'd/m/Y g:i A')
        ));
    }
	public function sendEmailAction(Request $request)
    {
		/*$message = \Swift_Message::newInstance()
			->setSubject($request->get('subject'))
			->setFrom($request->get('email'))
			->setTo('bright@proisc.com')
			->setBody(*/
				/*$this->renderView(
					// app/Resources/views/Emails/registration.html.twig
					'Emails/registration.html.twig',
					array('name' => $name)
				),*/
				
				/*'<html>
					<title>Sample</title>
					<body>
						<h1>'.$request->get('issue').'</h1>
						<p>'.$request->get('message').'</p>
					</body>
				</html>',
				'text/html'
				
			)*/
			/*
			 * If you also want to include a plaintext version of the message
			->addPart(
				$this->renderView(
					'Emails/registration.txt.twig',
					array('name' => $name)
				),
				'text/plain'
			)
			*/
			;
		/*$this->get('mailer')->send($message);
		$response = new Response();
		$response->setContent(json_encode(array('response' => 'success')));
		$response->headers->set('Content-Type', 'application/json');
		return $response;*/
		$em = $this->getDoctrine()->getManager('xtreamcode');		
		
		$issueClass = $em->getRepository('AppBundle:Issues')->find($request->get('issue'));
		$entity = new Tickets();
		$entity->setFromEmail($request->get('email'));
		$entity->setFromName($request->get('name'));
		$entity->setToName("Support");
		$entity->setToEmail("support");
		$entity->setIssue($issueClass);
		$entity->setMessage($request->get('message'));
		$entity->setSubject($request->get('subject'));
		$em->persist($entity);
        $em->flush();
		
		$response = array(
			"status"=>200,
			"msg"=>$this->get("translator")->trans("pages.activation_code.msg_delete_success")
		);
		return new JsonResponse($response);
    }

	public function validateAction(Request $request, $msg)
    {
        $em = $this->getDoctrine()->getManager();

		$licenseLocal = $em->getRepository('AppBundle:License')->findOneById('1');

		if(!$licenseLocal)
			$licenseLocal = new License();			

		$form = $this->createForm(new LicenseType(), $licenseLocal, array(
			'action' => $this->generateUrl('validate'),
			'method' => 'POST',
		));

		$form->add('submit', 'submit', array('label' => $this->get("translator")->trans('pages.home.validate.btn_check'),));
        $form->handleRequest($request);
      
        if ($form->isValid()) {	
			
			$em->persist($licenseLocal);
            $em->flush();	
			
			$this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.license.success"));
			
			return $this->redirectToRoute('home');
		}
		
		$issues = $this->getDoctrine()->getRepository('AppBundle:Issues')->findAll();
		
		$this->get('session')->getFlashBag()->add('error', $msg);

		return $this->render('AppBundle:themes/default/Home:license.html.twig', array(               
                'form' => $form->createView(),
                'issues' => $issues
		));
    }
}
