<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dmcl\AppBundle\Command;

/**
 * Description of DaemonCommand
 *
 * @author dani
 */
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;


class DaemonCommand extends ContainerAwareCommand {

    protected $container;

    protected function configure() {
        $this->setName('besttranscoder:daemon:manager')
            ->addArgument('type', InputArgument::REQUIRED, 'The daemon type')
            ->addArgument('action', InputArgument::REQUIRED, 'The action');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->container = $this->getContainer();
        $type = $input->getArgument('type');
        $action = $input->getArgument('action');
        $roorDir = $this->container->getParameter("kernel.root_dir");
        switch($type){
            case "nginx":
                $process = new Process($action=="start"?"$roorDir/nginx/sbin/nginx":"killall $roorDir/nginx/sbin/nginx");
                $process->run(function ($type, $buff) use ($output) {
                    $message = ($type === Process::ERR ? '<comment>%s</comment>' : '<info>%s</info>');
                    $output->writeln(sprintf($message, trim($buff)));
                });
                break;
            case "nodejs":
                $process = new Process("$roorDir/besttranscoder-daemon $action");
                $process->run(function ($type, $buff) use ($output) {
                    $message = ($type === Process::ERR ? '<comment>%s</comment>' : '<info>%s</info>');
                    $output->writeln(sprintf($message, trim($buff)));
                });
                break;
            default:
                break;
        }

//
//        $process = new Process('/home/dani/Dev/IPTV/iptv/iptv-daemon stop');
//        $process->run(function ($type, $buff) use ($output) {
//            $message = ($type === Process::ERR ? '<comment>%s</comment>' : '<info>%s</info>');
//            $output->writeln(sprintf($message, trim($buff)));
//        });

//        $process = new Process('/usr/share/livestream/livestream-daemon start');
//        $process->run(function ($type, $buff) use ($output) {
//            $message = ($type === Process::ERR ? '<comment>%s</comment>' : '<info>%s</info>');
//            $output->writeln(sprintf($message, trim($buff)));
//        });

//        $process = new Process('/usr/share/livestream/nginx/sbin/nginx');
//        $process->run(function ($type, $buff) use ($output) {
//            $message = ($type === Process::ERR ? '<comment>%s</comment>' : '<info>%s</info>');
//            $output->writeln(sprintf($message, trim($buff)));
//        });
//
//
//
//        $process = new Process('killall /usr/share/livestream/nginx/sbin/nginx');
//        $process->run(function ($type, $buff) use ($output) {
//            $message = ($type === Process::ERR ? '<comment>%s</comment>' : '<info>%s</info>');
//            $output->writeln(sprintf($message, trim($buff)));
//        });

    }
}
