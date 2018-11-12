<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Packages
 *
 * @ORM\Table(name="packages")
 * @ORM\Entity
 */
class Packages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_trial", type="boolean", nullable=false)
     */
    private $isTrial = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="credits", type="integer", nullable=false)
     */
    private $credits = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="duration_in", type="string", length=255, nullable=false)
     * @Assert\Choice(choices = {"hours", "days" , "months"})
     */
    private $durationIn;

    /**
     * @var string
     *
     * @ORM\Column(name="bouquets", type="text", length=255, nullable=false)
     */
    private $bouquets;

    /**
     * @var boolean
     *
     * @ORM\Column(name="can_gen_mag", type="boolean", nullable=false)
     */
    private $canGenMag = false;

    /**
     * @var string
     *
     * @ORM\Column(name="output_formats", type="text", length=255, nullable=false)
     */
    private $outputFormats;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_connections", type="integer", nullable=false)
     */
    private $maxConnections = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="can_gen_e2", type="boolean", nullable=false)
     */
    private $canGenE2 = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = true;

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
     * Set name
     *
     * @param string $name
     *
     * @return Packages
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isTrial
     *
     * @param boolean $isTrial
     *
     * @return Packages
     */
    public function setIsTrial($isTrial)
    {
        $this->isTrial = $isTrial;

        return $this;
    }

    /**
     * Get isTrial
     *
     * @return boolean
     */
    public function getIsTrial()
    {
        return $this->isTrial;
    }

    /**
     * Set credits
     *
     * @param integer $credits
     *
     * @return Packages
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return integer
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Packages
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set durationIn
     *
     * @param string $durationIn
     *
     * @return Packages
     */
    public function setDurationIn($durationIn)
    {
        $this->durationIn = $durationIn;

        return $this;
    }

    /**
     * Get durationIn
     *
     * @return string
     */
    public function getDurationIn()
    {
        return $this->durationIn;
    }

    /**
     * Set bouquets
     *
     * @param string $bouquets
     *
     * @return Packages
     */
    public function setBouquets($bouquets)
    {
        $this->bouquets = $bouquets;

        return $this;
    }

    /**
     * Get bouquets
     *
     * @return string
     */
    public function getBouquets()
    {
        return $this->bouquets;
    }

    /**
     * Set canGenMag
     *
     * @param boolean $canGenMag
     *
     * @return Packages
     */
    public function setCanGenMag($canGenMag)
    {
        $this->canGenMag = $canGenMag;

        return $this;
    }

    /**
     * Get canGenMag
     *
     * @return boolean
     */
    public function getCanGenMag()
    {
        return $this->canGenMag;
    }

    /**
     * Set outputFormats
     *
     * @param string $outputFormats
     *
     * @return Packages
     */
    public function setOutputFormats($outputFormats)
    {
        $this->outputFormats = $outputFormats;

        return $this;
    }

    /**
     * Get outputFormats
     *
     * @return string
     */
    public function getOutputFormats()
    {
        return $this->outputFormats;
    }

    /**
     * Set maxConnections
     *
     * @param integer $maxConnections
     *
     * @return Packages
     */
    public function setMaxConnections($maxConnections)
    {
        $this->maxConnections = $maxConnections;

        return $this;
    }

    /**
     * Get maxConnections
     *
     * @return integer
     */
    public function getMaxConnections()
    {
        return $this->maxConnections;
    }

    /**
     * Set canGenE2
     *
     * @param boolean $canGenE2
     *
     * @return Packages
     */
    public function setCanGenE2($canGenE2)
    {
        $this->canGenE2 = $canGenE2;

        return $this;
    }

    /**
     * Get canGenE2
     *
     * @return boolean
     */
    public function getCanGenE2()
    {
        return $this->canGenE2;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Packages
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
}
