<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserActivity
 *
 * @ORM\Table(name="user_activity", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="server_id", columns={"server_id"}), @ORM\Index(name="container", columns={"container"}), @ORM\Index(name="date_end", columns={"date_end"}), @ORM\Index(name="geoip_country_code", columns={"geoip_country_code"}), @ORM\Index(name="user_agent", columns={"user_agent"}), @ORM\Index(name="user_agent_2", columns={"user_agent"}), @ORM\Index(name="user_ip", columns={"user_ip"}), @ORM\Index(name="date_start", columns={"date_start"}), @ORM\Index(name="isp", columns={"isp"})})
 * @ORM\Entity
 */
class UserActivity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="activity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $activityId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255, nullable=true)
     */
    private $userAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="user_ip", type="string", length=39, nullable=false)
     */
    private $userIp;

    /**
     * @var string
     *
     * @ORM\Column(name="container", type="string", length=50, nullable=false)
     */
    private $container;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_start", type="integer", nullable=false)
     */
    private $dateStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_end", type="integer", nullable=true)
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="geoip_country_code", type="string", length=22, nullable=false)
     */
    private $geoipCountryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="isp", type="string", length=255, nullable=false)
     */
    private $isp;

    /**
     * @var string
     *
     * @ORM\Column(name="external_device", type="string", length=255, nullable=false)
     */
    private $externalDevice;

    /**
     * @var integer
     *
     * @ORM\Column(name="divergence", type="integer", nullable=true)
     */
    private $divergence;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Streams
     *
     * @ORM\ManyToOne(targetEntity="Streams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stream_id", referencedColumnName="id")
     * })
     */
    private $stream;

    /**
     * @var \StreamingServers
     *
     * @ORM\ManyToOne(targetEntity="StreamingServers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="server_id", referencedColumnName="id")
     * })
     */
    private $server;



    /**
     * Get activityId
     *
     * @return integer
     */
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return UserActivity
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set userIp
     *
     * @param string $userIp
     *
     * @return UserActivity
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * Get userIp
     *
     * @return string
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Set container
     *
     * @param string $container
     *
     * @return UserActivity
     */
    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get container
     *
     * @return string
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set dateStart
     *
     * @param integer $dateStart
     *
     * @return UserActivity
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return integer
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param integer $dateEnd
     *
     * @return UserActivity
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return integer
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set geoipCountryCode
     *
     * @param string $geoipCountryCode
     *
     * @return UserActivity
     */
    public function setGeoipCountryCode($geoipCountryCode)
    {
        $this->geoipCountryCode = $geoipCountryCode;

        return $this;
    }

    /**
     * Get geoipCountryCode
     *
     * @return string
     */
    public function getGeoipCountryCode()
    {
        return $this->geoipCountryCode;
    }

    /**
     * Set isp
     *
     * @param string $isp
     *
     * @return UserActivity
     */
    public function setIsp($isp)
    {
        $this->isp = $isp;

        return $this;
    }

    /**
     * Get isp
     *
     * @return string
     */
    public function getIsp()
    {
        return $this->isp;
    }

    /**
     * Set externalDevice
     *
     * @param string $externalDevice
     *
     * @return UserActivity
     */
    public function setExternalDevice($externalDevice)
    {
        $this->externalDevice = $externalDevice;

        return $this;
    }

    /**
     * Get externalDevice
     *
     * @return string
     */
    public function getExternalDevice()
    {
        return $this->externalDevice;
    }

    /**
     * Set divergence
     *
     * @param integer $divergence
     *
     * @return UserActivity
     */
    public function setDivergence($divergence)
    {
        $this->divergence = $divergence;

        return $this;
    }

    /**
     * Get divergence
     *
     * @return integer
     */
    public function getDivergence()
    {
        return $this->divergence;
    }

    /**
     * Set user
     *
     * @param \Dmcl\AppBundle\Entity\Users $user
     *
     * @return UserActivity
     */
    public function setUser(\Dmcl\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dmcl\AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set stream
     *
     * @param \Dmcl\AppBundle\Entity\Streams $stream
     *
     * @return UserActivity
     */
    public function setStream(\Dmcl\AppBundle\Entity\Streams $stream = null)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get stream
     *
     * @return \Dmcl\AppBundle\Entity\Streams
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set server
     *
     * @param \Dmcl\AppBundle\Entity\StreamingServers $server
     *
     * @return UserActivity
     */
    public function setServer(\Dmcl\AppBundle\Entity\StreamingServers $server = null)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return \Dmcl\AppBundle\Entity\StreamingServers
     */
    public function getServer()
    {
        return $this->server;
    }
}
