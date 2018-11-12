<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\Settings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

//use Symfony\Component\Process\Process;

/**
 * Settings controller.
 *
 */
class SettingsController extends Controller
{
    /**
     * Lists all Settings entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:Settings')->findOneByUser($this->getUser()->getId());

        if (!$entity) {
            $entity = new Settings();
            $entity->setServerName("Besttranscoder");
            $entity->setTimeZone("America/Havana");
            $entity->setLogo("favico.ico");
            $entity->setPlayerLogo("favico.ico");
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();
        }

        $formsSettings = array(
            'entity' => $entity,
        );

        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $editFormSystemInfo = $this->createForm($this->get('app.form.settings.system_info'), $entity);
            $formsSettings['edit_form_system_info'] = $editFormSystemInfo->createView();

            $editFormEmailSupport = $this->createForm($this->get('app.form.settings.email_support'), $entity);
            $formsSettings['edit_form_email_support'] = $editFormEmailSupport->createView();
        }

        return $this->render('AppBundle:themes/default/Admin/Settings:index.html.twig', $formsSettings);
    }

    /**
     * Edits an existing Settings entity.
     *
     */
    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $form_save = $request->get('form_save');

        $entity = $em->getRepository('AppBundle:Settings')->findOneByUser($this->getUser()->getId());

        if (!$entity) {
            $entity = new Settings();
            $entity->setServerName("IPTVt ranscoder");
            $entity->setTimeZone("America/Havana");
            $entity->setLogo("favico.ico");
            $entity->setPlayerLogo("favico.ico");
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();
        }       

        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $editFormSystemInfo = $this->createForm($this->get('app.form.settings.system_info'), $entity);
        }
        
        $editFormEmailSupport = $this->createForm($this->get('app.form.settings.email_support'), $entity);

        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $editForm = $editFormSystemInfo;
        }

        switch ($form_save) {
            case 'system_info':
                $editForm = $editFormSystemInfo;
                break;
            case 'email_support':
                $editForm = $editFormEmailSupport;
                break;
        }

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('settings'));
        }

        $formsSettings = ['entity' => $entity,
            'edit_form_email_support' => $editFormEmailSupport->createView(),
            'server_info' => $this->getServerInfo()
        ];

        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $formsSettings['edit_form_system_info'] = $editFormSystemInfo->createView();
        }

        return $this->render('AppBundle:themes/default/Admin/Settings:index.html.twig', $formsSettings);
    }
    
    /**
     * Lists all Users entities.
     *
     */
    public function updateStyleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $style = $request->get('style');
        $flag = $request->get('flag');

        $response = ['success' => 200, 'data' => ''];

        $entity = $em->getRepository('AppBundle:Settings')->findOneByUser($this->getUser()->getId());

        if($flag)
            $entity->setStyleLayout($style);
        else
            $entity->setStyleColor($style);

        $em->persist($entity);
        $em->flush();

        return new JsonResponse($response, 200);
    }
}