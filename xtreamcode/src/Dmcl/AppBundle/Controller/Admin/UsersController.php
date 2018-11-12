<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Dmcl\AppBundle\Entity\Enigma2Devices;
use Dmcl\AppBundle\Entity\MagDevices;
use Dmcl\AppBundle\Entity\RegUserlog;
use Dmcl\AppBundle\Entity\Users;
use Dmcl\AppBundle\Form\UsersType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Users controller.
 *
 */
class UsersController extends Controller
{
    private function expiredPeriod($expDate)
    {
        $date = new \DateTime('now');
        $date = date_timestamp_get($date);

        if ($expDate <= $date) {
            return 0;
        }

        return 1;
    }

    private function remaining($expDate)
    {
        $interval = '';

        if ($expDate) {
            $date = new \DateTime('now');
            $expDate = new \DateTime("@$expDate");
            $expDate = $expDate->format('Y-m-d H:i:s');

            $expDate = date_create_from_format('Y-m-d H:i:s', $expDate);
            $interval = date_diff($date, $expDate);

            $interval = $interval->format('%a days');
        }

        return $interval;
    }

    private function getMac($id)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $user = $em->getRepository('AppBundle:Users')->find($id);
        $mag = $em->getRepository('AppBundle:MagDevices')->findOneByUser($user);

        $mac = '';

        if ($mag) {
            $mac = base64_decode($mag->getMac());
        }

