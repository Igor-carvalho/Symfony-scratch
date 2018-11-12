<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * XtreamMain
 *
 * @ORM\Table(name="xtream_main")
 * @ORM\Entity
 */
class XtreamMain
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
     * @ORM\Column(name="update_available", type="integer", nullable=false)
     */
    private $updateAvailable = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="root_ip", type="text", length=16777215, nullable=false)
     */
    private $rootIp;



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
     * Set updateAvailable
     *
     * @param integer $updateAvailable
     *
     * @return XtreamMain
     */
    public function setUpdateAvailable($updateAvailable)
    {
        $this->updateAvailable = $updateAvailable;

        return $this;
    }

    /**
     * Get updateAvailable
     *
     * @return integer
     */
    public function getUpdateAvailable()
    {
        return $this->updateAvailable;
    }

    /**
     * Set rootIp
     *
     * @param string $rootIp
     *
     * @return XtreamMain
     */
    public function setRootIp($rootIp)
    {
        $this->rootIp = $rootIp;

        return $this;
    }

    /**
     * Get rootIp
     *
     * @return string
     */
    public function getRootIp()
    {
        return $this->rootIp;
    }
}
