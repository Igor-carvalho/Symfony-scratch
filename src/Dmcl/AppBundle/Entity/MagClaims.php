<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MagClaims
 *
 * @ORM\Table(name="mag_claims", indexes={@ORM\Index(name="mag_id", columns={"mag_id"}), @ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="real_type", columns={"real_type"}), @ORM\Index(name="date", columns={"date"})})
 * @ORM\Entity
 */
class MagClaims
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
     * @ORM\Column(name="real_type", type="string", length=10, nullable=false)
     */
    private $realType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
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
     * @var \MagDevices
     *
     * @ORM\ManyToOne(targetEntity="MagDevices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mag_id", referencedColumnName="mag_id")
     * })
     */
    private $mag;



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
     * Set realType
     *
     * @param string $realType
     *
     * @return MagClaims
     */
    public function setRealType($realType)
    {
        $this->realType = $realType;

        return $this;
    }

    /**
     * Get realType
     *
     * @return string
     */
    public function getRealType()
    {
        return $this->realType;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return MagClaims
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
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
     * @return MagClaims
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
     * Set mag
     *
     * @param \Dmcl\AppBundle\Entity\MagDevices $mag
     *
     * @return MagClaims
     */
    public function setMag(\Dmcl\AppBundle\Entity\MagDevices $mag = null)
    {
        $this->mag = $mag;

        return $this;
    }

    /**
     * Get mag
     *
     * @return \Dmcl\AppBundle\Entity\MagDevices
     */
    public function getMag()
    {
        return $this->mag;
    }
}
