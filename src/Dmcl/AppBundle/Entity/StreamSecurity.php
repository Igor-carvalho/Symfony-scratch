<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamSecurity
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class StreamSecurity
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
     * @ORM\Column(name="mediaType", type="string", length=255)
     */
    private $mediaType;

    /**
     * @var string
     *
     * @ORM\Column(name="mediaId", type="string", length=255)
     */
    private $mediaId;

    /**
     * @var string
     *
     * @ORM\Column(name="serverId", type="string", length=255,nullable=true)
     */
    private $serverId;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expireAt", type="datetime")
     */
    private $expireAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayed", type="boolean",nullable=true)
     */
    private $displayed=false;

    /**
     * @var integer
     *
     * @ORM\Column(name="owner", type="integer", nullable=true)
     */
    private $owner;


    /**
     * @var integer
     *
     * @ORM\Column(name="customer", type="integer", nullable=true)
     */
    private $customer;


    /**
     * @var string
     *
     * @ORM\Column(name="protocol", type="string", length=255)
     */
    private $protocol;

    /**
     * @var string
     *
     * @ORM\Column(name="fakePath", type="string", length=255,nullable=true)
     */
    private $fakePath;

    /**
     * @var string
     *
     * @ORM\Column(name="originalPath", type="string", length=255)
     */
    private $originalPath;

    /**
     * @var integer
     *
     * @ORM\Column(name="playlist", type="integer", nullable=true)
     */
    private $playlist;


    function __construct()
    {
        $this->createdAt = new \DateTime("now");
        $this->expireAt =  new \DateTime("now + 1 minutes ");
        $this->token = uniqid("",true);
    }

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
     * Set mediaType
     *
     * @param string $mediaType
     * @return StreamSecurity
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * Get mediaType
     *
     * @return string
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * Set mediaId
     *
     * @param string $mediaId
     * @return StreamSecurity
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;

        return $this;
    }

    /**
     * Get mediaId
     *
     * @return string
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return StreamSecurity
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return StreamSecurity
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set expireAt
     *
     * @param string $expireAt
     * @return StreamSecurity
     */
    public function setExpireAt($expireAt)
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    /**
     * Get expireAt
     *
     * @return string
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * Set displayed
     *
     * @param boolean $displayed
     * @return StreamSecurity
     */
    public function setDisplayed($displayed)
    {
        $this->displayed = $displayed;

        return $this;
    }

    /**
     * Get displayed
     *
     * @return boolean
     */
    public function getDisplayed()
    {
        return $this->displayed;
    }

    /**
     * @return string
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }



    /**
     * Set protocol
     *
     * @param string $protocol
     * @return StreamSecurity
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Get protocol
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @return string
     */
    public function getFakePath()
    {
        return $this->fakePath;
    }

    /**
     * @param string $fakePath
     */
    public function setFakePath($fakePath)
    {
        $this->fakePath = $fakePath;
    }

    /**
     * @return string
     */
    public function getOriginalPath()
    {
        return $this->originalPath;
    }

    /**
     * @param string $originalPath
     */
    public function setOriginalPath($originalPath)
    {
        $this->originalPath = $originalPath;
        $this->protocol = substr($this->originalPath,0,strpos($originalPath,":"));
        if (strpos($originalPath, ".m3u8") !== false) {
            $this->protocol = "hls";
        }
    }

    /**
     * @return int
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * @param int $playlist
     */
    public function setPlaylist($playlist)
    {
        $this->playlist = $playlist;
    }

    /**
     * @return string
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * @param string $serverId
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;
    }




    public function createFakePath($base="127.0.0.1",$proxy=false){
        $method = 'create' . ucfirst($this->protocol);
        $fake = $this->originalPath;
        if (method_exists($this,  $method)) {
            $fake = $this->{$method}($base,$proxy);
        }
        return $fake;
    }

    private function createRtmp($base,$proxy){
        if($proxy){
            $this->originalPath = $this->originalPath."&t=".$this->token."&c=".$this->customer."&o=".$this->owner;
            $this->fakePath = $this->originalPath;
        }else{
            $this->originalPath = $this->originalPath."?t=".$this->token;
            $this->fakePath = "rtmp://".$base.":9000/s/".time()."?t=".$this->token."&c=".$this->customer."&o=".$this->owner;
        }
        return $this->fakePath;
    }

    private function createHttp($base,$proxy){
        if($proxy){
            $this->originalPath = $this->originalPath."&t=".$this->token."&c=".$this->customer."&o=".$this->owner;
            $this->fakePath = $this->originalPath;
        }else{
            $this->originalPath = $this->originalPath."?t=".$this->token;
            $this->fakePath = "http://".$base.":9001/s?t=".$this->token."&c=".$this->customer."&o=".$this->owner;
        }
        return $this->fakePath;
    }

    private function createHls($base,$proxy){
        if($proxy){
            $this->originalPath = $this->originalPath."&t=".$this->token."&c=".$this->customer."&o=".$this->owner;
            $this->fakePath = $this->originalPath;
        }else{
            $this->originalPath = $this->originalPath."?t=".$this->token;
            $this->fakePath = "http://".$base.":9005/s?t=".$this->token."&c=".$this->customer."&o=".$this->owner;
        }
        return $this->fakePath;
    }

    private function createUdp($base,$proxy){
        return $this->originalPath;
    }

    private function createRtsp($base,$proxy){
        if($proxy){
            $this->originalPath = $this->originalPath."&t=".$this->token."&c=".$this->customer."&o=".$this->owner;
            $this->fakePath = $this->originalPath;
        }else{
            $this->originalPath = $this->originalPath."?t=".$this->token;
            $this->fakePath = "rtsp://".$base.":9006/s?t=".$this->token."&c=".$this->customer."&o=".$this->owner;
        }
        return $this->fakePath;
    }



}
