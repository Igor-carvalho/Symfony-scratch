<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enigma2Failed
 *
 * @ORM\Table(name="enigma2_failed", indexes={@ORM\Index(name="original_mac", columns={"original_mac"})})
 * @ORM\Entity
 */
class Enigma2Failed
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
     * @ORM\Column(name="original_mac", type="string", length=255, nullable=false)
     */
    private $originalMac;

    /**
     * @var string
     *
     * @ORM\Column(name="virtual_mac", type="string", length=255, nullable=false)
     */
    private $virtualMac;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;



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
     * Set originalMac
     *
     * @param string $originalMac
     *
     * @return Enigma2Failed
     */
    public function setOriginalMac($originalMac)
    {
        $this->originalMac = $originalMac;

        return $this;
    }

    /**
     * Get originalMac
     *
     * @return string
     */
    public function getOriginalMac()
    {
        return $this->originalMac;
    }

    /**
     * Set virtualMac
     *
     * @param string $virtualMac
     *
     * @return Enigma2Failed
     */
    public function setVirtualMac($virtualMac)
    {
        $this->virtualMac = $virtualMac;

        return $this;
    }

    /**
     * Get virtualMac
     *
     * @return string
     */
    public function getVirtualMac()
    {
        return $this->virtualMac;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return Enigma2Failed
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
}
