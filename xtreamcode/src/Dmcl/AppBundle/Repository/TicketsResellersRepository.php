<?php

namespace Dmcl\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TicketsResellersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketsResellersRepository extends EntityRepository
{
    public function getTickets($id)
    {
        $qb = $this->getEntityManager('xtreamcode')->createQueryBuilder();

        $qb->select('t')
            ->from('AppBundle:TicketsResellers', 't')
            ->where('t.status = 1')
            ->andWhere('t.from = :idFrom or t.to = :idTo')
            ->setParameter("idFrom", $id)
            ->setParameter("idTo", $id);

        return $qb->getQuery()->getResult();
    }
    
    public function getNotifications($id)
    {
        $qb = $this->getEntityManager('xtreamcode')->createQueryBuilder();

        $qb->select('t')
            ->from('AppBundle:TicketsResellers', 't')
            ->where('t.status = 1')
            ->andWhere('t.from = :idFrom and t.fromRead = 0')
            ->orWhere('t.to = :idTo and t.toRead = 0')
            ->setParameter("idFrom", $id)
            ->setParameter("idTo", $id);

        return $qb->getQuery()->getResult();
    }
}