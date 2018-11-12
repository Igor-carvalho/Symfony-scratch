<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
/**
 * ServersZone
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\ServersZoneRepository")
 * @DoctrineAssert\UniqueEntity("name",message = "entity.server_zone.name.unique")
 */
class ServersZone
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message = "entity.server_zone.name.no_blank")
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="countries", type="array")
     */
    private $countries;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hasDefault", type="boolean",nullable=true)
     */
    private $hasDefault;

    /**
     *
     * @ORM\OneToMany(targetEntity="Server", mappedBy="serverZone")
     */
    private $servers;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->servers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return ServersZone
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set countries
     *
     * @param array $countries
     * @return ServersZone
     */
    public function setCountries($countries)
    {
        $this->countries = $countries;

        return $this;
    }

    /**
     * Get countries
     *
     * @return array 
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * Set hasDefault
     *
     * @param boolean $hasDefault
     * @return ServersZone
     */
    public function setHasDefault($hasDefault)
    {
        $this->hasDefault = $hasDefault;

        return $this;
    }

    /**
     * Get hasDefault
     *
     * @return boolean 
     */
    public function getHasDefault()
    {
        return $this->hasDefault;
    }

    /**
     * Add servers
     *
     * @param \Dmcl\AppBundle\Entity\Server $servers
     * @return ServersZone
     */
    public function addServer(\Dmcl\AppBundle\Entity\Server $servers)
    {
        $this->servers[] = $servers;

        return $this;
    }

    /**
     * Remove servers
     *
     * @param \Dmcl\AppBundle\Entity\Server $servers
     */
    public function removeServer(\Dmcl\AppBundle\Entity\Server $servers)
    {
        $this->servers->removeElement($servers);
    }

    /**
     * Get servers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServers()
    {
        return $this->servers;
    }

    function __toString()
    {
        return $this->name;
    }


}
