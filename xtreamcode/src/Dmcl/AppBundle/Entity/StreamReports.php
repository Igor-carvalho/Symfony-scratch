<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamReports
 *
 * @ORM\Table(name="stream_reports")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\StreamReportsRepository")
 */
class StreamReports
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
     * @ORM\Column(name="stream_name", type="text", length=100, nullable=false)
     */
    private $streamName;

    /**
     * @var integer
     *
     * @ORM\Column(name="stream_id", type="integer", nullable=true)
     */
    private $streamId;

    /**
     * @var string
     *
     * @ORM\Column(name="issues", type="text", length=255, nullable=true)
     */
    private $issues;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $user;
       
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime("now");
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
     * Set streamName
     *
     * @param string $streamName
     *
     * @return StreamReports
     */
    public function setStreamName($streamName)
    {
        $this->streamName = $streamName;

        return $this;
    }

    /**
     * Get streamName
     *
     * @return string
     */
    public function getStreamName()
    {
        return $this->streamName;
    }

    /**
     * Set streamId
     *
     * @param integer $streamId
     *
     * @return StreamReports
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
     * Set issues
     *
     * @param string $issues
     *
     * @return StreamReports
     */
    public function setIssues($issues)
    {
        $this->issues = json_encode($issues);

        return $this;
    }

    /**
     * Get issues
     *
     * @return string
     */
    public function getIssues()
    {
        return json_decode($this->issues, true);
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return StreamReports
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return StreamReports
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return StreamReports
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
