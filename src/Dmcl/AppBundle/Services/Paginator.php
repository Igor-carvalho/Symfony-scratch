<?php

namespace Dmcl\AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Dmcl\AppBundle\Entity\License;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Description of Paginator
 *
 * @author dmanuelcl@gmail.com
 */
class Paginator
{
    private $container;
    private $user;
    private $totalPages;
    private $page;
    private $rpp;
    private $pageCount;

    function __construct(ContainerInterface $container, TokenStorage $tokenStorage)
    {
        $this->container = $container;
        
        $token = $tokenStorage->getToken();
        $this->user = $token->getUser();
    }

    public function setConfig($page, $totalcount, $rpp)
    {
        $this->rpp = $rpp;
        $this->page = $page;
        $this->totalPages = $this->setTotalPages($totalcount, $rpp);
        $this->pageCount = $this->container->getParameter('app.paginator.pgcount');
    }

    /*
     * var recCount: the total count of records
     * var $rpp: the record per page
     */

    private function setTotalPages($totalcount, $rpp)
    {
        if ($rpp == 0)
        {
            $rpp = 20; // In case we did not provide a number for $rpp
        }

        $this->totalPages = ceil($totalcount / $rpp);
        return $this->totalPages;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getPagesList()
    {
        if ($this->totalPages <= $this->pageCount){ //Less than total 5 pages
            $list = array();

            for($i = 1; $i <= $this->totalPages; $i++)
               $list[] = $i;
            
            return $list;
        } 

        if($this->page <= 3)
            return array(1, 2, 3, 4, 5);

        $i = $this->pageCount;
        $r = array();
        $half = floor($this->pageCount / 2);

        if ($this->page + $half > $this->totalPages) // Close to end
        {
            while ($i >= 1)
            {
                $r[] = $this->totalPages - $i + 1;
                $i--;
            }
            return $r;
        }
        else{
                while ($i >= 1)
                {
                    $r[] = $this->page - $i + $half + 1;
                    $i--;
                }
                
                return $r;
            }
    }
}