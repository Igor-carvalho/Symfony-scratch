<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Dmcl\AppBundle\Entity\Logs;
use Doctrine;

/**
 * Logs controller.
 *
 */
class LogsController extends Controller
{
    /**
     * Lists all Logs entities.
     *
     */
    public function indexAction()
    {
        return $this->render('@App/themes/default/Admin/Logs/index.html.twig'); 
    }
    
    /**
     * Lists all Logs entities in Json.
     *
     */
    public function ajaxAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $page = $request->get('page');
        $rpp = $request->get('rpp');

        $response = array('success' => 200, 'data'  => array());
        $id = $this->getUser()->getId();

        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
            $id = "";

        $entities = $em->getRepository('AppBundle:RegUserlog')->findLogs($id, $page, $rpp);

        foreach($entities as $entity){
            $dateTime = new \DateTime("@".$entity->getDate());
            $date = $dateTime->format('m/d/Y');
            $hore = $dateTime->format('H:i:s');

            $response['data'][] = array(
                'id' => $entity->getId(),
                'date' => '<div class="table__cell-widget">
                                    <span class="table__cell-widget-name">'.$date.'</span>
                                    <span class="table__cell-widget-description color-gray">'.$hore.'</span>
                                </div>',
                'username' => $entity->getUsername(),
                'details' => $entity->getType(),
//                // by igor
                'owner' => $entity->getUser()->getUsername()
            );
        }

        if($response['data'] == array()){
            $response['data'] = array('id' => '', 'date' => '', 'username' => '', 'details' => '', 'owner' => '');
        }

        return new JsonResponse($response, 200);
    }
}
