<?php

namespace Dmcl\AppBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Description of Users
 *
 * @author dmanuelcl@gmail.com
 */
class Users {

    private $container;

    function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    //proxy para solicitar los servicios como si de un controlador se tratara para evitar el ->container->get(...)
    private function get($service){
        return $this->container->get($service);
    }

  public function isPremium(){
      $em = $this->get("doctrine.orm.default_entity_manager");
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
          return false;
      }

     $currentUser =  $this->get('security.token_storage')->getToken()->getUser();

      $user = $em->getRepository('AppBundle:UsersMembership')->findOneBy(array("user"=>$currentUser,"expired"=>false));
      return is_object($user);
  }

}
