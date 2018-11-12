<?php

namespace Dmcl\AppBundle\Controller;


use Dmcl\AppBundle\Utils\Util;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;

class DropzoneController extends BaseController
{
    /**
     * @var Filesystem
     */
    private $fs;

    public function __construct()
    {
        $this->fs = new Filesystem();
    }
   
    public function uploadAction(Request $request, $type)
    {   
        if ($file = $request->files->get('file')) {
            $tempDir = $this->getTempPath();

            $name = $file->getClientOriginalName();
            $size = $file->getClientSize();
            $extension = $file->getClientOriginalExtension();

            $filename = Util::md5("$name$size$extension");
            if($type == "video") {
                $filename = 'src.' . $filename . '.mp4';
            }
            else {
                $filename = 'src.' . $filename . '.' . $extension;
            }

            $file->move($tempDir, $filename);

            $content = ['file' => $filename, 'temporal' => true];
            $status = 200;
        } else {
            $content = "File could not be saved.";
            $status = 500;
        }

        return new Response(json_encode($content), $status);
    }
   
    public function removeFileAction(Request $request)
    {
        $filename = $request->get("file");
        $temporal = $request->get("temporal");
        $type = $request->get("type");

        //Remove file.
        if($temporal == "false") {
            if($type == 'series')
                $command = 'rm ' . $this->getFinalPath() . '/' . $filename;
            else
                $command = 'rm ' . $this->getFinalPath() . '/vod-files/' . $filename;
        } else {
            $command = 'rm ' . $this->getTempPath() . '/' . $filename;
        }
        $process = new Process($command);
        $process->run();

        return new Response();
    }
    
    public function getFileSizeAction(Request $request)
    {        
        $filename = $request->get("file");
        $temporal = $request->get("temporal");
        $type = $request->get("type");

        if($temporal == "false") {
            if($type == 'series')
                $size = filesize($this->getFinalPath() . '/' . $filename);
            else
                $size = filesize($this->getFinalPath() . '/vod-files/' . $filename);
        } else {
            $size = filesize($this->getTempPath() . '/' . $filename);
        }

        return new JsonResponse($size);
    }

    protected function getTempPath()
    { 
        return rtrim($this->getParameter("vod_upload"), '/\\');
    }

    protected function getFinalPath() {       
        return $this->getParameter('kernel.root_dir') . '/nginx/html/';
    }
}
