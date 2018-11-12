<?php
/**
 * Created by PhpStorm.
 * User: lazaro.garcia
 * Date: 4/8/2016
 * Time: 3:47 PM
 */

namespace Dmcl\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ActivationCodeRepository extends EntityRepository
{

    public function generateReport($reseller, $date)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('activationCode')
            ->from('AppBundle:ActivationCode', 'activationCode')
            ->orderBy('activationCode.created', 'DESC');

        if ($reseller) {
            $qb
                ->join('activationCode.reseller', 'reseller')
                ->andWhere('reseller.id = :reseller')
                ->setParameter('reseller', $reseller);
        }
		
        if ($date) {
            $qb
                ->andWhere('activationCode.created = :created')
                ->setParameter('created', $date);
        }

        return $qb->getQuery()->getResult();
    }
	public function getExpireCodes(){
		$this->getEntityManager()->getConfiguration()->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
		$this->getEntityManager()->getConfiguration()->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
		
		$qb = $this->getEntityManager()->createQueryBuilder();
        return $count =  $qb
            ->select('COUNT(activationCode.id)')
            ->from('AppBundle:ActivationCode', 'activationCode')
            ->where('MONTH(activationCode.endDate) = MONTH(CURRENT_DATE())')
			->andWhere('YEAR(activationCode.endDate) = YEAR(CURRENT_DATE())')
			->getQuery()->getResult();
    }
}