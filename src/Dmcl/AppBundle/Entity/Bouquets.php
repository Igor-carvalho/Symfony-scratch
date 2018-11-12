<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bouquets
 *
 * @ORM\Table(name="bouquets")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\BouquetRepository")
 */
class Bouquets
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
     * @ORM\Column(name="bouquet_name", type="text", length=16777215, nullable=false)
     */
    private $bouquetName;

    /**
     * @var string
     *
     * @ORM\Column(name="bouquet_channels", type="text", length=16777215, nullable=false)
     */
    private $bouquetChannels;

    /**
     * @var string
     *
     * @ORM\Column(name="bouquet_series", type="text", length=16777215, nullable=false)
     */
    private $bouquetSeries;

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
     * Set bouquetName
     *
     * @param string $bouquetName
     *
     * @return Bouquets
     */
    public function setBouquetName($bouquetName)
    {
        $this->bouquetName = $bouquetName;

        return $this;
    }

    /**
     * Get bouquetName
     *
     * @return string
     */
    public function getBouquetName()
    {
        return $this->bouquetName;
    }

    /**
     * Set bouquetChannels
     *
     * @param string $bouquetChannels
     *
     * @return Bouquets
     */
    public function setBouquetChannels($bouquetChannels)
    {
        $this->bouquetChannels = $bouquetChannels;

        return $this;
    }

    /**
     * Get bouquetChannels
     *
     * @return string
     */
    public function getBouquetChannels()
    {
        return $this->bouquetChannels;
    }

    /**
     * Set bouquetSeries
     *
     * @param string $bouquetSeries
     *
     * @return Bouquets
     */
    public function setBouquetSeries($bouquetSeries)
    {
        $this->bouquetSeries = $bouquetSeries;

        return $this;
    }

    /**
     * Get bouquetSeries
     *
     * @return string
     */
    public function getBouquetSeries()
    {
        return $this->bouquetSeries;
    }
}
