<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MagLogs
 *
 * @ORM\Table(name="mag_logs", indexes={@ORM\Index(name="mag_id", columns={"mag_id"})})
 * @ORM\Entity
 */
class MagLogs
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
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

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
     * Set action
     *
     * @param string $action
     *
     * @return MagLogs
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set mag
     *
     * @param \Dmcl\AppBundle\Entity\MagDevices $mag
     *
     * @return MagLogs
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
