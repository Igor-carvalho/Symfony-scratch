<?php

namespace Dmcl\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * VodPackageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VodPackageRepository extends EntityRepository
{

    public function findForSale(){
        return  $this->createQueryBuilder("vp")
            ->select("vp")
            ->where("vp.enabled=true")
            ->Andwhere("vp.owner=:owner")
            //->andWhere("vp.price>0")
            ->setParameter("owner","admin")
            ->getQuery()
            ->getResult();
    }

    public function findChannelsAvailableForAdd($id){
        return $this->createQueryBuilder("vp")
            ->where("vp.enabled =true")
            ->andWhere("vp.id not in (:id) and vp.owner=:owner")
            ->setParameter("id",$id)
            ->setParameter("owner","admin")
            ->getQuery()
            ->getResult();
    }

    public function findVideoPackageLive()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select('vodPackage')
            ->from('AppBundle:VodPackage', 'vodPackage')
            ->where($qb->expr()->isNotNull('vodPackage.live'))
            ->orderBy('vodPackage.name', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
