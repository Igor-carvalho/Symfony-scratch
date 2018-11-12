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

class CleanCommand extends ContainerAwareCommand
{

    protected $container;

    protected function configure()
    {
        $this->setName('besttranscoder:clean');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo "okkkk";
    }

}
