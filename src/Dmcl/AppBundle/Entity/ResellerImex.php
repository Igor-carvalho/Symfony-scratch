<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResellerImex
 *
 * @ORM\Table(name="reseller_imex", indexes={@ORM\Index(name="reg_id", columns={"reg_id"})})
 * @ORM\Entity
 */
class ResellerImex
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
     * @ORM\Column(name="reg_id", type="integer", nullable=false)
     */
    private $regId;

    /**
     * @var string
     *
     * @ORM\Column(name="header", type="text", nullable=false)
     */
    private $header;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=false)
     */
    private $data;

    /**
     * @var boolean
     *
     * @ORM\Column(name="accepted", type="boolean", nullable=false)
     */
    private $accepted = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="finished", type="boolean", nullable=false)
     */
    private $finished = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="bouquet_ids", type="text", length=65535, nullable=false)
     */
    private $bouquetIds;



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
     * Set regId
     *
     * @param integer $regId
     *
     * @return ResellerImex
     */
    public function setRegId($regId)
    {
        $this->regId = $regId;

        return $this;
    }

    /**
     * Get regId
     *
     * @return integer
     */
    public function getRegId()
    {
        return $this->regId;
    }

    /**
     * Set header
     *
     * @param string $header
     *
     * @return ResellerImex
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return ResellerImex
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

    /**
     * Set accepted
     *
     * @param boolean $accepted
     *
     * @return ResellerImex
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * Get accepted
     *
     * @return boolean
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set finished
     *
     * @param boolean $finished
     *
     * @return ResellerImex
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return boolean
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set bouquetIds
     *
     * @param string $bouquetIds
     *
     * @return ResellerImex
     */
    public function setBouquetIds($bouquetIds)
    {
        $this->bouquetIds = $bouquetIds;

        return $this;
    }

    /**
     * Get bouquetIds
     *
     * @return string
     */
    public function getBouquetIds()
    {
        return $this->bouquetIds;
    }
}
