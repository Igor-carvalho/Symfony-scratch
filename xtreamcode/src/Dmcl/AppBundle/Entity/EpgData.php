<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EpgData
 *
 * @ORM\Table(name="epg_data", indexes={@ORM\Index(name="epg_id", columns={"epg_id"}), @ORM\Index(name="lang", columns={"lang"}), @ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="start", columns={"start"}), @ORM\Index(name="end", columns={"end"})})
 * @ORM\Entity
 */
class EpgData
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=10, nullable=false)
     */
    private $lang;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime", nullable=false)
     */
    private $start = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime", nullable=false)
     */
    private $end = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_id", type="string", length=50, nullable=false)
     */
    private $channelId;

    /**
     * @var \Epg
     *
     * @ORM\ManyToOne(targetEntity="Epg")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="epg_id", referencedColumnName="id")
     * })
     */
    private $epg;



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
     * Set title
     *
     * @param string $title
     *
     * @return EpgData
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return EpgData
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return EpgData
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return EpgData
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return EpgData
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set channelId
     *
     * @param string $channelId
     *
     * @return EpgData
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Get channelId
     *
     * @return string
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set epg
     *
     * @param \Dmcl\AppBundle\Entity\Epg $epg
     *
     * @return EpgData
     */
    public function setEpg(\Dmcl\AppBundle\Entity\Epg $epg = null)
    {
        $this->epg = $epg;

        return $this;
    }

    /**
     * Get epg
     *
     * @return \Dmcl\AppBundle\Entity\Epg
     */
    public function getEpg()
    {
        return $this->epg;
    }
}
