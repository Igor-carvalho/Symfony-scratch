<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
/**
 * Server
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\ServerRepository")
 * @DoctrineAssert\UniqueEntity("name",message = "entity.server.name.unique")
 */
class Server
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
     * @Assert\NotBlank(message = "entity.server.name.no_blank")
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean",nullable=true)
     */
    private $enabled=true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="proxyAgent", type="boolean",nullable=true)
     */
    private $proxyAgent=false;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="ipAddress", type="string", length=255)
     */
    private $ipAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxConnections", type="integer")
     */
    private $maxConnections;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ServersZone", inversedBy="servers")
     */
    private $serverZone;

    /**
     * @var integer
     *
     * @ORM\Column(name="port", type="integer")
     */
    private $port;

    /**
     * @var integer
     *
     * @ORM\Column(name="sshPort", type="integer")
     */
    private $sshPort=22;

    /**
     * @var string
     *
     * @ORM\Column(name="sshUsername", type="string", length=255,nullable=true)
     */
    private $sshUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="sshPassword", type="string", length=255,nullable=true)
     */
    private $sshPassword;

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
     * @return Server
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
     * Set domain
     *
     * @param string $domain
     * @return Server
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string 
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return Server
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

    /**
     * Set maxConnections
     *
     * @param integer $maxConnections
     * @return Server
     */
    public function setMaxConnections($maxConnections)
    {
        $this->maxConnections = $maxConnections;

        return $this;
    }

    /**
     * Get maxConnections
     *
     * @return integer 
     */
    public function getMaxConnections()
    {
        return $this->maxConnections;
    }

    /**
     * Set sshPort
     *
     * @param integer $sshPort
     * @return Server
     */
    public function setSshPort($sshPort)
    {
        $this->sshPort = $sshPort;

        return $this;
    }

    /**
     * Get sshPort
     *
     * @return integer 
     */
    public function getSshPort()
    {
        return $this->sshPort;
    }

    /**
     * Set sshUsername
     *
     * @param string $sshUsername
     * @return Server
     */
    public function setSshUsername($sshUsername)
    {
        $this->sshUsername = $sshUsername;

        return $this;
    }

    /**
     * Get sshUsername
     *
     * @return string 
     */
    public function getSshUsername()
    {
        return $this->sshUsername;
    }

    /**
     * Set sshPassword
     *
     * @param string $sshPassword
     * @return Server
     */
    public function setSshPassword($sshPassword)
    {
        $this->sshPassword = $sshPassword;

        return $this;
    }

    /**
     * Get sshPassword
     *
     * @return string 
     */
    public function getSshPassword()
    {
        return $this->sshPassword;
    }

    /**
     * Set serverZone
     *
     * @param \Dmcl\AppBundle\Entity\ServersZone $serverZone
     * @return Server
     */
    public function setServerZone(\Dmcl\AppBundle\Entity\ServersZone $serverZone = null)
    {
        $this->serverZone = $serverZone;

        return $this;
    }

    /**
     * Get serverZone
     *
     * @return \Dmcl\AppBundle\Entity\ServersZone
     */
    public function getServerZone()
    {
        return $this->serverZone;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }




    function __toString()
    {
     return $this->name;
    }

    /**
     * @return boolean
     */
    public function isProxyAgent()
    {
        return $this->proxyAgent;
    }

    /**
     * @param boolean $proxyAgent
     */
    public function setProxyAgent($proxyAgent)
    {
        $this->proxyAgent = $proxyAgent;
    }




    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get proxyAgent
     *
     * @return boolean
     */
    public function getProxyAgent()
    {
        return $this->proxyAgent;
    }
}
