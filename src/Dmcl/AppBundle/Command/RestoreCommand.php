<?php

namespace Dmcl\AppBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Serializer\Exception\UnsupportedException;


class RestoreCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('besttranscoder:backup:restore')
            ->setDescription('Restores a backup')
            ->addArgument('file', InputArgument::REQUIRED, 'The backup filename');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $connection = $this->getConnection($input->getOption('connection'));
        $driver = $this->defineDriverName($connection->getDriver());
        $filename = $input->getArgument('file');

        $zip = new \ZipArchive;
        $res = $zip->open($filename);

        if ($res === TRUE) {
            @rmdir("/tmp/backup_restore/");
            $zip->extractTo('/tmp/backup_restore');
            $zip->close();
        }
            switch ($driver) {
                case 'mysql':
                    return $output->writeln($this->processRestore(sprintf(
                        'mysqldump --user="%s" --password="%s" --host="%s" --port="%s" %s',
                        $connection->getUsername(),
                        $connection->getPassword(),
                        $connection->getHost(),
                        $connection->getPort(),
                        $connection->getDatabase(),
                        ""
                    ),sprintf(
                        'mysql --user="%s" --password="%s" --host="%s" --port="%s" %s < %s',
                        $connection->getUsername(),
                        $connection->getPassword(),
                        $connection->getHost(),
                        $connection->getPort(),
                        $connection->getDatabase(),
                        '/tmp/backup_restore/backup.sql'
                    ), $output));
                case 'pgsql':
                    return $output->writeln($this->processRestore(sprintf(
                        'export PGPASSWORD=%s pg_dump --username="%s" --host="%s" --port="%s" --dbname="%s"',
                        $connection->getPassword(),
                        $connection->getUsername(),
                        $connection->getHost(),
                        $connection->getPort(),
                        $connection->getDatabase()
                    ),sprintf(
                        'export PGPASSWORD=%s psql --username="%s" --host="%s" --port="%s" --dbname="%s" --file="%s"',
                        $connection->getPassword(),
                        $connection->getUsername(),
                        $connection->getHost(),
                        $connection->getPort(),
                        $connection->getDatabase(),
                        $filename
                    ), $output));
                default:
                    throw new UnsupportedException('Restore for "' . $driver . '" driver not supported');
            }


    }

    /**
     * @param string          $command The command string
     * @param OutputInterface $output  An output instance
     *
     * @return int Process exit code
     */
    private function processRestore($saveCommand,$command, OutputInterface $output)
    {
        $dir = $this->getContainer()->getParameter('kernel.root_dir').'/../web/';
        $appDir =  $this->getContainer()->getParameter('kernel.root_dir') ;

        $process = new Process($saveCommand.' > ' .$dir.'/backups/backup.sql');
        $process->run();
        if (0 === $exitCode = $process->getExitCode()) {
            $process = new Process("php $appDir/console doctrine:database:drop --force");
            if (0 !== $exitCode = $process->run()) {
                return 501;
            }

            $process = new Process("php $appDir/console doctrine:database:create");
            if (0 !== $exitCode = $process->run()) {
                return 501;
            }

            $process = new Process($command);
            $process->run();
            if (0 === $exitCode = $process->getExitCode()) {
                $handle = opendir( '/tmp/backup_restore/logos');
                while ($file = readdir($handle)) {
                    if (is_file('/tmp/backup_restore/logos/' . $file)) {
                        $file = new \Symfony\Component\HttpFoundation\File\File("/tmp/backup_restore/logos/" . $file);
                        @$file->move( $dir = $this->getContainer()->getParameter('upload.dir').'/', $file);
                    }
                }
                $handle = opendir( '/tmp/backup_restore/backups');
                while ($file = readdir($handle)) {
                    if (is_file('/tmp/backup_restore/backups/' . $file)) {
                        $file = new \Symfony\Component\HttpFoundation\File\File("/tmp/backup_restore/backups/" . $file);
                        @$file->move( $dir = $this->getContainer()->getParameter('backups.dir').'/', $file);
                    }
                }
                $process = new Process("php $appDir/console doctrine:schema:update --force");
                if (0 !== $exitCode = $process->run()) {
                    return 501;
                }
                return 200;
            }else{
                return 501;
            }
        }
        return 500;
    }
}
