<?php

namespace Dmcl\AppBundle\Twig\Extension;

use Dmcl\AppBundle\Entity\Vod;
use Dmcl\AppBundle\Services\VodManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

use Dmcl\AppBundle\Controller\BaseController;

class VodStatusExtension extends \Twig_Extension
{
    /**
     * @var Filesystem
     */
    private $fs;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->fs = new Filesystem();
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('vod_status', array($this, 'vodStatus')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('vod_status', array($this, 'vodStatus')),
        );
    }

    public function vodStatus(Vod $vod, $ip)
    {
        $id = $vod->getId();

        $response = $this->container->get("app.util.services")->sendRequest(BaseController::ROUTE_VODS_STATUS.$id, $ip);
        $response = json_decode($response); 

        $code = $response->success;
        
        if($code === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response->msg,
                    'password' =>  $response->data->password,
                    'apikey' =>  $response->data->apikey
                ));
                 
        if($code === 500){
            return $this->render('AppBundle:themes/default/Home:error500.html.twig', array(
                'msg' => $response->msg,
                'data' =>  $response->data
            ));
        }

        return $response->data;
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app.twig.extension.vod_status';
    }
}
