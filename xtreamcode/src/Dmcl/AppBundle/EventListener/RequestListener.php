<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\EventListener;

use Dmcl\AppBundle\Entity\Visits;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Description of RequestListener
 *cache cleared and new code not detected
 * @author dani
 */
class RequestListener
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
//        $em = $this->container->get('doctrine')->getManager();
//        $request = $event->getRequest();

        // if (!$request->isXmlHttpRequest()) {
        //     $visit = new Visits();
        //     $visit->setVisitedAt(new \DateTime("now"));
        //     $visit->setIpAddress($request->getClientIp());
        //     $visit->setPage($request->getUri());

        //     $entity = $em->getRepository('AppBundle:Visits')->findVisit($visit);
        //     if (!$entity) {
        //         $em->persist($visit);
        //         $em->flush();
        //     }
        // }

    }

}
