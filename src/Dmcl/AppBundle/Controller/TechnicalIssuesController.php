<?php

namespace Dmcl\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dmcl\AppBundle\Entity\TechnicalIssues;
use Dmcl\AppBundle\Entity\Issues;
use Dmcl\AppBundle\Form\IssuesType;
use Dmcl\AppBundle\Form\TechnicalIssuesType;

/**
 * TechnicalIssues controller.
 *
 */
class TechnicalIssuesController extends Controller
{

    /**
     * Lists all TechnicalIssues entities.
     *
     */
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager('xtreamcode');

        return $this->render('@App/themes/default/TechnicalIssues/index.html.twig', array(
    		'results' => $em->getRepository('AppBundle:Issues')->findAll(),
        ));    
	}

    /**
     * Lists all TechnicalIssues entities.
     *
     */
    public function sentAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        if(!$this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            return $this->redirect($this->generateUrl("home"));
        }
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $entities = $em->getRepository('AppBundle:TechnicalIssues')->findBy(array(
                "fromEmail"=>"support"
            ));
        }else{
            $entities = $em->getRepository('AppBundle:TechnicalIssues')->findBy(array(
                "fromEmail"=>$this->getUser()->getEmail(),
                "deleted"=>false
            ));
        }
        return $this->render('AppBundle:themes/default/TechnicalIssues:sent.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TechnicalIssues entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TechnicalIssues();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager('xtreamcode');

            if($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')){
                $entity->setFromEmail("support");
                $entity->setFromName("Support");
                $user = $em->getRepository('AppBundle:User')->findOneByEmail($entity->getToEmail());
                if($user){
                    $entity->setToName($user->getName());
                }else{
                    $entity->setToName("Unknow");
                }
            }else{
                if($this->get('security.authorization_checker')->isGranted('ROLE_USER')){
                    $user = $this->getUser();
                    $entity->setFromEmail($user->getEmail());
                    $entity->setFromName($user->getName());
                    $entity->setToName("Support");
                    $entity->setToEmail("support");
                }
            }
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.technical_issues.send_success"));

            return $this->redirect($this->generateUrl('technical_issues'));
        }

        return $this->render('AppBundle:themes/default/TechnicalIssues:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TechnicalIssues entity.
     *
     * @param TechnicalIssues $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TechnicalIssues $entity)
    {
        $form = $this->createForm(new TechnicalIssuesType(), $entity, array(
            'action' => $this->generateUrl('technical_issues_create'),
            'method' => 'POST',
            'attr'=>array("allowTo"=>$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')?true:false)
        ));

        $form->add('submit', 'submit', array('label' =>$this->get("translator")->trans("pages.technical_issues.new.create")));

        return $form;
    }

    /**
     * Displays a form to create a new TechnicalIssues entity.
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Issues();
		$em = $this->getDoctrine()->getManager('xtreamcode');
		
        $form   = $this->createForm(new IssuesType(), $entity);
		$form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', $this->get("translator")->trans("pages.technical_issues.msg_save"));
            return $this->redirectToRoute('technical_issues');
        }
        return $this->render('AppBundle:themes/default/TechnicalIssues:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
			'results' => $em->getRepository('AppBundle:Issues')->findAll(),
        ));
    }

    /**
     * Finds and displays a TechnicalIssues entity.
     *
     */
    public function showAction($id)
    {
        if(!$this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            return $this->redirect($this->generateUrl("home"));
        }

        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:TechnicalIssues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TechnicalIssues entity.');
        }
        if($entity->getToEmail()==$this->getUser()->getEmail() || ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') && $entity->getToEmail() == "support" ) ){
            $entity->setRead(true);
            $em->flush();
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:themes/default/TechnicalIssues:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TechnicalIssues entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:TechnicalIssues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TechnicalIssues entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:themes/default/TechnicalIssues:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a TechnicalIssues entity.
     *
     * @param TechnicalIssues $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(TechnicalIssues $entity)
    {
        $form = $this->createForm(new TechnicalIssuesType(), $entity, array(
            'action' => $this->generateUrl('technical_issues_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TechnicalIssues entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:TechnicalIssues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TechnicalIssues entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('technical_issues_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:themes/default/TechnicalIssues:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TechnicalIssues entity.
     *
     */
    public function deleteAction(Request $request)
    {

        $issues = $request->get("issues");
        $em = $this->getDoctrine()->getManager('xtreamcode');

        if(count($issues)>0){
            $entities = $em->getRepository('AppBundle:TechnicalIssues')->findById($issues);
            foreach($entities as $entity){
                if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
                    $em->remove($entity);
                }else{
                    $entity->setDeleted(true);
                }
            }
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.technical_issues.delete_success"));
            return $this->redirect($this->generateUrl('technical_issues'));
        }else{
            $this->get('session')->getFlashBag()->add('error', $this->get("translator")->trans("pages.technical_issues.delete_error"));
            return $this->redirect($this->generateUrl('technical_issues'));
        }
    }

    /**
     * Creates a form to delete a TechnicalIssues entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('technical_issues_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

    public function replyAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entityReply = $em->getRepository('AppBundle:TechnicalIssues')->find($id);
        $entity = new TechnicalIssues();

        if($entityReply){
            $entity->setToEmail($entityReply->getFromEmail());
            $entity->setSubject("Re: ".$entityReply->getSubject());
            $entity->setMessage("<br><br><br>--".$entityReply->getMessage());
        }
        $form   = $this->createCreateForm($entity);
        return $this->render('AppBundle:themes/default/TechnicalIssues:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
	    /**
     * Displays a form to edit an existing ActivationCode entity.
     *
     */
    public function issueEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:Issues')->find($id);
		if (!$entity) {
            throw $this->createNotFoundException('Unable to find Issue entity.');
        }
		$form = $this->createForm(new IssuesType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->addFlash('success', $this->get("translator")->trans("pages.technical_issues.msg_edited"));
            return $this->redirectToRoute('technical_issues');
        }
        return $this->render('@App/themes/default/TechnicalIssues/edit-issue.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
			'results' => $em->getRepository('AppBundle:Issues')->findAll(),
        ));
	}
	/**
     * Deletes a Issue entity.
     *
     */
    public function issueDeleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $entity = $em->getRepository('AppBundle:Issues')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find technical issue entity.');
        }

        $em->remove($entity);
        $em->flush();

        if ($request->isXmlHttpRequest()) {
            $response = array(
                "status"=>200,
                "msg"=>$this->get("translator")->trans("pages.technical_issues.msg_delete_success")
            );
            return new JsonResponse($response);
        } else {
            $this->addFlash('success', $this->get("translator")->trans("pages.technical_issues.msg_delete_success"));
            return $this->redirectToRoute('technical_issues');
        }
    }
}
