<?php

namespace Dmcl\AppBundle\Command;

use Dmcl\AppBundle\Entity\Vod;
use Dmcl\AppBundle\Entity\VodSource;
use Dmcl\AppBundle\Utils\Util;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class DownloadVodCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:download_vod')
            ->setDescription('Download a Vod url with wget.')
            ->addOption('url', null, InputOption::VALUE_REQUIRED, 'The url to download')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'The Vod id into DB');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Container
        $container = $this->getContainer();

        // Options
        $url = $input->getOption('url');
        $id = $input->getOption('id');

        // Filesystem
        $fs = new Filesystem();

        // Vod Manager
        $vodManager = $container->get('app.vod_manager');

        /* Download vod */
        $filename = $vodManager->downloadVod($url, $id);

        // When vod is completed downloaded.....

        /* Probe vod */
        if($vodManager->probeVod($id, $filename)) {
            /* Transcode vod */
            $vodManager->transcoderVod($id, $filename);
            // When vod is transcoded.
            // Update vod Entity
            $vodManager->updateVodSource($id, $filename);
        }

        // Remove logs
        $fs->remove($vodManager->vodDownloadLogPath($id));
        $fs->remove($vodManager->vodTranscoderLogPath($id));
    }
}
