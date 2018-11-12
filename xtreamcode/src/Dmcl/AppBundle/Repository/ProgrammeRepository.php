<?php

namespace Dmcl\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProgrammeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProgrammeRepository extends EntityRepository
{

    public function queryAllProgrammes($channel){
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT programme FROM AppBundle:Programme programme WHERE programme.channel =:channel');
        $consulta->setParameter('channel', $channel);
        return $consulta;
    }

    public function findAllProgrammes($channel){
        return $this->queryAllProgrammes($channel)->getResult();
    }




}