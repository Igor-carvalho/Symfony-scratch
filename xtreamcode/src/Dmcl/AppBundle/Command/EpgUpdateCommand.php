<?php

namespace Dmcl\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class EpgUpdateCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:epg_update')
            ->setDescription('EPG Updater')
            ->addOption("id", null, InputOption::VALUE_REQUIRED, "Epg entity id");
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getOption("id");

        $container = $this->getContainer();
        $em = $container->get("doctrine.orm.default_entity_manager");

        $epg = $em->getRepository("AppBundle:Epg")->find($id);
        if($epg) {
            $xmltv = $container->get("app.xmltv.services");
            $xmltv->process($epg);
        }

    }
}
