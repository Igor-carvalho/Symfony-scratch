<?php

namespace Dmcl\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ChannelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChannelRepository extends EntityRepository
{

    public function findChannelsAvailableForAdd($id){
        return $this->createQueryBuilder("c")
            ->where("c.enabled =true")
            ->andWhere("c.id not in (:id) and c.owner=:owner")
            ->setParameter("id",$id)
            ->setParameter("owner","admin")
            ->getQuery()
            ->getResult();
    }

    public function findByNameAndCategory($name ,$category,$owner) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
                                SELECT ch FROM AppBundle:Channel ch
                                WHERE ch.enabled = true and ch.name LIKE :name and ch.owner = :owner and ch.category = :category')
            ->setParameter('name', "%$name%")
            ->setParameter('owner', $owner)
            ->setParameter('category', $category);
        return $query->getResult();
    }

    public function findByNameAndCategoryFree($name ,$category,$owner) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
                                SELECT ch FROM AppBundle:Channel ch
                                WHERE ch.enabled = true and ch.price = 0  and ch.name LIKE :name and ch.owner = :owner and ch.category = :category')
            ->setParameter('name', "%$name%")
            ->setParameter('owner', $owner)
            ->setParameter('category', $category);
        return $query->getResult();
    }

    public function findChannelsHttpRtsp($owner) {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
                                SELECT ch FROM AppBundle:Channel ch
                                WHERE ch.protocol = 'http' or ch.protocol = 'rtsp' and ch.owner = :owner")           
            ->setParameter('owner', $owner);

        return $query->getResult();
    }

}
