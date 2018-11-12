<?php

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\VodSource;
use Dmcl\AppBundle\Utils\Util as Utils;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Class VodManager
 *
 * @package Dmcl\AppBundle\Services
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class VodManager
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var Filesystem
     */
    private $fs;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->fs = new Filesystem();
    }

    /**
     * Download vod from url and save the process's output into logfile
     *
     * @param $url The url to download.
     * @param $id The Vod id into DB.
     * @return string Return the filename downloaded
     */
    public function downloadVod($url, $id)
    {
        /* Download vod */
        // Configure logfile.
        $logfile = Utils::createLogfile($this->vodDownloadLogPath(), self::LOG($id));
        // Create a unique name for output file downloaded.
        $filename = 'src.' . Utils::md5($id) . '.mp4';
        // Create command line
        $commandline = "wget " . $url . " -O " . $this->vodDownloadPath($filename) . " -o " . $logfile;
        // Create process and disable timeout
        $process = new Process($commandline);
        $process->setTimeout(null);
        // Run command
        $process->run();

        return $filename;
    }

    /**
     * Probe if th filename is a vod.
     *
     * @param $id The Vod id into DB.
     * @param $filename The filename to probe
     * @return bool Return true if is a valid vod, false otherwise
     */
    public function probeVod($id, $filename)
    {
        /* Probe vod */
        $command = $this->container->getParameter('ffprobe.bin') . ' -loglevel warning ' . $this->vodDownloadPath($filename);
        $process = new Process($command);
        $process->run(function ($type, $buffer) use ($id) {
            // Dump output content into logfile
            file_put_contents(
                Utils::createLogfile($this->container->getParameter('app.vod.probe_log_path'), "$id.log"),
                $buffer,
                FILE_APPEND
            );
        });

        if (file_exists($this->container->getParameter('app.vod.probe_log_path') . "/$id.log")) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Transcode de vod file to mp4 and save the process's output into logfile
     *
     * @param $id The Vod id into DB.
     * @param $filename The filename to transcode.
     */
    public function transcoderVod($id, $filename, $way = 1)
    {
        /* Convert vod */
        // Configure logfile.
        $logfile = Utils::createLogfile($this->vodTranscoderLogPath(), self::LOG($id));        
        // Create command line
        $inputFile = $this->vodUploadPath($filename, $way);
        
        $trozos = explode(".", $filename); 
        $extension = end($trozos);
        $filename = $trozos[0].$trozos[1].".mp4";
        
        $outputFile = $this->vodTranscoderPath($filename);
        $commandline = $this->container->getParameter("ffmpeg.bin") . " -i \"$inputFile\" -vf scale=720x560,setdar=16:9,setsar=1:1 -profile:v main -acodec aac -strict experimental -r 30 -vcodec libx264 -s 720x560 -y \"$outputFile\"";
        // Create process and disable timeout
        $process = new Process($commandline);
        $process->setTimeout(null);
        // Run command
        $process->run(function ($type, $buffer) use ($logfile) {
            // Dump output content into logfile
            file_put_contents($logfile, $buffer, FILE_APPEND);
        });
    }

    /**
     * Update the vod source into db.
     *
     * @param integer $id The vod id to update into db.
     * @param $filename The vod file.
     */
    public function updateVodSource($id, $filename)
    {
        // EntityManager
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $entity = $em->getRepository("AppBundle:Vod")->findOneById($id);

        if ($entity != null) {

            // If action is to add a new vod then vod source is null.
            $vodSource = $entity->getSources()[0];

            if ($vodSource == null) {
                $vodSource = new VodSource();
            }

            // Get new information.
            $trozos = explode(".", $filename); 
            $extension = end($trozos);
            $filename = $trozos[0].$trozos[1].".mp4";
            $sourcePath = $this->vodTranscoderPath($filename);

            $vodSource->setVideo($filename);
            $vodSource->setDuration(
                $this->container->get('app.util.services')->videoDuration($sourcePath)
            );
            $vodSource->setSize(filesize($sourcePath));

            // Moving new vod to public and creating symlink.
            $targetPath = $this->vodPublicPath($filename);
            $commandline = "mv " . $sourcePath . " " . $targetPath;
            $process = new Process($commandline);
            $process->run();

            $this->fs->symlink($targetPath, $this->vodPublicSymlinkPath($filename));

            //Add new source
            $entity->addSource($vodSource);

            // Update int db
            $em->persist($entity);
            $em->flush();

            // Removing original vod.
            $this->fs->remove($this->vodUploadPath($filename));
        }
    }

    public function removeVod($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('AppBundle:Vod')->find($id);

        // Removing video and symlink file
        $sources = $entity->getSources();
        $filename = $sources[0]->getVideo();
        $file = $this->getFinalPath() . '/' . $filename;
        $symbFile = $this->getFinalPath() . '/../' . $filename;

        $arr = array($file, $symbFile);
        $this->fs->remove($arr);

        $em->remove($entity);
        $em->flush();
    }

    /**
     * Return the path where Vod will be uploaded.
     *
     * @param $filename The Vod filename
     * @return string The Vod path
     */
    public function vodUploadPath($filename, $way = 1)
    {
        // Check where vod will be uploaded.
        //$parameter = $way == 1?'app.vod.upload_path':'app.vod.local';
        
        $path = rtrim($this->container->getParameter('app.vod.upload_path'), '/\\');        
        return $this->checkPath($path) . "/" . $filename;
    }

    /**
     * Return the path where Vod will be downloaded.
     *
     * @param $filename The Vod filename
     * @return string The Vod path
     */
    public function vodDownloadPath($filename)
    {
        // Check where vod will be uploaded.
        $path = rtrim($this->container->getParameter("app.vod.download_path"), '/\\');
        return $this->checkPath($path) . "/" . $filename;
    }

    /**
     * Return the path of vod's logfile downloaded.
     * If id is passed return the complete path to file else only return the parent directory.
     *
     * @param int|null $id The Vod id into db.
     * @return string The Vod path
     */
    public function vodDownloadLogPath($id = null)
    {
        // Check where vod will be uploaded.
        $path = rtrim($this->container->getParameter("app.vod.download_log_path"), '/\\');

        if ($id)
            return $this->checkPath($path) . "/" . self::LOG($id);

        return $this->checkPath($path);
    }

    /**
     * Return the path of vod's logfile for probe action.
     * If id is passed return the complete path to file else only return the parent directory.
     *
     * @param int|null $id The Vod id into db.
     * @return string The Vod path
     */
    public function vodProbeLogPath($id = null)
    {
        // Check where vod will be uploaded.
        $path = rtrim($this->container->getParameter("app.vod.probe_log_path"), '/\\');

        if ($id)
            return $this->checkPath($path) . "/" . self::LOG($id);

        return $this->checkPath($path);
    }

    /**
     * Return the path where Vod will be transcoded.
     *
     * @param $filename The Vod filename
     * @return string The transcoder Vod path
     */
    public function vodTranscoderPath($filename)
    {
        // Check where vod will be transcoder.
        $path = rtrim($this->container->getParameter("app.vod.transcoder_path"), '/\\');
        return $this->checkPath($path) . "/" . $filename;
    }

    /**
     * Return the path of vod's logfiletranscoded.
     *
     * @return string The transcoder Vod path
     */
    public function vodTranscoderLogPath($id = null)
    {
        // Check where vod will be transcoder.
        $path = rtrim($this->container->getParameter("app.vod.transcoder_log_path"), '/\\');

        if ($id)
            return $this->checkPath($path) . "/" . self::LOG($id);

        return $this->checkPath($path);
    }

    /**
     * Return the path where Vod is public.
     *
     * @param $filename The Vod filename
     * @return string The public Vod path
     */
    public function vodPublicPath($filename)
    {
        // Check where vod will be transcoder.
        $path = rtrim($this->container->getParameter("app.vod.public_path"), '/\\');
        return $this->checkPath($path) . "/" . $filename;
    }

    /**
     * Return symlink path where Vod is public.
     *
     * @param $filename The Vod filename
     * @return string The symlink Vod path
     */
    public function vodPublicSymlinkPath($filename)
    {
        // Check where vod will be transcoder.
        $path = rtrim($this->container->getParameter("app.vod.public_symlink_path"), '/\\');
        return $this->checkPath($path) . "/" . $filename;
    }

    /**
     * Check the path existence, if not exists when is created.
     *
     * @param string $path Path of directory.
     * @return string Return the path.
     */
    private function checkPath($path)
    {
        // Check if directory exists.
        if (!$this->fs->exists($path)) {
            $this->fs->mkdir($path);
        }
        return $path;
    }

    /**
     * Return the log's name.
     *
     * @param $id The Vod id
     * @return string
     */
    public static function LOG($id)
    {
        return "vod_$id.log";
    }

    /**
     * Read the progress for vod.
     *
     * @param int $id Vod id
     * @return int Progress
     */
    public function downloadProgress($id)
    {
        $logfile = $this->vodDownloadLogPath($id);

        $content = @file_get_contents($logfile);
        $percent = 100;
        if ($content) {
            preg_match_all("/[[:digit:]]*%/", $content, $matches);
            $percent = preg_split("/%/", array_pop($matches[0]))[0];
        }
        return $percent;
    }
}
