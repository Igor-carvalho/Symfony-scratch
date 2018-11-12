<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Command;

/**
 * Description of CheckSubscriptionsCommand
 *
 * @author dani
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateSubscriptionsCommand extends ContainerAwareCommand
{

    protected $container;

    protected function configure()
    {
        $this->setName('besttranscoder:update:subscriptions');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container = $this->getContainer();
        $em = $this->container->get('doctrine')->getManager();
        $consulta = $em->createQuery('UPDATE AppBundle:Subscriptions subscriptions SET subscriptions.expired=true WHERE subscriptions.expired <=:expired AND subscriptions.expireAt<:expiredAt');
        $consulta->setParameter('expiredAt', new \DateTime("now"));
        $consulta->setParameter('expired', false);
        $consulta->execute();
        $output->writeln('Ok');
    }

}
