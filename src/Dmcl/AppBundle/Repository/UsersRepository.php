<?php

namespace Dmcl\AppBundle\Repository;

/**
 * UsersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersRepository extends \Doctrine\ORM\EntityRepository
{
    public function findLines($id, $page, $rpp)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('u')
            ->from('AppBundle:Users', 'u')
            ->orderBy('u.createdAt', 'desc')
            ->setFirstResult(($page-1)*$rpp)->setMaxResults($rpp); 
            
        if($id){
            $qb->where('u.createdBy = :id')
               ->setParameter('id', $id);
        }

        return $qb->getQuery()->getResult();
    }

    public function totalLines($befor, $now, $id = '')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('COUNT(u)')
            ->from('AppBundle:Users', 'u')
            ->where('u.createdAt >= :befor and u.createdAt <= :now')
            ->setParameter('befor', $befor)
            ->setParameter('now', $now);
            
        if($id){
            $qb->andWhere('u.createdBy = :id')
                ->setParameter('id', $id);
        }
            
        return $qb->getQuery()->getResult();
    }

    public function totalLinesPremium($befor, $now, $trial, $id = '')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('COUNT(u)')
            ->from('AppBundle:Users', 'u')
            ->where('u.isTrial = :trial')
            ->andWhere('u.createdAt >= :befor and u.createdAt <= :now')
            ->setParameter('befor', $befor)
            ->setParameter('now', $now)
            ->setParameter('trial', $trial);
            
        if($id){
            $qb->andWhere('u.createdBy = :id')
                ->setParameter('id', $id);
        }
            
        return $qb->getQuery()->getResult();
    }

    public function totalLinesExpired($befor, $now, $id = '')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $date = new \DateTime('now');
        $date = date_timestamp_get($date);
        
        $qb->select('COUNT(u)')
            ->from('AppBundle:Users', 'u')
            ->where("u.expDate != 'NULL' and u.expDate <= :date")
            ->andWhere('u.createdAt >= :befor and u.createdAt <= :now')
            ->setParameter('befor', $befor)
            ->setParameter('now', $now)
            ->setParameter('date', $date);
            
        if($id){
            $qb->andWhere('u.createdBy = :id')
                ->setParameter('id', $id);
        }
            
        return $qb->getQuery()->getResult();
    }

    public function totalLinesMag($befor, $now, $id = '')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('COUNT(u)')
            ->from('AppBundle:Users', 'u')
            ->where('u.isMag = 1')
            ->andWhere('u.createdAt >= :befor and u.createdAt <= :now')
            ->setParameter('befor', $befor)
            ->setParameter('now', $now);
            
        if($id){
            $qb->andWhere('u.createdBy = :id')
                ->setParameter('id', $id);
        }
            
        return $qb->getQuery()->getResult();
    }

    public function totalLinesEnigma2($befor, $now, $id = '')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('COUNT(u)')
            ->from('AppBundle:Users', 'u')
            ->where('u.isE2 = 1')
            ->andWhere('u.createdAt >= :befor and u.createdAt <= :now')
            ->setParameter('befor', $befor)
            ->setParameter('now', $now);
            
        if($id){
            $qb->andWhere('u.createdBy = :id')
                ->setParameter('id', $id);
        }
            
        return $qb->getQuery()->getResult();
    }

    public function totalLinesAssigned($befor, $now, $id = '')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $qb->select('COUNT(u)')
            ->from('AppBundle:Users', 'u')
            ->where('u.pairId != \'NULL\'')
            ->andWhere('u.createdAt >= :befor and u.createdAt <= :now')
            ->setParameter('befor', $befor)
            ->setParameter('now', $now);
            
        if($id){
            $qb->andWhere('u.createdBy = :id')
                ->setParameter('id', $id);
        }
            
        return $qb->getQuery()->getResult();
    }
}