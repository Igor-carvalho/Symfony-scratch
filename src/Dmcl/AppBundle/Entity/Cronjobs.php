<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cronjobs
 *
 * @ORM\Table(name="cronjobs", indexes={@ORM\Index(name="enabled", columns={"enabled"}), @ORM\Index(name="filename", columns={"filename"})})
 * @ORM\Entity
 */
class Cronjobs
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
     * @ORM\Column(name="description", type="text", length=16777215, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=false)
     */
    private $filename;

    /**
     * @var integer
     *
     * @ORM\Column(name="run_per_mins", type="integer", nullable=false)
     */
    private $runPerMins = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="run_per_hours", type="integer", nullable=false)
     */
    private $runPerHours = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer", nullable=false)
     */
    private $enabled = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pid", type="integer", nullable=false)
     */
    private $pid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=true)
     */
    private $timestamp;



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
     * Set description
     *
     * @param string $description
     *
     * @return Cronjobs
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
     * Set filename
     *
     * @param string $filename
     *
     * @return Cronjobs
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set runPerMins
     *
     * @param integer $runPerMins
     *
     * @return Cronjobs
     */
    public function setRunPerMins($runPerMins)
    {
        $this->runPerMins = $runPerMins;

        return $this;
    }

    /**
     * Get runPerMins
     *
     * @return integer
     */
    public function getRunPerMins()
    {
        return $this->runPerMins;
    }

    /**
     * Set runPerHours
     *
     * @param integer $runPerHours
     *
     * @return Cronjobs
     */
    public function setRunPerHours($runPerHours)
    {
        $this->runPerHours = $runPerHours;

        return $this;
    }

    /**
     * Get runPerHours
     *
     * @return integer
     */
    public function getRunPerHours()
    {
        return $this->runPerHours;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return Cronjobs
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return Cronjobs
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
     * Set timestamp
     *
     * @param integer $timestamp
     *
     * @return Cronjobs
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
