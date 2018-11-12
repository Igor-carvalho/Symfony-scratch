<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamsSys
 *
 * @ORM\Table(name="streams_sys", uniqueConstraints={@ORM\UniqueConstraint(name="stream_id_2", columns={"stream_id", "server_id"})}, indexes={@ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="pid", columns={"pid"}), @ORM\Index(name="server_id", columns={"server_id"}), @ORM\Index(name="stream_status", columns={"stream_status"}), @ORM\Index(name="stream_started", columns={"stream_started"}), @ORM\Index(name="parent_id", columns={"parent_id"}), @ORM\Index(name="to_analyze", columns={"to_analyze"})})
 * @ORM\Entity
 */
class StreamsSys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="server_stream_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $serverStreamId;

    /**
     * @var integer
     *
     * @ORM\Column(name="stream_id", type="integer", nullable=false)
     */
    private $streamId;

    /**
     * @var integer
     *
     * @ORM\Column(name="server_id", type="integer", nullable=false)
     */
    private $serverId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=true)
     */
    private $pid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="to_analyze", type="boolean", nullable=false)
     */
    private $toAnalyze = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="stream_status", type="integer", nullable=false)
     */
    private $streamStatus = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="stream_started", type="integer", nullable=true)
     */
    private $streamStarted;

    /**
     * @var string
     *
     * @ORM\Column(name="stream_info", type="text", length=16777215, nullable=false)
     */
    private $streamInfo;

    /**
     * @var integer
     *
     * @ORM\Column(name="monitor_pid", type="integer", nullable=true)
     */
    private $monitorPid;

    /**
     * @var string
     *
     * @ORM\Column(name="current_source", type="text", length=16777215, nullable=true)
     */
    private $currentSource;

    /**
     * @var integer
     *
     * @ORM\Column(name="bitrate", type="integer", nullable=true)
     */
    private $bitrate;

    /**
     * @var string
     *
     * @ORM\Column(name="progress_info", type="text", length=65535, nullable=false)
     */
    private $progressInfo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="on_demand", type="boolean", nullable=false)
     */
    private $onDemand = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="delay_pid", type="integer", nullable=true)
     */
    private $delayPid;

    /**
     * @var integer
     *
     * @ORM\Column(name="delay_available_at", type="integer", nullable=true)
     */
    private $delayAvailableAt;



    /**
     * Get serverStreamId
     *
     * @return integer
     */
    public function getServerStreamId()
    {
        return $this->serverStreamId;
    }

    /**
     * Set streamId
     *
     * @param integer $streamId
     *
     * @return StreamsSys
     */
    public function setStreamId($streamId)
    {
        $this->streamId = $streamId;

        return $this;
    }

    /**
     * Get streamId
     *
     * @return integer
     */
    public function getStreamId()
    {
        return $this->streamId;
    }

    /**
     * Set serverId
     *
     * @param integer $serverId
     *
     * @return StreamsSys
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;

        return $this;
    }

    /**
     * Get serverId
     *
     * @return integer
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return StreamsSys
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return StreamsSys
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
     * Set toAnalyze
     *
     * @param boolean $toAnalyze
     *
     * @return StreamsSys
     */
    public function setToAnalyze($toAnalyze)
    {
        $this->toAnalyze = $toAnalyze;

        return $this;
    }

    /**
     * Get toAnalyze
     *
     * @return boolean
     */
    public function getToAnalyze()
    {
        return $this->toAnalyze;
    }

    /**
     * Set streamStatus
     *
     * @param integer $streamStatus
     *
     * @return StreamsSys
     */
    public function setStreamStatus($streamStatus)
    {
        $this->streamStatus = $streamStatus;

        return $this;
    }

    /**
     * Get streamStatus
     *
     * @return integer
     */
    public function getStreamStatus()
    {
        return $this->streamStatus;
    }

    /**
     * Set streamStarted
     *
     * @param integer $streamStarted
     *
     * @return StreamsSys
     */
    public function setStreamStarted($streamStarted)
    {
        $this->streamStarted = $streamStarted;

        return $this;
    }

    /**
     * Get streamStarted
     *
     * @return integer
     */
    public function getStreamStarted()
    {
        return $this->streamStarted;
    }

    /**
     * Set streamInfo
     *
     * @param string $streamInfo
     *
     * @return StreamsSys
     */
    public function setStreamInfo($streamInfo)
    {
        $this->streamInfo = $streamInfo;

        return $this;
    }

    /**
     * Get streamInfo
     *
     * @return string
     */
    public function getStreamInfo()
    {
        return $this->streamInfo;
    }

    /**
     * Set monitorPid
     *
     * @param integer $monitorPid
     *
     * @return StreamsSys
     */
    public function setMonitorPid($monitorPid)
    {
        $this->monitorPid = $monitorPid;

        return $this;
    }

    /**
     * Get monitorPid
     *
     * @return integer
     */
    public function getMonitorPid()
    {
        return $this->monitorPid;
    }

    /**
     * Set currentSource
     *
     * @param string $currentSource
     *
     * @return StreamsSys
     */
    public function setCurrentSource($currentSource)
    {
        $this->currentSource = $currentSource;

        return $this;
    }

    /**
     * Get currentSource
     *
     * @return string
     */
    public function getCurrentSource()
    {
        return $this->currentSource;
    }

    /**
     * Set bitrate
     *
     * @param integer $bitrate
     *
     * @return StreamsSys
     */
    public function setBitrate($bitrate)
    {
        $this->bitrate = $bitrate;

        return $this;
    }

    /**
     * Get bitrate
     *
     * @return integer
     */
    public function getBitrate()
    {
        return $this->bitrate;
    }

    /**
     * Set progressInfo
     *
     * @param string $progressInfo
     *
     * @return StreamsSys
     */
    public function setProgressInfo($progressInfo)
    {
        $this->progressInfo = $progressInfo;

        return $this;
    }

    /**
     * Get progressInfo
     *
     * @return string
     */
    public function getProgressInfo()
    {
        return $this->progressInfo;
    }

    /**
     * Set onDemand
     *
     * @param boolean $onDemand
     *
     * @return StreamsSys
     */
    public function setOnDemand($onDemand)
    {
        $this->onDemand = $onDemand;

        return $this;
    }

    /**
     * Get onDemand
     *
     * @return boolean
     */
    public function getOnDemand()
    {
        return $this->onDemand;
    }

    /**
     * Set delayPid
     *
     * @param integer $delayPid
     *
     * @return StreamsSys
     */
    public function setDelayPid($delayPid)
    {
        $this->delayPid = $delayPid;

        return $this;
    }

    /**
     * Get delayPid
     *
     * @return integer
     */
    public function getDelayPid()
    {
        return $this->delayPid;
    }

    /**
     * Set delayAvailableAt
     *
     * @param integer $delayAvailableAt
     *
     * @return StreamsSys
     */
    public function setDelayAvailableAt($delayAvailableAt)
    {
        $this->delayAvailableAt = $delayAvailableAt;

        return $this;
    }

    /**
     * Get delayAvailableAt
     *
     * @return integer
     */
    public function getDelayAvailableAt()
    {
        return $this->delayAvailableAt;
    }
}
