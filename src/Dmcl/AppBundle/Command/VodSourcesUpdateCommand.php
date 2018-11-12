<?php

namespace Dmcl\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class VodSourcesUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vod:sources:update')
            ->setDescription('...')
            ->addArgument('videos', InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'The path list of the videos (separate multiple names with a space)')
            ->addOption(
                'vod', null, InputOption::VALUE_REQUIRED, 'The vod id'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file_list = $input->getArgument('videos');
        if (count($file_list) > 0) {
            $vod_id = $input->getOption('vod');
            $em = $this->getContainer()->get('doctrine.orm.entity_manager');
            $vod = $em->getRepository('AppBundle:Vod')->find($vod_id);
            $folderName = '';
            if ($vod)
                $folderName = $vod->getFolder();
            $targetDir = $this->getFinalDir($folderName);
            $fs = new Filesystem();
            foreach ($file_list as $file) {
                if (file_exists($file)) {
                    $video = basename($file);
                    $sources = $em->getRepository('AppBundle:VodSource')->findBy(array(
                        'video' => $video
                    ));
                    foreach ($sources as $source) {
                        $vod_src = $source->getVod();
                        if ($vod && $vod_src && $vod->getId() == $vod_src->getId()) {
                            $output->writeln('Updating metadata for video: ' . $video);
                            $source->setDuration(
                                $this->getContainer()->get('app.util.services')->videoDuration($file)
                            );
                            $source->setSize(filesize($file));
                            $source->setEnabled(true);
                            $em->persist($source);
                            $em->flush();
                            $fs->rename($file, $targetDir . '/' . $video);
                        }
                    }
                } else {
                    $output->writeln('The video : ' . $file . 'does not exist.');
                }
            }
        } else {
            $output->writeln('Lists of videos not supplied.');
        }
    }

    private function getFinalDir($folderName)
    {
        return $this->getVodPath() . '/' . $folderName;
    }

    private function getVodPath()
    {
        return rtrim($this->getContainer()->getParameter("vod_upload"), '/\\');
    }
}
