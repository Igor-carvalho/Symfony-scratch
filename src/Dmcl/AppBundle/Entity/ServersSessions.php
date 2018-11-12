<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServersSessions
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\ServersSessionsRepository")
 */
class ServersSessions
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
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="serverType", type="string", length=255,nullable=true)
     */
    private $serverType = "Channel";

    /**
     * @var string
     *
     * @ORM\Column(name="serverId", type="string", length=255,nullable=true)
     */
    private $serverId="0";

    /**
     * @var string
     *
     * @ORM\Column(name="playerId", type="string", length=255)
     */
    private $playerId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="playStartAt", type="datetime")
     */
    private $playStartAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finishedAt", type="datetime",nullable=true)
     */
    private $finishedAt;


    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean",nullable=true)
     */
    private $active=true;



    function __construct()
    {
        $this->playStartAt = new \DateTime("now");
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
     * Set serverType
     *
     * @param string $serverType
     * @return ServersSessions
     */
    public function setServerType($serverType)
    {
        $this->serverType = $serverType;

        return $this;
    }

    /**
     * Get serverType
     *
     * @return string 
     */
    public function getServerType()
    {
        return $this->serverType;
    }

    /**
     * Set serverId
     *
     * @param string $serverId
     * @return ServersSessions
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;

        return $this;
    }

    /**
     * Get serverId
     *
     * @return string 
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * Set playerId
     *
     * @param string $playerId
     * @return ServersSessions
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return string 
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Set playStartAt
     *
     * @param \DateTime $playStartAt
     * @return ServersSessions
     */
    public function setPlayStartAt($playStartAt)
    {
        $this->playStartAt = $playStartAt;

        return $this;
    }

    /**
     * Get playStartAt
     *
     * @return \DateTime 
     */
    public function getPlayStartAt()
    {
        return $this->playStartAt;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return \DateTime
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * @param \DateTime $finishedAt
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return ServersSessions
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get  token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
}
