<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\StreamReports;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Dmcl\AppBundle\Form\StreamsType;
use Dmcl\AppBundle\Entity\Streams;

/**
 * Class EpgController
 *
 * @package Dmcl\AppBundle\Controller\Admin
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class StreamsController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:themes/default/Admin/Streams:index.html.twig');
    }

    public function indexAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $request->request->get('page');
        $rpp = $request->request->get('rpp');

        $response = array('success' => 200, 'data' => array());

        $entities = $em->getRepository('AppBundle:Streams')->findStreams($page, $rpp);
        foreach($entities as $entity){
            $routeEdit = $this->generateUrl('streams_edit', array('id' => $entity->getId()));
            $routeDelete = $this->generateUrl('streams_delete', array('id' => $entity->getId()));

            $category = $entity->getCategory()?$entity->getCategory()->getCategoryName():"";

            $image = $entity->getStreamIcon();
            $url = $this->generateUrl('_home', array(), true);

            if(!@file_get_contents($entity->getStreamIcon()))
                $image = $url . '/uploads/channel-logo.png';

            $response['data'][] = array(
                'id' => $entity->getId(),
                'name' => '<div class="d-flex">
                                <img src="'.$image.'" alt="" class="table__logo" width="34" height="34">

                                <div class="table__cell-widget">
                                <a href="#" class="table__cell-widget-name">'.$entity->getStreamDisplayName().'</a>
                                <span class="table__cell-widget-description"><span class="ua-icon-export"></span> <a href="'.$entity->getStreamSource().'">'.$this->get("translator")->trans("pages.streams.source").'</a></span>
                                </div>
                            </div>',
                'category' => $category,
                'actions' => '<div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a style="cursor:pointer" class="edit dropdown-item" data-href="'.$routeEdit.'">'.$this->get("translator")->trans("pages.line.index.edit").'</a>
                                        <a style="cursor:pointer" class="delete dropdown-item" data-href="'.$routeDelete.'">'.$this->get("translator")->trans("pages.line.index.delete").'</a>
                                    </div>
                                </div>'
            );
        }

        return new JsonResponse($response, 200);
    }

    public function indexReportAction()
    {
        return $this->render('AppBundle:themes/default/Admin/Streams:indexReport.html.twig');
    }

    public function reportsAction()
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entities = array();

        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
            $entities = $em->getRepository('AppBundle:StreamReports')->findAll();
        else
            $entities = $em->getRepository('AppBundle:StreamReports')->findByUser($this->getUser()->getId());
        
        return $this->render('AppBundle:themes/default/Admin/Streams:reports.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Lists all Streams entities that match width parama name.
     *
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $name = $request->get('name');
        $page = $request->get('page');
        $rpp = $request->get('rpp');

        $datas = [];
        $entities = $em->getRepository('AppBundle:Streams')->Search($name, $page, $rpp);

        foreach($entities as $entity){
            $datas[] = [
                'id' => $entity->getId(),
                'name' => $entity->getStreamDisplayName()
            ];
        }

        return new JsonResponse(['datas' => $datas], 200);
    }

    public function submitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $sound = $request->get('sound');
        $picture = $request->get('picture');
        $down = $request->get('down');
        $wrong = $request->get('wrong');
        $id = $request->get('id');
        $name = $request->get('name');

        $report = new StreamReports();
        $report->setStreamName($name);
        $report->setStreamId($id);

        $issues = [];

        if($sound)
            $issues[] = 'No Sound';

        if($picture)
            $issues[] = 'No Picture';

        if($down)
            $issues[] = 'Channel is down';

        if($wrong)
            $issues[] = 'Wrong Channel';
            
        $report->setIssues($issues);  

        $em->persist($report);
        $em->flush();

        return new JsonResponse(200);
    }
    
    /**
     * Deletes a Users entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()|| $request->isXmlHttpRequest()) {

            $entity = $em->getRepository('AppBundle:Streams')->find($id);

            if (!$entity) {
                if($request->isXmlHttpRequest()){
                    $response = array(
                        "status"=>400,
                        "msg"=>$this->get("translator")->trans("pages.stream.msg_delete_error")
                    );

                    return new Response(json_encode($response),200);
                }

                throw $this->createNotFoundException('Unable to find Stram entity.');
            } 

            $em->remove($entity);
            $em->flush();
        }

        if($request->isXmlHttpRequest()){
            $response = array(
                "status"=>200,
                "msg"=>$this->get("translator")->trans("pages.streams.msg_delete_success")
            );

            return new Response(json_encode($response),200);
        }
        
        return $this->redirect($this->generateUrl('line'));
    }

    /**
     * Creates a form to delete a Users entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
       return $this->createFormBuilder()
            ->setAction($this->generateUrl('streams_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' =>  $this->get("translator")->trans('pages.line.delete'),
                'attr'=>array("class"=>"btn btn-danger btn-sm pull-right delete","style"=>"margin-top: -32px;")))
            ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing Users entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('AppBundle:Streams')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:themes/default/Admin/Streams:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Users entity.
    *
    * @param Users $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Streams $entity)
    {
        $form = $this->createForm(new StreamsType(), $entity, array(
            'action' => $this->generateUrl('streams_update', ['id' => $entity->getId()]),
            'method' => 'PUT'
        ));

        $form->add('submit', 'submit', array('label' =>  $this->get("translator")->trans('pages.streams.update')));

        return $form;
    }
    /**
     * Edits an existing Users entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('AppBundle:Streams')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) { 
            $em->persist($entity);
            $em->flush();
           
            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.streams.updated_success"));

            return $this->redirect($this->generateUrl('streams'));
        }

        return $this->render('AppBundle:themes/default/Admin/Users:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Creates a new Users entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = new Streams();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) { 
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get("translator")->trans("pages.streams.created_success"));

            return $this->redirect($this->generateUrl('streams'));
        }

        return $this->render('AppBundle:themes/default/Admin/Streams:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Streams entity.
     *
     * @param Streams $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Streams $entity)
    {
        $form = $this->createForm(new StreamsType(), $entity, array(
            'action' => $this->generateUrl('streams_create'),
            'method' => 'POST'
        ));

        $form->add('submit', 'submit', array('label' => $this->get("translator")->trans('pages.streams.create')));

        return $form;
    }

    /**
     * Displays a form to create a new Streams entity.
     *
     */
    public function newAction()
    {        
        $em = $this->getDoctrine()->getManager();

        $entity = new Streams();
        $form = $this->createCreateForm($entity);

        return $this->render('AppBundle:themes/default/Admin/Streams:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }
}
