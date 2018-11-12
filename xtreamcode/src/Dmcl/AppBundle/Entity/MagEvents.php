<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MagEvents
 *
 * @ORM\Table(name="mag_events", indexes={@ORM\Index(name="status", columns={"status"}), @ORM\Index(name="mag_device_id", columns={"mag_device_id"}), @ORM\Index(name="event", columns={"event"})})
 * @ORM\Entity
 */
class MagEvents
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
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="event", type="string", length=20, nullable=false)
     */
    private $event;

    /**
     * @var boolean
     *
     * @ORM\Column(name="need_confirm", type="boolean", nullable=false)
     */
    private $needConfirm = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="text", length=16777215, nullable=false)
     */
    private $msg;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reboot_after_ok", type="boolean", nullable=false)
     */
    private $rebootAfterOk = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="auto_hide_timeout", type="boolean", nullable=true)
     */
    private $autoHideTimeout = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="send_time", type="integer", nullable=false)
     */
    private $sendTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="additional_services_on", type="boolean", nullable=false)
     */
    private $additionalServicesOn = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="anec", type="boolean", nullable=false)
     */
    private $anec = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="vclub", type="boolean", nullable=false)
     */
    private $vclub = '0';

    /**
     * @var \MagDevices
     *
     * @ORM\ManyToOne(targetEntity="MagDevices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mag_device_id", referencedColumnName="mag_id")
     * })
     */
    private $magDevice;



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
     * Set status
     *
     * @param boolean $status
     *
     * @return MagEvents
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return MagEvents
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set needConfirm
     *
     * @param boolean $needConfirm
     *
     * @return MagEvents
     */
    public function setNeedConfirm($needConfirm)
    {
        $this->needConfirm = $needConfirm;

        return $this;
    }

    /**
     * Get needConfirm
     *
     * @return boolean
     */
    public function getNeedConfirm()
    {
        return $this->needConfirm;
    }

    /**
     * Set msg
     *
     * @param string $msg
     *
     * @return MagEvents
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set rebootAfterOk
     *
     * @param boolean $rebootAfterOk
     *
     * @return MagEvents
     */
    public function setRebootAfterOk($rebootAfterOk)
    {
        $this->rebootAfterOk = $rebootAfterOk;

        return $this;
    }

    /**
     * Get rebootAfterOk
     *
     * @return boolean
     */
    public function getRebootAfterOk()
    {
        return $this->rebootAfterOk;
    }

    /**
     * Set autoHideTimeout
     *
     * @param boolean $autoHideTimeout
     *
     * @return MagEvents
     */
    public function setAutoHideTimeout($autoHideTimeout)
    {
        $this->autoHideTimeout = $autoHideTimeout;

        return $this;
    }

    /**
     * Get autoHideTimeout
     *
     * @return boolean
     */
    public function getAutoHideTimeout()
    {
        return $this->autoHideTimeout;
    }

    /**
     * Set sendTime
     *
     * @param integer $sendTime
     *
     * @return MagEvents
     */
    public function setSendTime($sendTime)
    {
        $this->sendTime = $sendTime;

        return $this;
    }

    /**
     * Get sendTime
     *
     * @return integer
     */
    public function getSendTime()
    {
        return $this->sendTime;
    }

    /**
     * Set additionalServicesOn
     *
     * @param boolean $additionalServicesOn
     *
     * @return MagEvents
     */
    public function setAdditionalServicesOn($additionalServicesOn)
    {
        $this->additionalServicesOn = $additionalServicesOn;

        return $this;
    }

    /**
     * Get additionalServicesOn
     *
     * @return boolean
     */
    public function getAdditionalServicesOn()
    {
        return $this->additionalServicesOn;
    }

    /**
     * Set anec
     *
     * @param boolean $anec
     *
     * @return MagEvents
     */
    public function setAnec($anec)
    {
        $this->anec = $anec;

        return $this;
    }

    /**
     * Get anec
     *
     * @return boolean
     */
    public function getAnec()
    {
        return $this->anec;
    }

    /**
     * Set vclub
     *
     * @param boolean $vclub
     *
     * @return MagEvents
     */
    public function setVclub($vclub)
    {
        $this->vclub = $vclub;

        return $this;
    }

    /**
     * Get vclub
     *
     * @return boolean
     */
    public function getVclub()
    {
        return $this->vclub;
    }

    /**
     * Set magDevice
     *
     * @param \Dmcl\AppBundle\Entity\MagDevices $magDevice
     *
     * @return MagEvents
     */
    public function setMagDevice(\Dmcl\AppBundle\Entity\MagDevices $magDevice = null)
    {
        $this->magDevice = $magDevice;

        return $this;
    }

    /**
     * Get magDevice
     *
     * @return \Dmcl\AppBundle\Entity\MagDevices
     */
    public function getMagDevice()
    {
        return $this->magDevice;
    }
}
