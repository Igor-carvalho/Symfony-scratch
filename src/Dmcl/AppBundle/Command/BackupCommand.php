<?php

namespace Dmcl\AppBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputArgument;


class BackupCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('besttranscoder:create:backup')
            ->setDescription('Backup all your database data')
            ->addArgument('filename', InputArgument::REQUIRED, 'The backup filename')
            ->addOption('destination', 'd', InputOption::VALUE_REQUIRED, 'Destination directory relative to kernel root', 'backups')
            ->addOption('date-pattern', null, InputOption::VALUE_REQUIRED, 'The date pattern for backup filename', 'Y-m-d-H-i-s')
            ->addOption('gzip', null, InputOption::VALUE_REQUIRED, 'Enable gzip compressing, value provides compress level', false);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //php app/console livestream:create:backup dani
        $filesystem = new Filesystem();
        $connection = $this->getConnection($input->getOption('connection'));
        $driver = $this->defineDriverName($connection->getDriver());

//        $dir = $this->getContainer()->getParameter('kernel.root_dir') . '/' . trim($input->getOption('destination'), '/');
//        $filesystem->mkdir($dir);

//        $filename = $dir . '/' . $driver . '.' . $connection->getDatabase() . '.' . date($input->getOption('date-pattern')) . '.sql';
        $filename = $input->getArgument('filename');
        $gzip = $input->getOption('gzip');
        switch ($driver) {
            case 'mysql':
                $output->writeln($this->processBackup(sprintf(
                    'mysqldump --user="%s" --password="%s" --host="%s" --port="%s" %s',
                    $connection->getUsername(),
                    $connection->getPassword(),
                    $connection->getHost(),
                    $connection->getPort(),
                    $connection->getDatabase()
                ), $filename, $gzip, $output));
                return;
            case 'pgsql':
                $output->writeln($this->processBackup(sprintf(
                    'export PGPASSWORD=%s pg_dump --username="%s" --host="%s" --port="%s" --dbname="%s"',
                    $connection->getPassword(),
                    $connection->getUsername(),
                    $connection->getHost(),
                    $connection->getPort(),
                    $connection->getDatabase(),
                    $filename
                ), $filename, $gzip, $output));
                return ;
            default:
                throw new \Symfony\Component\Serializer\Exception\UnsupportedException('Backup for "' . $driver . '" driver not supported');
        }
    }

    /**
     * @param string          $command The command string
     * @param string          $filename
     * @param bool|string     $gzip
     * @param OutputInterface $output  An output instance
     *
     * @return int Process exit code
     */
    private function processBackup($command, $filename, $gzip, OutputInterface $output)
    {


        $dir = $this->getContainer()->getParameter('kernel.root_dir').'/../web/';
//        if ($gzip !== false) {
//            $command .= ' | gzip > ' . $filename . '.gz';
//        } else {
        $command .= ' > ' .$dir.'backups/backup.sql';
//        }

        $process = new Process($command);
        $process->run();
        $exitCode =200;
        if (0 === $process->getExitCode()) {
            $zip = new \ZipArchive;
            $dir_zip = $dir.'backups/'.$filename . '.zip';
            $res = $zip->open($dir_zip, \ZipArchive::CREATE);
            if ($res === TRUE) {
                $handle = opendir($dir . 'uploads');
                while ($file = readdir($handle)) {
                    if (is_file($dir . 'uploads/' . $file)) {
                        $zip->addFile($dir . 'uploads/' . $file, "logos/$file");
                    }
                }
                $handle = opendir($dir . 'backups');
                while ($file = readdir($handle)) {
                    if (is_file($dir . 'backups/' . $file)) {
                        $zip->addFile($dir . 'backups/' . $file, "backups/$file");
                    }
                }
                $zip->addFile($dir . 'backups/backup.sql', "backup.sql");
                $zip->close();
                @unlink($dir.'backups/backup.sql');
                $exitCode = 200;
            }else{
                $exitCode = 500;
            }
        } else {
            $exitCode = 500;
        }

        return $exitCode;
    }
}
