<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enigma2Devices
 *
 * @ORM\Table(name="enigma2_devices", indexes={@ORM\Index(name="mac", columns={"mac"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Enigma2Devices
{
    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=255, nullable=false)
     */
    private $mac;

    /**
     * @var string
     *
     * @ORM\Column(name="modem_mac", type="string", length=255, nullable=false)
     */
    private $modemMac;

    /**
     * @var string
     *
     * @ORM\Column(name="local_ip", type="string", length=255, nullable=false)
     */
    private $localIp;

    /**
     * @var string
     *
     * @ORM\Column(name="public_ip", type="string", length=255, nullable=false)
     */
    private $publicIp;

    /**
     * @var string
     *
     * @ORM\Column(name="key_auth", type="string", length=255, nullable=false)
     */
    private $keyAuth;

    /**
     * @var string
     *
     * @ORM\Column(name="enigma_version", type="string", length=255, nullable=false)
     */
    private $enigmaVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="cpu", type="string", length=255, nullable=false)
     */
    private $cpu;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=false)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="lversion", type="text", length=65535, nullable=false)
     */
    private $lversion;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=32, nullable=false)
     */
    private $token;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_updated", type="integer", nullable=false)
     */
    private $lastUpdated;

    /**
     * @var integer
     *
     * @ORM\Column(name="watchdog_timeout", type="integer", nullable=false)
     */
    private $watchdogTimeout;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lock_device", type="boolean", nullable=false)
     */
    private $lockDevice = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="telnet_enable", type="boolean", nullable=false)
     */
    private $telnetEnable = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="ftp_enable", type="boolean", nullable=false)
     */
    private $ftpEnable = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="ssh_enable", type="boolean", nullable=false)
     */
    private $sshEnable = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="dns", type="string", length=255, nullable=false)
     */
    private $dns = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rc", type="boolean", nullable=false)
     */
    private $rc = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="original_mac", type="string", length=255, nullable=false)
     */
    private $originalMac;

    /**
     * @var \Devices
     *
     * @ORM\Column(name="device_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $device;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set mac
     *
     * @param string $mac
     *
     * @return Enigma2Devices
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * Set modemMac
     *
     * @param string $modemMac
     *
     * @return Enigma2Devices
     */
    public function setModemMac($modemMac)
    {
        $this->modemMac = $modemMac;

        return $this;
    }

    /**
     * Get modemMac
     *
     * @return string
     */
    public function getModemMac()
    {
        return $this->modemMac;
    }

    /**
     * Set localIp
     *
     * @param string $localIp
     *
     * @return Enigma2Devices
     */
    public function setLocalIp($localIp)
    {
        $this->localIp = $localIp;

        return $this;
    }

    /**
     * Get localIp
     *
     * @return string
     */
    public function getLocalIp()
    {
        return $this->localIp;
    }

    /**
     * Set publicIp
     *
     * @param string $publicIp
     *
     * @return Enigma2Devices
     */
    public function setPublicIp($publicIp)
    {
        $this->publicIp = $publicIp;

        return $this;
    }

    /**
     * Get publicIp
     *
     * @return string
     */
    public function getPublicIp()
    {
        return $this->publicIp;
    }

    /**
     * Set keyAuth
     *
     * @param string $keyAuth
     *
     * @return Enigma2Devices
     */
    public function setKeyAuth($keyAuth)
    {
        $this->keyAuth = $keyAuth;

        return $this;
    }

    /**
     * Get keyAuth
     *
     * @return string
     */
    public function getKeyAuth()
    {
        return $this->keyAuth;
    }

    /**
     * Set enigmaVersion
     *
     * @param string $enigmaVersion
     *
     * @return Enigma2Devices
     */
    public function setEnigmaVersion($enigmaVersion)
    {
        $this->enigmaVersion = $enigmaVersion;

        return $this;
    }

    /**
     * Get enigmaVersion
     *
     * @return string
     */
    public function getEnigmaVersion()
    {
        return $this->enigmaVersion;
    }

    /**
     * Set cpu
     *
     * @param string $cpu
     *
     * @return Enigma2Devices
     */
    public function setCpu($cpu)
    {
        $this->cpu = $cpu;

        return $this;
    }

    /**
     * Get cpu
     *
     * @return string
     */
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return Enigma2Devices
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set lversion
     *
     * @param string $lversion
     *
     * @return Enigma2Devices
     */
    public function setLversion($lversion)
    {
        $this->lversion = $lversion;

        return $this;
    }

    /**
     * Get lversion
     *
     * @return string
     */
    public function getLversion()
    {
        return $this->lversion;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Enigma2Devices
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set lastUpdated
     *
     * @param integer $lastUpdated
     *
     * @return Enigma2Devices
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
     * Set watchdogTimeout
     *
     * @param integer $watchdogTimeout
     *
     * @return Enigma2Devices
     */
    public function setWatchdogTimeout($watchdogTimeout)
    {
        $this->watchdogTimeout = $watchdogTimeout;

        return $this;
    }

    /**
     * Get watchdogTimeout
     *
     * @return integer
     */
    public function getWatchdogTimeout()
    {
        return $this->watchdogTimeout;
    }

    /**
     * Set lockDevice
     *
     * @param boolean $lockDevice
     *
     * @return Enigma2Devices
     */
    public function setLockDevice($lockDevice)
    {
        $this->lockDevice = $lockDevice;

        return $this;
    }

    /**
     * Get lockDevice
     *
     * @return boolean
     */
    public function getLockDevice()
    {
        return $this->lockDevice;
    }

    /**
     * Set telnetEnable
     *
     * @param boolean $telnetEnable
     *
     * @return Enigma2Devices
     */
    public function setTelnetEnable($telnetEnable)
    {
        $this->telnetEnable = $telnetEnable;

        return $this;
    }

    /**
     * Get telnetEnable
     *
     * @return boolean
     */
    public function getTelnetEnable()
    {
        return $this->telnetEnable;
    }

    /**
     * Set ftpEnable
     *
     * @param boolean $ftpEnable
     *
     * @return Enigma2Devices
     */
    public function setFtpEnable($ftpEnable)
    {
        $this->ftpEnable = $ftpEnable;

        return $this;
    }

    /**
     * Get ftpEnable
     *
     * @return boolean
     */
    public function getFtpEnable()
    {
        return $this->ftpEnable;
    }

    /**
     * Set sshEnable
     *
     * @param boolean $sshEnable
     *
     * @return Enigma2Devices
     */
    public function setSshEnable($sshEnable)
    {
        $this->sshEnable = $sshEnable;

        return $this;
    }

    /**
     * Get sshEnable
     *
     * @return boolean
     */
    public function getSshEnable()
    {
        return $this->sshEnable;
    }

    /**
     * Set dns
     *
     * @param string $dns
     *
     * @return Enigma2Devices
     */
    public function setDns($dns)
    {
        $this->dns = $dns;

        return $this;
    }

    /**
     * Get dns
     *
     * @return string
     */
    public function getDns()
    {
        return $this->dns;
    }

    /**
     * Set rc
     *
     * @param boolean $rc
     *
     * @return Enigma2Devices
     */
    public function setRc($rc)
    {
        $this->rc = $rc;

        return $this;
    }

    /**
     * Get rc
     *
     * @return boolean
     */
    public function getRc()
    {
        return $this->rc;
    }

    /**
     * Set originalMac
     *
     * @param string $originalMac
     *
     * @return Enigma2Devices
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
     * Set device
     *
     * @param \Dmcl\AppBundle\Entity\Devices $device
     *
     * @return Enigma2Devices
     */
    public function setDevice(\Dmcl\AppBundle\Entity\Devices $device)
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

    /**
     * Set user
     *
     * @param \Dmcl\AppBundle\Entity\Users $user
     *
     * @return Enigma2Devices
     */
    public function setUser(\Dmcl\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dmcl\AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }
}
