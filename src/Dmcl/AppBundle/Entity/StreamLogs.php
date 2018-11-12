<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamLogs
 *
 * @ORM\Table(name="stream_logs", indexes={@ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="server_id", columns={"server_id"})})
 * @ORM\Entity
 */
class StreamLogs
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
     * @ORM\Column(name="server_id", type="integer", nullable=false)
     */
    private $serverId;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="error", type="string", length=500, nullable=false)
     */
    private $error;

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
     * Set serverId
     *
     * @param integer $serverId
     *
     * @return StreamLogs
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
     * Set date
     *
     * @param integer $date
     *
     * @return StreamLogs
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
     * Set error
     *
     * @param string $error
     *
     * @return StreamLogs
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set stream
     *
     * @param \Dmcl\AppBundle\Entity\Streams $stream
     *
     * @return StreamLogs
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
