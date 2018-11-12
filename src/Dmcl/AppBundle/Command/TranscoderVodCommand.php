<?php

namespace Dmcl\AppBundle\Command;

use Dmcl\AppBundle\Utils\Util;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class TranscoderVodCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:transcoder_vod')
            ->setDescription('Convert a Vod to mp4 with library')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'The Vod id into DB')
            ->addOption('file', null, InputOption::VALUE_REQUIRED, 'The Vod file')
            ->addOption('way', null, InputOption::VALUE_REQUIRED, 'The way to obtine the Vod file');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Container
        $container = $this->getContainer();

        // Vod Manager
        $vodManager = $container->get('app.vod_manager');

        // Options
        $id = $input->getOption('id');
        $filename = $input->getOption('file');
        $way = $input->getOption('way');

        // Filesystem
        $fs = new Filesystem();

        /* Transcode vod */
        $vodManager->transcoderVod($id, $filename, $way);

        // Remove log
        $fs->remove($vodManager->vodTranscoderLogPath($id));

        // When vod is transcoded.
        // Update vod Entity
        $vodManager->updateVodSource($id, $filename);
    }
}
