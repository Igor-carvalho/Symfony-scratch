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

use steevanb\SSH2Bundle\Entity\Profile;
use steevanb\SSH2Bundle\Entity\Connection;

class Ssh2Command extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:ssh2')
            ->setDescription('Execute commands way ssh')
            ->addOption('ip', null, InputOption::VALUE_REQUIRED, 'The ip to connect')
            ->addOption('port', null, InputOption::VALUE_REQUIRED, 'The port to connect')
            ->addOption('user', null, InputOption::VALUE_REQUIRED, 'The user to connect')
            ->addOption('pass', null, InputOption::VALUE_REQUIRED, 'The pass to connect')
            ->addOption('index', null, InputOption::VALUE_REQUIRED, 'The index of command pased')
            ->addOption('command', null, InputOption::VALUE_REQUIRED, 'Command to execute');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Container
        $container = $this->getContainer();

        // Options
        $ip = $input->getOption('ip');
        $port = $input->getOption('port');
        $username = $input->getOption('user');
        $password = $input->getOption('pass');
        $index = $input->getOption('index');
        $command = $input->getOption('command');

        # create connection profile
        $profile = new Profile($ip, $username, $password, $port);
        
        # create connection, and connect
        
        $connection = new Connection($profile);

        $connection->execLines($command);

        if($index == 0)
            $connection->execLines('chmod 777 /tmp/wmclient_setup.run');
    }
}
