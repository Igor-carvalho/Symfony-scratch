<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enigma2Actions
 *
 * @ORM\Table(name="enigma2_actions", indexes={@ORM\Index(name="device_id", columns={"device_id"})})
 * @ORM\Entity
 */
class Enigma2Actions
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
     * @ORM\Column(name="type", type="text", length=65535, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="text", length=65535, nullable=false)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="command", type="text", length=65535, nullable=false)
     */
    private $command;

    /**
     * @var string
     *
     * @ORM\Column(name="command2", type="text", length=65535, nullable=false)
     */
    private $command2;

    /**
     * @var \Devices
     *
     * @ORM\ManyToOne(targetEntity="Devices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="device_id", referencedColumnName="device_id")
     * })
     */
    private $device;



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
     * Set type
     *
     * @param string $type
     *
     * @return Enigma2Actions
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set key
     *
     * @param string $key
     *
     * @return Enigma2Actions
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set command
     *
     * @param string $command
     *
     * @return Enigma2Actions
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set command2
     *
     * @param string $command2
     *
     * @return Enigma2Actions
     */
    public function setCommand2($command2)
    {
        $this->command2 = $command2;

        return $this;
    }

    /**
     * Get command2
     *
     * @return string
     */
    public function getCommand2()
    {
        return $this->command2;
    }

    /**
     * Set device
     *
     * @param \Dmcl\AppBundle\Entity\Devices $device
     *
     * @return Enigma2Actions
     */
    public function setDevice(\Dmcl\AppBundle\Entity\Devices $device = null)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get device
     *
     * @return \Dmcl\AppBundle\Entity\Devices
     */
    public function getDevice()
    {
        return $this->device;
    }
}
