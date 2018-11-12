<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TranscoderConfig
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\TranscoderConfigRepository")
 */
class TranscoderConfig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="httpBase", type="string", length=255)
     */
    private $httpBase;

    /**
     * @var string
     *
     * @ORM\Column(name="hlsBase", type="string", length=255)
     */
    private $hlsBase;

    /**
     * @var string
     *
     * @ORM\Column(name="rtmpBase", type="string", length=255)
     */
    private $rtmpBase;

    /**
     * @var string
     *
     * @ORM\Column(name="rtspBase", type="string", length=255)
     */
    private $rtspBase;

    /**
     * @var string
     *
     * @ORM\Column(name="udpBase", type="string", length=255)
     */
    private $udpBase;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type = "reseller";

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;


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
     * Set httpBase
     *
     * @param string $httpBase
     * @return TranscoderConfig
     */
    public function setHttpBase($httpBase)
    {
        $p = "";
        if (substr($httpBase, strlen($httpBase) - 1, strlen($httpBase)) != "/") {
           $p= "/";
        }
        $this->httpBase = $httpBase.$p;

        return $this;
    }

    /**
     * Get httpBase
     *
     * @return string 
     */
    public function getHttpBase()
    {
        return $this->httpBase;
    }

    /**
     * Set hlsBase
     *
     * @param string $hlsBase
     * @return TranscoderConfig
     */
    public function setHlsBase($hlsBase)
    {
        $p = "";
        if (substr($hlsBase, strlen($hlsBase) - 1, strlen($hlsBase)) != "/") {
            $p= "/";
        }
        $this->hlsBase = $hlsBase.$p;

        return $this;
    }

    /**
     * Get hlsBase
     *
     * @return string 
     */
    public function getHlsBase()
    {
        return $this->hlsBase;
    }

    /**
     * Set rtmpBase
     *
     * @param string $rtmpBase
     * @return TranscoderConfig
     */
    public function setRtmpBase($rtmpBase)
    {

        $p = "";
//        if (substr($rtmpBase, strlen($rtmpBase) - 1, strlen($rtmpBase)) != "/") {
//            $p= "/";
//        }
        $this->rtmpBase = $rtmpBase.$p;

        return $this;
    }

    /**
     * Get rtmpBase
     *
     * @return string 
     */
    public function getRtmpBase()
    {
        return $this->rtmpBase;
    }

    /**
     * Set rtspBase
     *
     * @param string $rtspBase
     * @return TranscoderConfig
     */
    public function setRtspBase($rtspBase)
    {
        $p = "";
        if (substr($rtspBase, strlen($rtspBase) - 1, strlen($rtspBase)) != "/") {
            $p= "/";
        }
        $this->rtspBase = $rtspBase.$p;

        return $this;
    }

    /**
     * Get rtspBase
     *
     * @return string 
     */
    public function getRtspBase()
    {
        return $this->rtspBase;
    }

    /**
     * Set udpBase
     *
     * @param string $udpBase
     * @return TranscoderConfig
     */
    public function setUdpBase($udpBase)
    {
        $p = "";
        if (substr($udpBase, strlen($udpBase) - 1, strlen($udpBase)) != "/") {
            $p= "/";
        }
        $this->udpBase = $udpBase.$p;

        return $this;
    }

    /**
     * Get udpBase
     *
     * @return string 
     */
    public function getUdpBase()
    {
        return $this->udpBase;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return TranscoderConfig
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
     * Set user
     *
     * @param string $user
     * @return TranscoderConfig
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
}
