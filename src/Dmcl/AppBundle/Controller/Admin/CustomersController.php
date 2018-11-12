<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\Customers;
use Dmcl\AppBundle\Form\CustomersType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Customers controller.
 *
 */
class CustomersController extends Controller
{

    /**
     * Lists all Customers entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entities = $em->getRepository('AppBundle:Customers')->findAll();

        return $this->render('@App/themes/default/Admin/Customers/index.html.twig', array(
            'entities' => $entities
        ));        
    }

    /**
     * Creates a new Customers entity.
     *
     */
    public function createAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl("home"));
        }

        $entity = new Customers();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager('xtreamcode');
            
            $em->persist($entity); 
            $em->flush($entity);

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.customers.created_success"));

            return $this->redirect($this->generateUrl('admin_customers'));
        }

        return $this->render('AppBundle:themes/default/Admin/Customers:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Customers entity.
     *
     * @param Customers $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Customers $entity)
    {
        $form = $this->createForm(new CustomersType(), $entity, array(
            'action' => $this->generateUrl('admin_customers_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $this->get("translator")->trans("pages.customers.new.create")));

        return $form;
    }

    /**
     * Displays a form to create a new Customers entity.
     *
     */
    public function newAction()
    {
        $entity = new Customers();
        $entity->setConcurrentConnections($this->container->get('app.config.services')->getGeneralConfig()->getMaxConcurrentConnections());

        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:themes/default/Admin/Customers:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a Customers entity.
     *
     */
    public function showAction($ip)
    {
        $response = $this->get("app.util.services")->sendRequest($this::ROUTE_CUSTOMERS_LIST, $ip);
        $response = json_decode($response);
        
        $code = $response->success;
                                        
        if($response != null){
            $code = $response->success;
                                    
            if($code == 401 || $code == 404 || $code == 500)
                return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                    'msg' => $response->msg,
                    'data' =>  $response->data
                    )); 
                                        
            if($code === 403)
                return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                        'msg' => $response->msg,
                        'password' =>  $response->data->password,
                        'apikey' =>  $response->data->apikey
                )); 
        }   

        return $this->render('AppBundle:themes/default/Admin/Customers:show.html.twig', array(
            'entities' => $response->data,
            'ip' => $ip
        ));
    }

    /**
     * Displays a form to edit an existing Customers entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
                      
        $entity = $em->getRepository('AppBundle:Customers')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customers entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:themes/default/Admin/Customers:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Creates a form to edit a Customers entity.
     *
     * @param Customers $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Customers $entity)
    {
        $form = $this->createForm(new CustomersType(), $entity, array(
            'action' => $this->generateUrl('admin_customers_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => $this->get("translator")->trans("pages.customers.edit.update")));

        return $form;
    }

    /**
     * Edits an existing Customers entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
                      
        $entity = $em->getRepository('AppBundle:Customers')->find($id);       

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.customers.updated_success"));

            return $this->redirect($this->generateUrl('admin_customers'));
        }

        return $this->render('AppBundle:themes/default/Admin/Customers:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Deletes a Customers entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid() || $request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager('xtreamcode');
                      
            $entity = $em->getRepository('AppBundle:Customers')->find($id);           

            if (!$entity) {
                if ($request->isXmlHttpRequest()) {
                    $response = array(
                        "status" => 400,
                        "msg" => $this->get("translator")->trans("pages.customers.msg_delete_error")
                    );

                    return new Response(json_encode($response), 200);
                }
                
                throw $this->createNotFoundException('Unable to find Customers entity.');
            }
                      
            $em->remove($entity);
            $em->flush();
        }

        if ($request->isXmlHttpRequest()) {
            $response = array(
                "status" => 200,
                "msg" => $this->get("translator")->trans("pages.channel.msg_delete_success")
            );

            return new Response(json_encode($response), 200);
        }

        return $this->redirect($this->generateUrl('admin_customers'));
    }

    /**
     * Creates a form to delete a Customers entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_customers_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => $this->get("translator")->trans('pages.customers.index.delete'),
                'attr' => array("class" => "btn btn-danger btn-sm pull-right delete", "style" => "margin-top: -32px;")))
            ->getForm();
    }

    public function generatePlaylistAction(Request $request, $ip, $id)
    {
        $zip = new \ZipArchive;
        $dir_zip = tempnam("/tmp", "playlist");
        $res = $zip->open($dir_zip, \ZipArchive::CREATE);

        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository('AppBundle:Customers')->find($id);

        if (!$customer) {
            throw $this->createNotFoundException('Unable to find Customers entity.');
        }

        $zip->addFromString('playlists', "");

        foreach ($customer->getPlaylists() as $playlist) {
            $m3u_data = $this->get("app.m3u.services")->generateM3U($playlist, $customer->getReseller()->getId(), $customer->getId(), true);
            if ($res === TRUE) {
                $zip->addFromString($playlist->getName() . '-' . time() . '.m3u', $m3u_data);
            }
        }
        $zip->close();
        return new Response(file_get_contents($dir_zip), 200, array(
            'Content-Type' => "application/zip",
            'Content-Disposition' => 'attachment; filename="playlists.zip"',
        ));

    }

}
