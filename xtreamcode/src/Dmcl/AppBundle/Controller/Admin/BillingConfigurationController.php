<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\BillingConfiguration;
use Dmcl\AppBundle\Form\BillingConfigurationType;

/**
 * BillingConfiguration controller.
 *
 */
class BillingConfigurationController extends Controller
{

    /**
     * Lists all BillingConfiguration entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:BillingConfiguration')->findOneBy(array());

        if (!$entity) {
            $entity = new BillingConfiguration();
            $entity->setCurrency("EUR");
            $entity->setSalesAddress("address");
            $entity->setSalesEmail("sales@domain.com");
            $em->persist($entity);
            $em->flush();
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('AppBundle:themes/default/Admin/BillingConfiguration:index.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }


    /**
     * Creates a form to edit a BillingConfiguration entity.
     *
     * @param BillingConfiguration $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(BillingConfiguration $entity)
    {
        $form = $this->createForm(new BillingConfigurationType(), $entity, array(
            'action' => $this->generateUrl('billing-configuration_update'),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BillingConfiguration entity.
     *
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:BillingConfiguration')->findOneBy(array());

        if(!$entity) {
            $entity = new BillingConfiguration();
            $entity->setCurrency("EUR");
            $entity->setSalesAddress("address");
            $entity->setSalesEmail("sales@domain.com");
            $em->persist($entity);
            $em->flush();
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.billing_config.updated_success"));
            return $this->redirect($this->generateUrl('billing-configuration'));
        }

        return $this->render('AppBundle:themes/default/Admin/BillingConfiguration:index.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

}