        return $mac;
    }

    /**
     * Lists all Users entities.
     *
     */
    public function indexAction()
    {
        return $this->render('@App/themes/default/Admin/Line/index.html.twig');
    }

    /**
     * Lists all Users entities.
     *
     */
    public function ajaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $request->get('page');
        $rpp = $request->get('rpp');

        $response = ['success' => 200, 'data' => []];

        $id = $this->getUser()->getId();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $id = '';
        }

        $entities = $em->getRepository('AppBundle:Users')->findLines($id, $page, $rpp);

        foreach ($entities as $entity) {
            $date = '';

            if ($entity->getCreatedAt()) {
                $create = new \DateTime('@'.$entity->getCreatedAt());
                $date = $create->format('m/d/Y');
            }

            $now = new \DateTime('now');
            $now = date_timestamp_get($now);

            $expDate = '';

            if ($entity->getExpDate()) {
                $expDate = new \DateTime('@'.$entity->getExpDate());
                $expDate = $expDate->format('m/d/Y');
            }

            $enableClassAdmin = $entity->getAdminEnabled() ? 'badge-circle-success' : 'badge-circle-danger';
            $enableClassUser = $entity->getEnabled() ? 'badge-circle-success' : 'badge-circle-danger';

            $routeEdit = $this->generateUrl('line_edit', ['id' => $entity->getId()]);
            $routeDelete = $this->generateUrl('line_delete', ['id' => $entity->getId()]);
            $routeBouquets = $this->generateUrl('line_bouquets', ['id' => $entity->getId()]);

            $trial = '';
            $remaining = '';
            $expiredTag = '';
            $mac = '';
            $expired = false;

            if ($entity->getIsTrial()) {
                $trial = '<div class="col-md-4 offset-2">
                                <span class="badge badge-sm badge-rose mb-3 mr-3">Trial</span>
                            </div>';
            }

            if ($this->expiredPeriod($entity->getExpDate()) <= 0) {
                $expired = true;

                $expiredTag = '<div class="col-md-4">
                                    <span class="badge badge-sm badge-danger mb-3 mr-3">Expired</span>
                                </div>';
            }

            if (!$expired) {
                $interval = $this->remaining($entity->getExpDate());

                $remaining = '<p>'.$interval.'</p>';
            }

            $mag = $em->getRepository('AppBundle:MagDevices')->findOneByUser($entity);
            $e2 = $em->getRepository('AppBundle:Enigma2Devices')->findOneByUser($entity);
            if ($mag) {

                $mac = '<p title="MAG" class="color-success"><span id="edit-mac'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-pencil"></span> <span id="remove-mac'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-trash"></span> <span id="show-mac-'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-eye"></span></p><p>MAC: '.$mag->getMac().'</p>';
            } else {
                $mac = '<p class="mag color-info" style="cursor:pointer;">Add Mag</p>';
            }

            if ($e2) {
                $mac .= '<p title="Enigma2" class="color-warning"><span id="edit-e2'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-pencil"></span> <span id="remove-e2'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-trash"></span> <span id="show-e2-'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-eye"></span></p><p>MAC: '.$e2->getMac().'</p>';
            } else {
                $mac .= '<p class="enigma2 color-info" style="cursor:pointer;">Add Enigma2</p>';
            }

            $actions = '<div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a style="cursor:pointer" class="bouquets dropdown-item" data-href="'.$routeBouquets.'">'.$this->get('translator')->trans('pages.line.attrs.bouquets').'</a>
                                <a style="cursor:pointer" class="note dropdown-item">'.$this->get('translator')->trans('pages.line.attrs.note').'</a>
                                <a style="cursor:pointer" class="parental-code dropdown-item">'.$this->get('translator')->trans('pages.line.attrs.parental_code').'</a>
                                <a style="cursor:pointer" class="download dropdown-item">'.$this->get('translator')->trans('pages.line.attrs.download').'</a>
                           ';

            if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $actions .= '<a style="cursor:pointer" class="edit dropdown-item" data-href="'.$routeEdit.'">'.$this->get('translator')->trans('pages.line.index.edit').'</a>
                             <a style="cursor:pointer" class="delete dropdown-item" data-href="'.$routeDelete.'">'.$this->get('translator')->trans('pages.line.index.delete').'</a>';
            }

            $actions .= '</div></div>';

            $response['data'][] = [
                'id'          => $entity->getId(),
                'username'    => $entity->getUsername(),
                'password'    => $entity->getPassword(),
                'date'        => $date,
                'enabled'     => '<div class="row">
                                <div class="col-md-4 offset-1">admin</div>
                                <div class="col-md-5 offset-1">you</div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 offset-2">
                                    <span title="'.$entity->getAdminEnabled().'" class="badge-circle mr-3 '.$enableClassAdmin.'"></span>
                                </div>
                                <div class="col-md-5">
                                    <span title="'.$entity->getEnabled().'" class="badge-circle mr-3 '.$enableClassUser.'"></span>
                                </div>
                            </div>',
                'credentials' => '<div class="table__cell-widget">
                                        <span class="table__cell-widget-name">'.$entity->getUsername().'</span>
                                        <span class="table__cell-widget-description color-gray">
                                            <span style="display:none;" class="hidden" id="password-'.$entity->getId().'">'.$entity->getPassword().'</span> 
                                            <span id="show-'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-eye"></span>
                                            <span id="edit-password'.$entity->getId().'" onclick="showHidePassword(\''.$entity->getId().'\')" style="cursor:pointer;" class="color-info ua-icon-pencil">
                                        </span>
                                    </div>',
                'remaining'   => '<div class="row">
                                   '.$trial.'
                                    '.$expiredTag.'
                                </div>
                                '.$remaining.'
                                <p style="margin-top:0px;">'.$expDate.'</p>',
                'owner'       => $entity->getMember()->getUsername(),
                'mac_address' => $mac,
                'status'      => '<span class="badge badge-default badge-rounded mb-3 mr-3">0/'.$entity->getMaxConnections().'</span>',
                'dashboard'   => '',
                'note'        => $entity->getResellerNotes(),
                'actions'     => $actions,
            ];

        }

        return new JsonResponse($response, 200);
    }

    /**
     * Creates a new Users entity.
     *
     */
    public function createAction(Request $request, $trial)
    {
        $emXC = $this->getDoctrine()->getManager('xtreamcode');
        $em = $this->getDoctrine()->getManager();

        $entity = new Users();
        $form = $this->createCreateForm($entity, $trial);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $package = $request->get('package');
            $bouquets = $request->get('bouquets');

            $package = $package != -1 ? $emXC->getRepository('AppBundle:Packages')->find($package) : null;

            $dateCreate = $entity->getCreatedAt()->format('Y-m-d H:i:s');

            if ($entity->getResellerNotes() == '') {
                $entity->setResellerNotes('');
            }

            $discount = 0;
            $credits = 0;

            if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $discount = $this->getUser()->getCredits() - $package->getCredits();
                $credits = $this->getUser()->getCredits();

                $this->getUser()->setCredits($discount);
            }

            if ($package) {
                $entity->setIsTrial($package->getIsTrial());

                $duration = $package->getDuration();
                $durationin = $package->getDurationIn();

                $expired = strtotime("$dateCreate+$duration $durationin");
                $entity->setExpDate($expired);

                $bouquets = $package->getBouquets();

                $entity->setBouquet($bouquets);

                $entity->setCreatedAt($entity->getCreatedAt()->getTimestamp());

                $entity->setMaxConnections($package->getMaxConnections());
                $entity->setIsMag($package->getCanGenMag());
                $entity->setIsE2($package->getCanGenE2());
                $entity->setCreatedBy($this->getUser()->getId())
                    ->setMember($this->getUser()->getId());
            } else {
                $entity->setIsTrial(true);

                $expired = strtotime("$dateCreate+1 month");
                $entity->setExpDate($expired);

                $entity->setBouquet(json_encode($bouquets));

                $entity->setCreatedAt($entity->getCreatedAt()->getTimestamp());

                $entity->setCreatedBy($this->getUser()->getId())
                    ->setMember($this->getUser()->getId());
                $entity->setAdminNotes($entity->getResellerNotes());
            }

            $em->persist($entity);
            $em->flush();

            $log = new RegUserlog();

            $log->setUsername($entity->getUsername());
            $log->setPassword($entity->getPassword());
            $log->setUser($this->getUser());

            if ($package) {
                $msg = '[<b>UserPanel</b> -> <u>New Line</u>] with Package ['.$package->getName().'], Credits: <font color="green">'.$credits.'</font> -> <font color="red">'.$this->getUser()->getCredits().'</font>';
            } else {
                $msg = '[<b>UserPanel</b> -> <u>New Line</u>] with Package [Trial], Credits: <font color="green">'.$credits.'</font> -> <font color="red">'.$this->getUser()->getCredits().'</font>';
            }

            if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $msg = '[<b>AdminPanel</b> -> Add Line]';
            }

            $log->setType($msg);

            $em->persist($log);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success',
                $this->get('translator')->trans('pages.line.created_success'));

            return $this->redirect($this->generateUrl('line'));
        }

        $packages = [];
        $bouquets = [];

        if (!$trial) {
            $packages = $emXC->getRepository('AppBundle:Packages')->findBy([
                'status' => true,
            ]);
        }

        $bouquetsId = json_decode($packages[0]->getBouquets());

        foreach ($bouquetsId as $id) {
            $bouquet = $em->getRepository('AppBundle:Bouquets')->find($id);

            if ($bouquet) {
                $bouquets[] = [
                    'id'          => $bouquet->getId(),
                    'bouquetName' => $bouquet->getBouquetName(),
                ];
            }
        }

        return $this->render('AppBundle:themes/default/Admin/Line:new.html.twig', [
            'entity'   => $entity,
            'form'     => $form->createView(),
            'trial'    => $trial,
            'packages' => $packages,
            'bouquets' => $bouquets,
        ]);
    }

    /**
     * Creates a form to create a Users entity.
     *
     * @param Users $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Users $entity, $trial)
    {
        $url = $trial ? 'line_create_trial' : 'line_create';

        $form = $this->createForm(new UsersType(), $entity, [
            'action' => $this->generateUrl($url),
            'method' => 'POST',
            'trial'  => $trial,
        ]);

        $form->add('submit', 'submit', ['label' => $this->get('translator')->trans('pages.line.new.create')]);

        return $form;
    }

    /**
     * Displays a form to create a new Users entity.
     *
     */
    public function newAction($trial)
    {
        $em = $this->getDoctrine()->getManager();
        $emXC = $this->getDoctrine()->getManager('xtreamcode');

        $entity = new Users();
        $form = $this->createCreateForm($entity, $trial);

        $packages = [];
        $bouquets = [];

        if (!$trial) {
            $packages = $emXC->getRepository('AppBundle:Packages')->findBy([
                'status' => true,
            ]);

            $bouquetsId = json_decode($packages[0]->getBouquets());

            foreach ($bouquetsId as $id) {
                $bouquet = $em->getRepository('AppBundle:Bouquets')->find($id);

                if ($bouquet) {
                    $bouquets[] = [
                        'id'          => $bouquet->getId(),
                        'bouquetName' => $bouquet->getBouquetName(),
                    ];
                }
            }
        } else {
            $bouquets = $em->getRepository('AppBundle:Bouquets')->findAll();
        }

        return $this->render('AppBundle:themes/default/Admin/Line:new.html.twig', [
            'entity'   => $entity,
            'form'     => $form->createView(),
            'trial'    => $trial,
            'packages' => $packages,
            'bouquets' => $bouquets,
        ]);
    }

    /**
     * Finds and displays a Users entity.
     *
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = [];

        return $this->render('AppBundle:themes/default/Admin/Users:show.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * Displays a form to edit an existing Users entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $emXC = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:Users')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $bouquets = [];

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $packages = $emXC->getRepository('AppBundle:Packages')->findAll();

        $bouquetsId = json_decode($entity->getBouquet());

        foreach ($bouquetsId as $id) {
            $bouquet = $em->getRepository('AppBundle:Bouquets')->find($id);

            if ($bouquet) {
                $bouquets[] = [
                    'id'          => $bouquet->getId(),
                    'bouquetName' => $bouquet->getBouquetName(),
                ];
            }
        }

        return $this->render('AppBundle:themes/default/Admin/Line:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'packages'    => $packages,
            'bouquets'    => $bouquets,
        ]);
    }

    /**
     * Creates a form to edit a Users entity.
     *
     * @param Users $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Users $entity)
    {
        $form = $this->createForm(new UsersType(), $entity, [
            'action'       => $this->generateUrl('line_update', ['id' => $entity->getId()]),
            'method'       => 'PUT',
            'showPassword' => true,
        ]);

        $form->add('submit', 'submit', ['label' => $this->get('translator')->trans('pages.line.edit.update')]);

        return $form;
    }

    /**
     * Edits an existing Users entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $emXC = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:Users')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $package = $request->get('package');
            $bouquets = $request->get('bouquets');
            $changePackage = $request->get('changePackage');

            if ($entity->getResellerNotes() == '') {
                $entity->setResellerNotes('');
            }

            if ($changePackage) {
                $package = $package != -1 ? $emXC->getRepository('AppBundle:Packages')->find($package) : null;

                $dateCreate = $entity->getCreatedAt();
                $dateCreate = new \DateTime("@$dateCreate");
                $dateCreate = $dateCreate->format('Y-m-d H:i:s');

                if ($package) {
                    $entity->setIsTrial($package->getIsTrial());

                    $duration = $package->getDuration();
                    $durationin = $package->getDurationIn();

                    $expired = strtotime("$dateCreate+$duration $durationin");
                    $entity->setExpDate($expired);

                    $bouquets = $package->getBouquets();

                    $entity->setBouquet($bouquets);

                    $entity->setMaxConnections($package->getMaxConnections());
                    $entity->setIsMag($package->getCanGenMag());
                    $entity->setIsE2($package->getCanGenE2());
                }
            }

            $em->persist($entity);
            $em->flush();

            $log = new RegUserlog();

            $log->setUsername($entity->getUsername());
            $log->setPassword($entity->getPassword());
            $log->setUser($this->getUser());

            $msg = '[<b>UserPanel</b> -> <u>Edit Line</u>]';

            if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $msg = '[<b>AdminPanel</b> -> Edit Line]';
            }

            $log->setType($msg);

            $em->persist($log);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success',
                $this->get('translator')->trans('pages.line.updated_success'));

            return $this->redirect($this->generateUrl('line'));
        }

        $packages = [];

        $packages = $em->getRepository('AppBundle:Packages')->findAll();
        $bouquets = $em->getRepository('AppBundle:Bouquets')->findAll();

        return $this->render('AppBundle:themes/default/Admin/Users:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'packages'    => $packages,
            'bouquets'    => $bouquets,
        ]);
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

        if ($form->isValid() || $request->isXmlHttpRequest()) {

            $entity = $em->getRepository('AppBundle:Users')->find($id);

            if (!$entity) {
                if ($request->isXmlHttpRequest()) {
                    $response = [
                        'status' => 400,
                        'msg'    => $this->get('translator')->trans('pages.line.msg_delete_error'),
                    ];

                    return new Response(json_encode($response), 200);
                }

                throw $this->createNotFoundException('Unable to find Users entity.');
            }

            $em->remove($entity);
            $em->flush();

            $log = new RegUserlog();

            $log->setUsername($entity->getUsername());
            $log->setPassword($entity->getPassword());
            $log->setUser($this->getUser());

            $msg = '[<b>UserPanel</b> -> <u>Delete Line</u>]';

            if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
                $msg = '[<b>AdminPanel</b> -> Delete Line]';
            }

            $log->setType($msg);

            $em->persist($log);
            $em->flush();
        }

        if ($request->isXmlHttpRequest()) {
            $response = [
                'status' => 200,
                'msg'    => $this->get('translator')->trans('pages.line.msg_delete_success'),
            ];

            return new Response(json_encode($response), 200);
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
            ->setAction($this->generateUrl('line_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', [
                'label' => $this->get('translator')->trans('pages.line.delete'),
                'attr'  => ['class' => 'btn btn-danger btn-sm pull-right delete', 'style' => 'margin-top: -32px;'],
            ])
            ->getForm();
    }

    public function updateNoteAction(Request $request)
    {
        $response = ['sueccess' => true];

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('id');
        $note = $request->get('note');

        $entity = $em->getRepository('AppBundle:Users')->find($id);

        $entity->setResellerNotes($note);

        $em->persist($entity);
        $em->flush();

        return new JsonResponse($response, 200);
    }

    public function bouquetsAction(Request $request)
    {
        $response = ['sueccess' => true, 'data' => ''];

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $entity = $em->getRepository('AppBundle:Users')->find($id);

        $bouquets = json_decode($entity->getBouquet(), true);

        foreach ($bouquets as $bouquet) {
            $entity = $em->getRepository('AppBundle:Bouquets')->find($bouquet);

            if ($entity) {
                $response['data'][] = [
                    'id'   => $entity->getId(),
                    'name' => $entity->getBouquetName(),
                ];
            }
        }

        return new JsonResponse($response, 200);
    }

    public function updateBouquetsAction(Request $request)
    {
        $response = ['sueccess' => true];

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('id');
        $bouquets = $request->get('bouquets');

        $entity = $em->getRepository('AppBundle:Users')->find($id);

        $entity->setBouquet(json_encode($bouquets));

        $em->persist($entity);
        $em->flush();

        return new JsonResponse($response, 200);
    }

    public function updateMACAction(Request $request)
    {
        $response = ['sueccess' => true];

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('id');
        $mac = $request->get('mac');

        $entity = $em->getRepository('AppBundle:Users')->find($id);
        $mag = new MagDevices();
        $mag->setUser($entity)
            ->setMac($mac)
            ->setAspect('rca')
            ->setCreated(time())
            ->setStbType('')
            ->setFavChannels('')
            ->setTvArchiveContinued('')
            ->setWatchdogTimeout(0)
            ->setDeviceId($id);

        $em->persist($mag);
        $em->flush();

        return new JsonResponse($response, 200);
    }

    public function updateE2Action(Request $request)
    {
        $response = ['sueccess' => true];

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('id');
        $mac = $request->get('mac');

        $entity = $em->getRepository('AppBundle:Users')->find($id);
        $enigma2 = new Enigma2Devices();
        $enigma2
            ->setUser($entity)
            ->setMac($mac)
            ->setModemMac('')
            ->setLocalIp('')
            ->setPublicIp('')
            ->setKeyAuth('')
            ->setEnigmaVersion('')
            ->setCpu('')
            ->setVersion('')
            ->setLversion('')
            ->setToken('')
            ->setLastUpdated(0)
            ->setWatchdogTimeout(0)
            ->setOriginalMac(0);

        $em->persist($enigma2);
        $em->flush();

        return new JsonResponse($response, 200);
    }

    public function updateParentalCodeAction(Request $request)
    {
        $response = ['sueccess' => true];

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('id');
        $code = $request->get('code');

        $entity = $em->getRepository('AppBundle:Users')->find($id);

        return new JsonResponse($response, 200);
    }

    public function lineDevicesAction(Request $request)
    {
        $response = ['sueccess' => true, 'datas' => ''];

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('id');

        $entity = $em->getRepository('AppBundle:Users')->find($id);
        $devices = $em->getRepository('AppBundle:Devices')->findAll();

        foreach ($devices as $device) {
            $response['datas'][] = [
                'id'   => $device->getDeviceId(),
                'name' => $device->getDeviceName(),
                'key'  => $device->getDeviceKey(),
            ];
        }

        return new JsonResponse($response, 200);
    }
}