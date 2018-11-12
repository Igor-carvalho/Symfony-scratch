<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeriesEpisodes
 *
 * @ORM\Table(name="series_episodes", indexes={@ORM\Index(name="season_num", columns={"season_num"}), @ORM\Index(name="series_id", columns={"series_id"}), @ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="sort", columns={"sort"})})
 * @ORM\Entity
 */
class SeriesEpisodes
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
     * @ORM\Column(name="stream_id", type="integer", nullable=false)
     */
    private $streamId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer", nullable=false)
     */
    private $sort;

    /**
     * @var \Series
     *
     * @ORM\ManyToOne(targetEntity="Series")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="series_id", referencedColumnName="id")
     * })
     */
    private $series;

    /**
     * @var \StreamsSeasons
     *
     * @ORM\ManyToOne(targetEntity="StreamsSeasons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="season_num", referencedColumnName="season_id")
     * })
     */
    private $seasonNum;



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
     * Set streamId
     *
     * @param integer $streamId
     *
     * @return SeriesEpisodes
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
     * Set sort
     *
     * @param integer $sort
     *
     * @return SeriesEpisodes
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set series
     *
     * @param \Dmcl\AppBundle\Entity\Series $series
     *
     * @return SeriesEpisodes
     */
    public function setSeries(\Dmcl\AppBundle\Entity\Series $series = null)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return \Dmcl\AppBundle\Entity\Series
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set seasonNum
     *
     * @param \Dmcl\AppBundle\Entity\StreamsSeasons $seasonNum
     *
     * @return SeriesEpisodes
     */
    public function setSeasonNum(\Dmcl\AppBundle\Entity\StreamsSeasons $seasonNum = null)
    {
        $this->seasonNum = $seasonNum;

        return $this;
    }

    /**
     * Get seasonNum
     *
     * @return \Dmcl\AppBundle\Entity\StreamsSeasons
     */
    public function getSeasonNum()
    {
        return $this->seasonNum;
    }
}
