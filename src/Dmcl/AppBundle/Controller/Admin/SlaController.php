<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\Sla;
use Dmcl\AppBundle\Form\SlaType;

/**
 * Sla controller.
 *
 */
class SlaController extends Controller
{
    /**
     * Finds and displays a Sla entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sla')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sla entity.');
        }


        return $this->render('AppBundle:themes/default/Admin/Sla:show.html.twig', array(
            'entity' => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Sla entity.
     *
     */
    public function editAction($slug)
    {
       $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sla')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sla entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('AppBundle:themes/default/Admin/Sla:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Sla entity.
     *
     * @param Sla $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Sla $entity)
    {
        $form = $this->createForm(new SlaType(), $entity, array(
            'action' => $this->generateUrl('sla_update', array('slug' => $entity->getSlug())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' =>  $this->get("translator")->trans("pages.sla.update")));

        return $form;
    }
    /**
     * Edits an existing Sla entity.
     *
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Sla')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sla entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success',  $this->get("translator")->transChoice("pages.sla.updated_successfully",0,array("%sla%"=>$entity->getDisplayName())));

            return $this->redirect($this->generateUrl('sla_edit', array('slug' => $slug)));
        }

        return $this->render('AppBundle:themes/default/Admin/Sla:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
