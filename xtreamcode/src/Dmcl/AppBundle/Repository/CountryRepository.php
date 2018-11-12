<?php
/**
 * Created by PhpStorm.
 * User: lazaro.garcia
 * Date: 4/20/2016
 * Time: 2:34 PM
 */

namespace Dmcl\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CountryRepository extends EntityRepository
{
    /**
     * This function is used for listing all countries in array format
     */
    public function listCountriesAsArray()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('country')
            ->from('AppBundle:Country', 'country')
            ->orderBy('country.name', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

}