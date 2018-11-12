<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamsSeasons
 *
 * @ORM\Table(name="streams_seasons", indexes={@ORM\Index(name="stream_id", columns={"stream_id"})})
 * @ORM\Entity
 */
class StreamsSeasons
{
    /**
     * @var integer
     *
     * @ORM\Column(name="season_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $seasonId;

    /**
     * @var string
     *
     * @ORM\Column(name="season_name", type="string", length=255, nullable=false)
     */
    private $seasonName;

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
     * Get seasonId
     *
     * @return integer
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * Set seasonName
     *
     * @param string $seasonName
     *
     * @return StreamsSeasons
     */
    public function setSeasonName($seasonName)
    {
        $this->seasonName = $seasonName;

        return $this;
    }

    /**
     * Get seasonName
     *
     * @return string
     */
    public function getSeasonName()
    {
        return $this->seasonName;
    }

    /**
     * Set stream
     *
     * @param \Dmcl\AppBundle\Entity\Streams $stream
     *
     * @return StreamsSeasons
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
