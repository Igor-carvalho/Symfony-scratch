<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signals
 *
 * @ORM\Table(name="signals", indexes={@ORM\Index(name="server_id", columns={"server_id"}), @ORM\Index(name="time", columns={"time"})})
 * @ORM\Entity
 */
class Signals
{
    /**
     * @var integer
     *
     * @ORM\Column(name="signal_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $signalId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=false)
     */
    private $pid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rtmp", type="boolean", nullable=false)
     */
    private $rtmp = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    private $time;

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
     * Get signalId
     *
     * @return integer
     */
    public function getSignalId()
    {
        return $this->signalId;
    }

    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return Signals
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set rtmp
     *
     * @param boolean $rtmp
     *
     * @return Signals
     */
    public function setRtmp($rtmp)
    {
        $this->rtmp = $rtmp;

        return $this;
    }

    /**
     * Get rtmp
     *
     * @return boolean
     */
    public function getRtmp()
    {
        return $this->rtmp;
    }

    /**
     * Set time
     *
     * @param integer $time
     *
     * @return Signals
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set server
     *
     * @param \Dmcl\AppBundle\Entity\StreamingServers $server
     *
     * @return Signals
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
