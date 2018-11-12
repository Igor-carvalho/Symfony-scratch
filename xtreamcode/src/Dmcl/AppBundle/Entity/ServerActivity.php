<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServerActivity
 *
 * @ORM\Table(name="server_activity", indexes={@ORM\Index(name="source_server_id", columns={"source_server_id"}), @ORM\Index(name="dest_server_id", columns={"dest_server_id"}), @ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="pid", columns={"pid"}), @ORM\Index(name="date_end", columns={"date_end"})})
 * @ORM\Entity
 */
class ServerActivity
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
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=true)
     */
    private $pid;

    /**
     * @var integer
     *
     * @ORM\Column(name="bandwidth", type="integer", nullable=false)
     */
    private $bandwidth = '0';

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
     * @var \StreamingServers
     *
     * @ORM\ManyToOne(targetEntity="StreamingServers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="source_server_id", referencedColumnName="id")
     * })
     */
    private $sourceServer;

    /**
     * @var \StreamingServers
     *
     * @ORM\ManyToOne(targetEntity="StreamingServers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dest_server_id", referencedColumnName="id")
     * })
     */
    private $destServer;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return ServerActivity
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
     * Set bandwidth
     *
     * @param integer $bandwidth
     *
     * @return ServerActivity
     */
    public function setBandwidth($bandwidth)
    {
        $this->bandwidth = $bandwidth;

        return $this;
    }

    /**
     * Get bandwidth
     *
     * @return integer
     */
    public function getBandwidth()
    {
        return $this->bandwidth;
    }

    /**
     * Set dateStart
     *
     * @param integer $dateStart
     *
     * @return ServerActivity
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
     * @return ServerActivity
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
     * Set sourceServer
     *
     * @param \Dmcl\AppBundle\Entity\StreamingServers $sourceServer
     *
     * @return ServerActivity
     */
    public function setSourceServer(\Dmcl\AppBundle\Entity\StreamingServers $sourceServer = null)
    {
        $this->sourceServer = $sourceServer;

        return $this;
    }

    /**
     * Get sourceServer
     *
     * @return \Dmcl\AppBundle\Entity\StreamingServers
     */
    public function getSourceServer()
    {
        return $this->sourceServer;
    }

    /**
     * Set destServer
     *
     * @param \Dmcl\AppBundle\Entity\StreamingServers $destServer
     *
     * @return ServerActivity
     */
    public function setDestServer(\Dmcl\AppBundle\Entity\StreamingServers $destServer = null)
    {
        $this->destServer = $destServer;

        return $this;
    }

    /**
     * Get destServer
     *
     * @return \Dmcl\AppBundle\Entity\StreamingServers
     */
    public function getDestServer()
    {
        return $this->destServer;
    }

    /**
     * Set stream
     *
     * @param \Dmcl\AppBundle\Entity\Streams $stream
     *
     * @return ServerActivity
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
}
