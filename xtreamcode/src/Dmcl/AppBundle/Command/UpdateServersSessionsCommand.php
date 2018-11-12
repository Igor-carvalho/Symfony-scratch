<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Command;

/**
 * Description of UpdateServersSessionsCommand
 *
 * @author dani
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateServersSessionsCommand extends ContainerAwareCommand
{

    protected $container;

    protected function configure()
    {
        $this->setName('besttranscoder:update:servers-sessions');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container = $this->getContainer();
        $em = $this->container->get('doctrine.orm.entity_manager');
        $startAt = new \DateTime("now - 1 day");
        $finishedAt = new \DateTime("now");
        $sessions = $em->getRepository('AppBundle:ServersSessions')->findForSessionFinished($startAt,"Channel");
        echo count($sessions);
        foreach ($sessions as $entity) {
            $entity->setActive(false);
            $entity->setFinishedAt($finishedAt);
        }

        $startAt = new \DateTime("now - 30 minutes");
        $finishedAt = new \DateTime("now");
        $sessions = $em->getRepository('AppBundle:ServersSessions')->findForSessionFinished($startAt,"Vod");
        echo count($sessions);
        foreach ($sessions as $entity) {
            $entity->setActive(false);
            $entity->setFinishedAt($finishedAt);
        }
        $em->flush();
        echo "Ok";
    }
}
