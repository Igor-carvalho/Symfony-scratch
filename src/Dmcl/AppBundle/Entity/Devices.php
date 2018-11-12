<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devices
 *
 * @ORM\Table(name="devices", indexes={@ORM\Index(name="device_key", columns={"device_key"}), @ORM\Index(name="default_output", columns={"default_output"})})
 * @ORM\Entity
 */
class Devices
{
    /**
     * @var integer
     *
     * @ORM\Column(name="device_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $deviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="device_name", type="string", length=255, nullable=false)
     */
    private $deviceName;

    /**
     * @var string
     *
     * @ORM\Column(name="device_key", type="string", length=255, nullable=false)
     */
    private $deviceKey;

    /**
     * @var string
     *
     * @ORM\Column(name="device_filename", type="string", length=255, nullable=false)
     */
    private $deviceFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="device_header", type="text", length=16777215, nullable=false)
     */
    private $deviceHeader;

    /**
     * @var string
     *
     * @ORM\Column(name="device_conf", type="text", length=16777215, nullable=false)
     */
    private $deviceConf;

    /**
     * @var string
     *
     * @ORM\Column(name="device_footer", type="text", length=16777215, nullable=false)
     */
    private $deviceFooter;

    /**
     * @var string
     *
     * @ORM\Column(name="copy_text", type="text", length=16777215, nullable=true)
     */
    private $copyText;

    /**
     * @var \AccessOutput
     *
     * @ORM\ManyToOne(targetEntity="AccessOutput")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="default_output", referencedColumnName="access_output_id")
     * })
     */
    private $defaultOutput;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Users", mappedBy="devices")
     */
    private $user;

    /**
     * Get deviceId
     *
     * @return integer
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * Set deviceName
     *
     * @param string $deviceName
     *
     * @return Devices
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;

        return $this;
    }

    /**
     * Get deviceName
     *
     * @return string
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * Set deviceKey
     *
     * @param string $deviceKey
     *
     * @return Devices
     */
    public function setDeviceKey($deviceKey)
    {
        $this->deviceKey = $deviceKey;

        return $this;
    }

    /**
     * Get deviceKey
     *
     * @return string
     */
    public function getDeviceKey()
    {
        return $this->deviceKey;
    }

    /**
     * Set deviceFilename
     *
     * @param string $deviceFilename
     *
     * @return Devices
     */
    public function setDeviceFilename($deviceFilename)
    {
        $this->deviceFilename = $deviceFilename;

        return $this;
    }

    /**
     * Get deviceFilename
     *
     * @return string
     */
    public function getDeviceFilename()
    {
        return $this->deviceFilename;
    }

    /**
     * Set deviceHeader
     *
     * @param string $deviceHeader
     *
     * @return Devices
     */
    public function setDeviceHeader($deviceHeader)
    {
        $this->deviceHeader = $deviceHeader;

        return $this;
    }

    /**
     * Get deviceHeader
     *
     * @return string
     */
    public function getDeviceHeader()
    {
        return $this->deviceHeader;
    }

    /**
     * Set deviceConf
     *
     * @param string $deviceConf
     *
     * @return Devices
     */
    public function setDeviceConf($deviceConf)
    {
        $this->deviceConf = $deviceConf;

        return $this;
    }

    /**
     * Get deviceConf
     *
     * @return string
     */
    public function getDeviceConf()
    {
        return $this->deviceConf;
    }

    /**
     * Set deviceFooter
     *
     * @param string $deviceFooter
     *
     * @return Devices
     */
    public function setDeviceFooter($deviceFooter)
    {
        $this->deviceFooter = $deviceFooter;

        return $this;
    }

    /**
     * Get deviceFooter
     *
     * @return string
     */
    public function getDeviceFooter()
    {
        return $this->deviceFooter;
    }

    /**
     * Set copyText
     *
     * @param string $copyText
     *
     * @return Devices
     */
    public function setCopyText($copyText)
    {
        $this->copyText = $copyText;

        return $this;
    }

    /**
     * Get copyText
     *
     * @return string
     */
    public function getCopyText()
    {
        return $this->copyText;
    }

    /**
     * Set defaultOutput
     *
     * @param \Dmcl\AppBundle\Entity\AccessOutput $defaultOutput
     *
     * @return Devices
     */
    public function setDefaultOutput(\Dmcl\AppBundle\Entity\AccessOutput $defaultOutput = null)
    {
        $this->defaultOutput = $defaultOutput;

        return $this;
    }

    /**
     * Get defaultOutput
     *
     * @return \Dmcl\AppBundle\Entity\AccessOutput
     */
    public function getDefaultOutput()
    {
        return $this->defaultOutput;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \Dmcl\AppBundle\Entity\Users $user
     *
     * @return Devices
     */
    public function addUser(\Dmcl\AppBundle\Entity\Users $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Dmcl\AppBundle\Entity\Users $user
     */
    public function removeUser(\Dmcl\AppBundle\Entity\Users $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
