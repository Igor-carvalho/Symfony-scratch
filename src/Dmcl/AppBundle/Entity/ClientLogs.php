<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientLogs
 *
 * @ORM\Table(name="client_logs", indexes={@ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class ClientLogs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="client_status", type="string", length=255, nullable=false)
     */
    private $clientStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="query_string", type="text", length=16777215, nullable=false)
     */
    private $queryString;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255, nullable=false)
     */
    private $userAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="extra_data", type="text", length=16777215, nullable=false)
     */
    private $extraData;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

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
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set clientStatus
     *
     * @param string $clientStatus
     *
     * @return ClientLogs
     */
    public function setClientStatus($clientStatus)
    {
        $this->clientStatus = $clientStatus;

        return $this;
    }

    /**
     * Get clientStatus
     *
     * @return string
     */
    public function getClientStatus()
    {
        return $this->clientStatus;
    }

    /**
     * Set queryString
     *
     * @param string $queryString
     *
     * @return ClientLogs
     */
    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;

        return $this;
    }

    /**
     * Get queryString
     *
     * @return string
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return ClientLogs
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
     * Set ip
     *
     * @param string $ip
     *
     * @return ClientLogs
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set extraData
     *
     * @param string $extraData
     *
     * @return ClientLogs
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }

    /**
     * Get extraData
     *
     * @return string
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return ClientLogs
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set stream
     *
     * @param \Dmcl\AppBundle\Entity\Streams $stream
     *
     * @return ClientLogs
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
     * Set user
     *
     * @param \Dmcl\AppBundle\Entity\Users $user
     *
     * @return ClientLogs
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
}
