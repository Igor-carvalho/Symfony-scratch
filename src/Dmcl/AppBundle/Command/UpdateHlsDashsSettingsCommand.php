<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Command;

/**
 * Description of AnuciosCommand
 *
 * @author dani
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface

    ;

class UpdateHlsDashsSettingsCommand extends ContainerAwareCommand {

    protected $container;

    protected function configure() {
        $this->setName('besttranscoder:update:hlsdash');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine')->getManager();


        /*$days = 7;
        $consulta = $em->createQuery('DELETE FROM AppBundle:Programme programme WHERE programme.day <=:date');
        $consulta->setParameter('date', new \DateTime("today - $days days"));
        $consulta->execute();*/
        $output->writeln('Ok');
    }

}
