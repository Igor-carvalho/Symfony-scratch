<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Command;

/**
 * Description of UpdateEpgCommand
 *
 * @author dani
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface

    ;

class UpdateEpgCommand extends ContainerAwareCommand {

    protected $container;

    protected function configure() {
        $this->setName('besttranscoder:epg:update');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->container = $this->getContainer();
        $em = $this->container->get('doctrine')->getManager();
        $today = new \DateTime("today");
        $entities = $em->getRepository('AppBundle:Epg')->findByNextUpdate($today);
        foreach($entities as $entity){
            $this->container->get("app.xmltv.services")->process($entity);
        }
        echo "Ok";
    }
}
