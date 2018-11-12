<?php

namespace Dmcl\AppBundle\Controller;

use Dmcl\AppBundle\Entity\Message;
use Dmcl\AppBundle\Form\PushMessageType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PushMessagesController
 *
 * @package Dmcl\AppBundle\Controller
 *
 * @Route("/push-messages")
 */
class PushMessagesController extends Controller
{
    /**
     * @Route("/", name = "app.push_messages.index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository("AppBundle:Message")->findBy(array("user" => $this->getUser()));
        return $this->render('AppBundle:PushMessages:index.html.twig', array('messages' => $messages));
    }

    /**
     * @Route("/new", name="app.push_messages.new")
     */
    public function newAction(Request $request)
    {
        $message = new Message();
        $form = $this->createForm(new PushMessageType(), $message);

        return $this->handleRequest($form, $request, $this->get("translator")->trans("push_message_created"));
    }

    /**
     * @Route("/{id}/edit", name="app.push_messages.edit")
     */
    public function editAction(Request $request, Message $message)
    {
        $form = $this->createForm(new PushMessageType(), $message);

        return $this->handleRequest($form, $request, $this->get("translator")->trans("push_message_edited"));
    }

    private function handleRequest(Form $form, Request $request, $successMsg)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /**
             * @var Message $message
             */
            $message = $form->getData();

            $user = $this->getUser();

            $codes = $em->getRepository("AppBundle:ActivationCode")->findBy(array("reseller" => $user));

            $message->setCodes(new ArrayCollection($codes));
            $message->setUser($user);

            $em->persist($message);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $successMsg);
            return $this->redirect($this->generateUrl('app.push_messages.index'));
        }

        return $this->render('@App/PushMessages/form.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/{id}/delete", name="app.push_messages.delete")
     *
     * @param Message $message
     * @return Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Message $message)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();

        $response = array(
            "status" => 200,
            "msg" => $this->get("translator")->trans("episode_deleted_success")
        );

        return new Response(json_encode($response), 200);
    }
}
