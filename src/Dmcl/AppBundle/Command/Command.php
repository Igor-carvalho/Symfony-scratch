<?php

namespace Dmcl\AppBundle\Command;

use Doctrine\DBAL\Driver;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;

abstract class Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->addOption('connection', 'c', InputOption::VALUE_OPTIONAL, 'The connection name');
    }

    protected function defineDriverName(Driver $driver)
    {
        $name = $driver->getName();
        if (preg_match('~mysql~', $name) !== 0) {
            return 'mysql';
        } elseif (preg_match('~pgsql~', $name) !== 0) {
            return 'pgsql';
        } else {
            return $name;
        }
    }

    /**
     * @param string $connection
     *
     * @return \Doctrine\DBAL\Connection
     */
    protected function getConnection($connection)
    {
        return $this->getContainer()->get('doctrine')->getConnection($connection);
    }
} 
