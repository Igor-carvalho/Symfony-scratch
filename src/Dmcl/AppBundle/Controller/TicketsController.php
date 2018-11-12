<?php

namespace Dmcl\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dmcl\AppBundle\Controller\BaseController as Controller;

use Dmcl\AppBundle\Entity\TicketsRepliesResellers;
use Dmcl\AppBundle\Entity\TicketsResellers;

/**
 * Tickets controller.
 *
 */
class TicketsController extends Controller
{
    /**
     * Lists all Tickets entities.
     *
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode= $this->getDoctrine()->getManager('xtreamcode');

        $owner = $em->getRepository('AppBundle:RegUsers')->find($this->getUser()->getOwnerId());

        $contacts = $em->getRepository('AppBundle:RegUsers')->findBy([
            "ownerId" => $this->getUser()->getId()
        ]);

        $issues = $emXtreamcode->getRepository('AppBundle:Issues')->findAll();
        
        return $this->render('AppBundle:themes/default/Tickets:index.html.twig', [
            'contacts' => $contacts,
            'owner' => $owner,
            'issues' => $issues,
            'id' => $id
        ]);
    }
    
    /**
     * Lists all Tickets entities.
     *
     */
    public function ajaxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode = $this->getDoctrine()->getManager('xtreamcode');
        $response = ['success' => true, 'datas' => ''];

        $tickets = $emXtreamcode->getRepository('AppBundle:TicketsResellers')->getTickets($this->getUser()->getId());
        
        foreach($tickets as $ticket){
            $messagesUnread = true;
            $owner = $ticket->getFrom() == $this->getUser()->getId()?true:false;

            if($owner){
                $messagesUnread = $ticket->getFromRead() == 0;
            }
            else
                $messagesUnread = $ticket->getToRead() == 0;

            $from = $em->getRepository('AppBundle:RegUsers')->find($ticket->getFrom());   
            $to = $em->getRepository('AppBundle:RegUsers')->find($ticket->getTo());   

            $response['datas'][] = [
                'id' => $ticket->getid(),
                'issue' => $ticket->getIssue(),
                'from' => [
                    'id' => $ticket->getFrom(),
                    'name' => $from->getUsername()
                ],
                'to' => [
                    'id' => $ticket->getTo(),
                    'name' => $to->getUsername()
                ],
                'date' => $ticket->getCreatedAt()->format('m/d/Y'),
                'owner' => $owner,
                'newMessage' => $messagesUnread
            ];
        }

        return new JsonResponse($response, 200);
    }
    
    /**
     * Lists all Tickets entities.
     *
     */
    public function getMessagesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode = $this->getDoctrine()->getManager('xtreamcode');
        $response = ['success' => true, 'datas' => ''];

        $id = $request->get('id');
        $user = $this->getUser();

        $ticket = $emXtreamcode->getRepository('AppBundle:TicketsResellers')->find($id);
        $replies = $ticket->getTickets();

        $response['owner'] = $ticket->getFrom() == $user->getId()?true:false;

        foreach($replies as $reply){
            $create = new \DateTime("@".$reply->getCreatedAt());
            $time = $create->format('H:i:s');

            $response['datas'][] = [
                'id' => $reply->getId(),
                'admin' => $reply->getAdminReply(),
                'message' => $reply->getMessage(),
                'time' => $time
            ];
        }

        if($ticket->getFrom() == $user->getId())
            $ticket->setFromRead(true);

        if($ticket->getTo() == $user->getId())
            $ticket->setToRead(true);

        $emXtreamcode->persist($ticket);
        $emXtreamcode->flush();

        return new JsonResponse($response, 200);
    }

    /**
     * Lists all Tickets entities.
     *
     */
    public function sendAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $response = ['success' => true, 'data' => ''];

        $replies = new TicketsRepliesResellers();

        $id = $request->get("id");
        $ticketId = $request->get("ticketId");
        $message = $request->get("message");

        $ticket = $em->getRepository('AppBundle:TicketsResellers')->find($ticketId);

        $replies->setTicket($ticket);
        $replies->setMessage($message);

        $user = $this->getUser();

        if($ticket->getFrom() == $user->getId()){
            $ticket->setToRead(false);
            $ticket->setFromRead(true);
        }

        if($ticket->getTo() == $user->getId()){
            $replies->setAdminReply(false);

            $ticket->setToRead(true);
            $ticket->setFromRead(false);
        }

        $create = new \DateTime("@".$replies->getCreatedAt());
        $time = $create->format('H:i:s');
        
        $em->persist($replies);
        $em->flush();
        
        $em->persist($ticket);
        $em->flush();

        $response['data']['time'] = $time;

        return new JsonResponse($response, 200);
    }

    /**
     * Creates a new Tickets entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('xtreamcode');
        $emXtreamcode = $this->getDoctrine()->getManager('xtreamcode');
        
        $ticket = new TicketsResellers();
        $replies = new TicketsRepliesResellers();

        $id = $request->get("id");
        $message = $request->get("message");
        $issue = $request->get("issue");

        $response = ['success' => true, 'data' => ''];

        $issue = $emXtreamcode->getRepository('AppBundle:Issues')->find($issue);

        $ticket->setTo($id);
        $ticket->setFrom($this->getUser()->getId());
        $ticket->setIssue($issue->getIssue());
    
        $emXtreamcode->persist($ticket);
        $emXtreamcode->flush();

        $response['data']['time'] = $ticket->getCreatedAt()->format('H:i:s');
        $response['data']['ticketId'] = $ticket->getId();

        $replies->setTicket($ticket);
        $replies->setMessage($message);
    
        $emXtreamcode->persist($replies);
        $emXtreamcode->flush();

        return new JsonResponse($response);
    }

    /**
     * Deletes a Tickets entity.
     *
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager('xtreamcode');

        $entity = $em->getRepository('AppBundle:TicketsResellers')->findOneById($id);

        $em->remove($entity);
        $em->flush();

        return new JsonResponse(200);
    }
    
    /**
     * Get all new user`s notifications
     */
    public function getNotificationsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $emXtreamcode = $this->getDoctrine()->getManager('xtreamcode');
        $user = $this->getUser();

        $response = ['success' => true, 'datas' => ''];

        if ($this->isGranted('ROLE_ADMIN')) {
            $tickets = $emXtreamcode->getRepository('AppBundle:TicketsResellers')->getNotifications($user->getId());

            foreach($tickets as $ticket){
                $from = $em->getRepository('AppBundle:RegUsers')->find($ticket->getFrom()); 

                $response['datas'][] = [
                    'id' => $ticket->getid(),
                    'message' => $ticket->getIssue(),//str_split($ticket->getIssue(), 80)[0].'...',
                    'from' => $from->getUsername(),
                    'date' => $ticket->getCreatedAt()->format('m/d/Y')
                ];
            }
        }
        else{

        }

        return new JsonResponse($response, 200);
    }
}