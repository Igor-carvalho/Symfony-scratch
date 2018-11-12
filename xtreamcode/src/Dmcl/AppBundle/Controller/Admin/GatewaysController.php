<?php
namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\Gateways;
use Dmcl\AppBundle\Form\GatewaysType;

/**
 * Gateways controller.
 *
 */
class GatewaysController extends Controller
{

    /**
     * Lists all Gateways entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entities = $em->getRepository('AppBundle:Gateways')->findAll();

        return $this->render('AppBundle:themes/default/Admin/Gateways:index.html.twig', array(
            'entities' => $entities,
        ));
    }
	
    /**
     * Creates a new Gateways entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = new Gateways();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gateways_show', array('uniquename' => $entity->getUniqueName())));
        }

        return $this->render('AppBundle:themes/default/Admin/Gateways:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Gateways entity.
     *
     * @param Gateways $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Gateways $entity)
    {
        $form = $this->createForm(new GatewaysType(), $entity, array(
            'action' => $this->generateUrl('gateways_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Gateways entity.
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $entity = new Gateways();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:themes/default/Admin/Gateways:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Gateways entity.
     *
     */
    public function showAction($uniquename)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName($uniquename);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gateways entity.');
        }

        $deleteForm = $this->createDeleteForm($uniquename);

        return $this->render('AppBundle:themes/default/Admin/Gateways:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gateways entity.
     *
     */
    public function editAction($uniquename)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName($uniquename);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gateways entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($uniquename);

        return $this->render('AppBundle:themes/default/Admin/Gateways:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Gateways entity.
    *
    * @param Gateways $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Gateways $entity)
    {
        $form = $this->createForm(new GatewaysType(), $entity, array(
            'action' => $this->generateUrl('gateways_update', array('uniquename' => $entity->getUniqueName())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => $this->get("translator")->trans("pages.gateways.edit.update")));

        return $form;
    }
    /**
     * Edits an existing Gateways entity.
     *
     */
    public function updateAction(Request $request, $uniquename)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName($uniquename);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gateways entity.');
        }

        $deleteForm = $this->createDeleteForm($uniquename);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.gateways.updated_success"));

            return $this->redirect($this->generateUrl('gateways'));
        }

        return $this->render('AppBundle:themes/default/Admin/Gateways:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Gateways entity.
     *
     */
    public function deleteAction(Request $request, $uniquename)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        
        $form = $this->createDeleteForm($uniquename);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $em->getRepository('AppBundle:Gateways')->findOneByUniqueName($uniquename);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gateways entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gateways'));
    }

    /**
     * Creates a form to delete a Gateways entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($uniquename)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gateways_delete', array('uniquename' => $uniquename)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
