<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epg
 *
 * @ORM\Table(name="epg")
 * @ORM\Entity
 */
class Epg
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
     * @ORM\Column(name="epg_name", type="string", length=255, nullable=false)
     */
    private $epgName;

    /**
     * @var string
     *
     * @ORM\Column(name="epg_file", type="string", length=300, nullable=false)
     */
    private $epgFile;

    /**
     * @var string
     *
     * @ORM\Column(name="integrity", type="string", length=255, nullable=true)
     */
    private $integrity;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_updated", type="integer", nullable=true)
     */
    private $lastUpdated;

    /**
     * @var integer
     *
     * @ORM\Column(name="days_keep", type="integer", nullable=false)
     */
    private $daysKeep = '7';

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=false)
     */
    private $data;



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
     * Set epgName
     *
     * @param string $epgName
     *
     * @return Epg
     */
    public function setEpgName($epgName)
    {
        $this->epgName = $epgName;

        return $this;
    }

    /**
     * Get epgName
     *
     * @return string
     */
    public function getEpgName()
    {
        return $this->epgName;
    }

    /**
     * Set epgFile
     *
     * @param string $epgFile
     *
     * @return Epg
     */
    public function setEpgFile($epgFile)
    {
        $this->epgFile = $epgFile;

        return $this;
    }

    /**
     * Get epgFile
     *
     * @return string
     */
    public function getEpgFile()
    {
        return $this->epgFile;
    }

    /**
     * Set integrity
     *
     * @param string $integrity
     *
     * @return Epg
     */
    public function setIntegrity($integrity)
    {
        $this->integrity = $integrity;

        return $this;
    }

    /**
     * Get integrity
     *
     * @return string
     */
    public function getIntegrity()
    {
        return $this->integrity;
    }

    /**
     * Set lastUpdated
     *
     * @param integer $lastUpdated
     *
     * @return Epg
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return integer
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * Set daysKeep
     *
     * @param integer $daysKeep
     *
     * @return Epg
     */
    public function setDaysKeep($daysKeep)
    {
        $this->daysKeep = $daysKeep;

        return $this;
    }

    /**
     * Get daysKeep
     *
     * @return integer
     */
    public function getDaysKeep()
    {
        return $this->daysKeep;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Epg
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
