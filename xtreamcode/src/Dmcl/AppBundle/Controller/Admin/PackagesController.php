<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\Packages;
use Dmcl\AppBundle\Form\PackagesType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Packages controller.
 *
 */
class PackagesController extends Controller
{
    /**
     * Lists all Packages entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $entities = [];

        $entities = $em->getRepository('AppBundle:Packages')->findAll();

        return $this->render('@App/themes/default/Admin/Packages/index.html.twig', array(
            'entities' => $entities
        )); 
    }

    /**
     * Creates a new Packages entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = new Packages();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $formats = $request->get('formats');
            $bouquets = $request->get('bouquets');

            $entity->setBouquets(json_encode($bouquets));
            $entity->setOutputFormats(json_encode($formats));

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.packages.created_success"));

            return $this->redirect($this->generateUrl('packages'));
        }

        return $this->render('AppBundle:themes/default/Admin/Packages:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Packages entity.
     *
     * @param Packages $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Packages $entity)
    {
        $form = $this->createForm(new PackagesType(), $entity, array(
            'action' => $this->generateUrl('packages_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $this->get("translator")->trans('pages.packages.new.create')));

        return $form;
    }

    /**
     * Displays a form to create a new Packages entity.
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Packages();
        $form   = $this->createCreateForm($entity);

        $bouquets = $em->getRepository('AppBundle:Bouquets')->findAll();
        $outputFormats = $em->getRepository('AppBundle:AccessOutput')->findAll();

        return $this->render('AppBundle:themes/default/Admin/Packages:new.html.twig', array(
            'entity' => $entity,
            'bouquets' => $bouquets,
            'outputFormats' => $outputFormats,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Packages entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $emXC = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = $emXC->getRepository('AppBundle:Packages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Packages entity.');
        }

        $bouquets = json_decode($entity->getBouquets());

        $bouquetsSelected = [];

        foreach($bouquets as $bouquet){
            $bouquetsSelected[] = $bouquet;
        }

        $formats = json_decode($entity->getOutputFormats());

        $formatsSelected = [];

        foreach($formats as $format){
            $formatsSelected[] = $format;
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $bouquets = $em->getRepository('AppBundle:Bouquets')->findAll();
        $outputFormats = $em->getRepository('AppBundle:AccessOutput')->findAll();

        return $this->render('AppBundle:themes/default/Admin/Packages:edit.html.twig', array(
            'entity'      => $entity,
            'bouquets' => $bouquets,
            'bouquetsSelected' => $bouquetsSelected,
            'formatsSelected' => $formatsSelected,
            'outputFormats' => $outputFormats,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Packages entity.
    *
    * @param Packages $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Packages $entity)
    {
        $form = $this->createForm(new PackagesType(), $entity, array(
            'action' => $this->generateUrl('packages_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' =>  $this->get("translator")->trans('pages.packages.edit.update')));

        return $form;
    }
    /**
     * Edits an existing Packages entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = $em->getRepository('AppBundle:Packages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Packages entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {    
            $formats = $request->get('formats');
            $bouquets = $request->get('bouquets');

            $entity->setBouquets(json_encode($bouquets));
            $entity->setOutputFormats(json_encode($formats));

            $em->persist($entity);
            $em->flush();     
           
            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.package.updated_success"));

            return $this->redirect($this->generateUrl('packages'));
        }

        $bouquets = json_decode($entity->getBouquets());

        $bouquetsSelected = [];

        foreach($bouquets as $bouquet){
            $bouquetsSelected[] = $bouquet;
        }

        $formats = json_decode($entity->getOutputFormats());

        $formatsSelected = [];

        foreach($formats as $format){
            $formatsSelected[] = $format;
        }

        return $this->render('AppBundle:themes/default/Admin/Packages:edit.html.twig', array(
            'entity'      => $entity,
            'bouquets' => $bouquets,
            'bouquetsSelected' => $bouquetsSelected,
            'formatsSelected' => $formatsSelected,
            'outputFormats' => $outputFormats,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }
    /**
     * Deletes a Packages entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()|| $request->isXmlHttpRequest()) {

            $entity = $em->getRepository('AppBundle:Packages')->find($id);

            if (!$entity) {
                if($request->isXmlHttpRequest()){
                    $response = array(
                        "status"=>400,
                        "msg"=>$this->get("translator")->trans("pages.packages.msg_delete_error")
                    );

                    return new Response(json_encode($response),200);
                }

                throw $this->createNotFoundException('Unable to find Packages entity.');
            } 

            $em->remove($entity);
            $em->flush();
        }

        if($request->isXmlHttpRequest()){
            $response = array(
                "status"=>200,
                "msg"=>$this->get("translator")->trans("pages.packages.msg_delete_success")
            );

            return new Response(json_encode($response),200);
        }
        
        return $this->redirect($this->generateUrl('packages'));
    }

    /**
     * Creates a form to delete a Packages entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
       return $this->createFormBuilder()
            ->setAction($this->generateUrl('packages_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' =>  $this->get("translator")->trans('pages.package.delete'),
                'attr'=>array("class"=>"btn btn-danger btn-sm pull-right delete","style"=>"margin-top: -32px;")))
            ->getForm();
    }
    
    public function bouquetsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emXC = $this->getDoctrine()->getManager('xtreamcode');

        $response = ['success' => 200, 'datas' => ''];

        $id = $request->get('id');

        $entity = $emXC->getRepository('AppBundle:Packages')->find($id);

        if (!$entity) {
            return new Response(json_encode(array("type" => 0, "message" => $this->get('translator')->trans('pages.packages.not_found'))), 200);
        }

        $bouquets = json_decode($entity->getBouquets());

        foreach($bouquets as $bouquet){
            $entity = $em->getRepository('AppBundle:Bouquets')->find($bouquet);

            if ($entity) {
                $response['datas'][] = [
                    'id' => $entity->getId(),
                    'name' => $entity->getBouquetName()
                ];
            }
        }

        return new JsonResponse($response, 200);
    }
}
