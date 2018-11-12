<?php

namespace Dmcl\AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Description of Config
 *
 * @author dmanuelcl@gmail.com
 */
class Config {

    private $container;

    function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    //proxy para solicitar los servicios como si de un controlador se tratara para evitar el ->container->get(...)
    private function get($service){
        return $this->container->get($service);
    }

    public function getGeneralConfig(){
      $em = $this->get("doctrine.orm.xtreamcode_entity_manager");

      $settings = $em->getRepository("AppBundle:Settings")->findOneBy(array());

      if (!$settings) {
          throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
      }
      
      return $settings;
    }

  public function getTranscoderConfig(){
      $em = $this->get("doctrine.orm.xtreamcode_entity_manager");
      $config = $em->getRepository("AppBundle:TranscoderConfig")->findOneBy(array());
      if (!$config) {
          throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
      }
      return $config;
  }

}
