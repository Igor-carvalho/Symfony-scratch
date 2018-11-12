<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IspAddon
 *
 * @ORM\Table(name="isp_addon")
 * @ORM\Entity
 */
class IspAddon
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
     * @ORM\Column(name="isp", type="text", length=65535, nullable=false)
     */
    private $isp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blocked", type="boolean", nullable=false)
     */
    private $blocked = '0';



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
     * Set isp
     *
     * @param string $isp
     *
     * @return IspAddon
     */
    public function setIsp($isp)
    {
        $this->isp = $isp;

        return $this;
    }

    /**
     * Get isp
     *
     * @return string
     */
    public function getIsp()
    {
        return $this->isp;
    }

    /**
     * Set blocked
     *
     * @param boolean $blocked
     *
     * @return IspAddon
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get blocked
     *
     * @return boolean
     */
    public function getBlocked()
    {
        return $this->blocked;
    }
}
