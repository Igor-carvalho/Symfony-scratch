<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\PackagesLocal;
use Dmcl\AppBundle\Form\PackagesLocalType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Products controller.
 *
 */
class PackagesLocalController extends Controller
{
    /**
     * Lists all Products entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $entities = array();

        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
            $entities = $em->getRepository('AppBundle:PackagesLocal')->findByUser($this->getUser()->getid());
        else
            $entities = $em->getRepository('AppBundle:PackagesLocal')->findByStatus(1);

        $pathLogo = $this->getParameter('upload.dir');

        foreach($entities as $entity){
            $path = $pathLogo . '/' . $entity->getLogo();

            if(!file_exists($path))
                $entity->setLogo('');
        }

        return $this->render('@App/themes/default/Admin/Products/index.html.twig', array(
            'entities' => $entities
        )); 
    }

    /**
     * Lists all Products entities.
     *
     */
    public function cartAction($id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $package = $em->getRepository('AppBundle:PackagesLocal')->find($id);

        $pathLogo = $this->getParameter('upload.dir');

        $path = $pathLogo . '/' . $package->getLogo();

        if(!file_exists($path))
            $package->setLogo('');

        return $this->render('@App/themes/default/Admin/Products/cart.html.twig', array(
            'package' => $package
        )); 
    }

    /**
     * Creates a new Products entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = new PackagesLocal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setUser($this->getUser()->getId());

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.package.created_success"));

            return $this->redirect($this->generateUrl('packages'));
        }

        return $this->render('AppBundle:themes/default/Admin/Products:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Products entity.
     *
     * @param Products $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PackagesLocal $entity)
    {
        $form = $this->createForm(new PackagesLocalType(), $entity, array(
            'action' => $this->generateUrl('packages_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $this->get("translator")->trans('pages.packages.new.create')));

        return $form;
    }

    /**
     * Displays a form to create a new Products entity.
     *
     */
    public function newAction()
    {
        $entity = new PackagesLocal();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:themes/default/Admin/Products:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Products entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = $em->getRepository('AppBundle:PackagesLocal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Products entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:themes/default/Admin/Products:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Products entity.
    *
    * @param Products $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PackagesLocal $entity)
    {
        $form = $this->createForm(new PackagesLocalType(), $entity, array(
            'action' => $this->generateUrl('packages_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' =>  $this->get("translator")->trans('pages.packages.edit.update')));

        return $form;
    }
    /**
     * Edits an existing Products entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = $em->getRepository('AppBundle:PackagesLocal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Products entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {          
            $em->persist($entity);
            $em->flush();     
           
            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.package.updated_success"));

            return $this->redirect($this->generateUrl('packages'));
        }

        return $this->render('AppBundle:themes/default/Admin/Products:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }
    /**
     * Deletes a Products entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()|| $request->isXmlHttpRequest()) {

            $entity = $em->getRepository('AppBundle:PackagesLocal')->find($id);

            if (!$entity) {
                if($request->isXmlHttpRequest()){
                    $response = array(
                        "status"=>400,
                        "msg"=>$this->get("translator")->trans("pages.package.msg_delete_error")
                    );

                    return new Response(json_encode($response),200);
                }

                throw $this->createNotFoundException('Unable to find Products entity.');
            } 

            $em->remove($entity);
            $em->flush();
        }

        if($request->isXmlHttpRequest()){
            $response = array(
                "status"=>200,
                "msg"=>$this->get("translator")->trans("pages.package.msg_delete_success")
            );

            return new Response(json_encode($response),200);
        }
        
        return $this->redirect($this->generateUrl('packages'));
    }

    /**
     * Creates a form to delete a Products entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
       return $this->createFormBuilder()
            ->setAction($this->generateUrl('packages_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' =>  $this->get("translator")->trans('pages.package.delete'),
                'attr'=>array("class"=>"btn btn-danger btn-sm pull-right delete","style"=>"margin-top: -32px;")))
            ->getForm()
        ;
    }
    
    public function changeSuperResellerAction($id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $entity = $em->getRepository('AppBundle:PackagesLocal')->findOneById($id);

        if (!$entity) {
            return new Response(json_encode(array("type" => 0, "message" => $this->get('translator')->trans('pages.packages.not_found'))), 200);
        }

        $entity->setSuperReseller(!$entity->getSuperReseller());
        $em->persist($entity);
        $em->flush();

        $name = $entity->getName();

        return new JsonResponse(array("type" => 1, "status" => $entity->getStatus(), "change" => $entity->getSuperReseller(), 200));
    }
    
    public function changeStatusAction($id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $entity = $em->getRepository('AppBundle:PackagesLocal')->findOneById($id);

        if (!$entity) {
            return new Response(json_encode(array("type" => 0, "message" => $this->get('translator')->trans('pages.packages.not_found'))), 200);
        }

        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        $name = $entity->getName();

        return new JsonResponse(array("type" => 1, "sp" => $entity->getSuperReseller(), "change" => $entity->getStatus(), 200));
    }
}
