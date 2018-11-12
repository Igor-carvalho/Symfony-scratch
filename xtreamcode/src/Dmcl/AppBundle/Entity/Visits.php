<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visits
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\VisitsRepository")
 */
class Visits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="page", type="string", length=255)
     */
    private $page;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visitedAt", type="datetime")
     */
    private $visitedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="ipAddress", type="string", length=255)
     */
    private $ipAddress;


    public function __construct()
    {

    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set page
     *
     * @param string $page
     * @return Visits
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set visitedAt
     *
     * @param \DateTime $visitedAt
     * @return Visits
     */
    public function setVisitedAt($visitedAt)
    {
        $this->visitedAt = $visitedAt;

        return $this;
    }

    /**
     * Get visitedAt
     *
     * @return \DateTime 
     */
    public function getVisitedAt()
    {
        return $this->visitedAt;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return Visits
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }
}
