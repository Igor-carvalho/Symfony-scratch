<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\Epg;
use Dmcl\AppBundle\Form\EpgType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EpgController
 *
 * @package Dmcl\AppBundle\Controller\Admin
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class EpgController extends Controller
{

    /**
     * Lists all Epg entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Epg')->findAll();

        return $this->render('AppBundle:themes/default/Admin/Epg:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
