<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Command;

/**
 * Description of UpdatePlaybackHistoryCommand
 *
 * @author dani
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Logger\ConsoleLogger;

class UpdatePlaybackHistoryCommand extends ContainerAwareCommand
{

    protected $container;

    protected function configure()
    {
        $this->setName('besttranscoder:update:playback');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {        
        $this->container = $this->getContainer();        

        $em = $this->container->get('doctrine')->getManager();
        $startAt = new \DateTime("now - 30 minutes");
        $finishedAt = new \DateTime("now");
        $history = $em->getRepository('AppBundle:PlayBackHistory')->findForPlayFinished($startAt);
        
        $this->container->get("logger")->alert(count($history));
        
        foreach ($history as $entity) {
            $entity->setFinished(true);
            $entity->setFinishedAt($finishedAt);           

            $em->flush();

            $countryPlaybackHistory = $em->getRepository('AppBundle:CountryPlaybackHistory')->findOneBy(array(
                "country"=>$entity->getCountry(),
                "mediaType"=>$entity->getMediaType()
            ));        
            
            $countryPlaybackHistory->setTotal($countryPlaybackHistory->getTotal()?$countryPlaybackHistory->getTotal()-1:0);

            $em->flush();
        }
    }
}
