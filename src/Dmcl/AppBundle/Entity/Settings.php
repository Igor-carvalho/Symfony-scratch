<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\SettingsRepository")
 */
class Settings
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
     * @var User
     * @ORM\OneToOne(targetEntity="Dmcl\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="serverName", type="string", length=255)
     */
    private $serverName;

    /**
     * @var string
     *
     * @ORM\Column(name="timeZone", type="string", length=255)
     */
    private $timeZone;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="playerLogo", type="string", length=255)
     */
    private $playerLogo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allowRegistration", type="boolean",nullable=true)
     */
    private $allowRegistration;

    // /**
    //  * @var boolean
    //  *
    //  * @ORM\Column(name="allowResellersTranscoder", type="boolean",nullable=true)
    //  */
    // private $allowResellersTranscoder;

    // /**
    //  * @var boolean
    //  *
    //  * @ORM\Column(name="notifyResellers", type="boolean",nullable=true)
    //  */
    // private $notifyResellers;

    // /**
    //  * @var boolean
    //  *
    //  * @ORM\Column(name="allowResellersAddChannels", type="boolean",nullable=true)
    //  */
    // private $allowResellersAddChannels;

    // /**
    //  * @var boolean
    //  *
    //  * @ORM\Column(name="allowResellersAddVod", type="boolean",nullable=true)
    //  */
    // private $allowResellersAddVod;

    // /**
    //  * @var boolean
    //  *
    //  * @ORM\Column(name="allowResellersBlockIp", type="boolean",nullable=true)
    //  */
    // private $allowResellersBlockIp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="siteEnabled", type="boolean",nullable=true)
     */
    private $siteEnabled=true;

    /**
     * @var string
     *
     * @ORM\Column(name="companyPhone", type="string", length=255,nullable=true)
     */
    private $companyPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="companyAddress", type="text",nullable=true)
     */
    private $companyAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="companyEmailSupport", type="string", length=255,nullable=true)
     * @Assert\Email(message="entity.settings.company_email_support.invalid")
     */
    private $companyEmailSupport;

    /**
     * @var string
     *
     * @ORM\Column(name="serverAddress", type="string", length=255)
     */
    private $serverAddress = "127.0.0.1";

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="broadcastRTMPPort", type="integer")
    //  */
    // private $broadcastRTMPPort = 1935;
    
    // /**
    // * @var integer
    // *
    // * @ORM\Column(name="refreshtime", type="integer")
    // */
    // private $refreshtime = 5;

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="rtspPort", type="integer")
    //  */
    // private $rtspPort = 6000;

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="broadcastHTTPPort", type="integer")
    //  */
    // private $broadcastHTTPPort = '9000';

    // /**
    //  * @var string
    //  *
    //  * @ORM\Column(name="hlsPath", type="text",nullable=true)
    //  */
    // private $hlsPath;
    
    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="hlsFragment", type="integer")
    //  */
    // private $hlsFragment = 5; //s
    
    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="hlsFragmentTimeshift", type="integer")
    //  */
    // private $hlsFragmentTimeshift = 5; //s

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="audioBitrate1", type="integer")
    //  */
    // private $audioBitrate1 = 32; //k

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="audioBitrate2", type="integer")
    //  */
    // private $audioBitrate2 = 64; //k

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="audioBitrate3", type="integer")
    //  */
    // private $audioBitrate3 = 128; //k

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="videoBitrate1", type="integer")
    //  */
    // private $videoBitrate1 = 512; //k

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="videoBitrate2", type="integer")
    //  */
    // private $videoBitrate2 = 1024; //k

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="videoBitrate3", type="integer")
    //  */
    // private $videoBitrate3 = 1500; //k

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="dashPlaylistLength", type="integer")
    //  */
    // private $dashPlaylistLength = 10; //m

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="dashFragment", type="integer")
    //  */
    // private $dashFragment = 5; //s

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="hlsPlaylistLength", type="integer")
    //  */
    // private $hlsPlaylistLength = 10; //m

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="hlsPlaylistLengthTimeshift", type="integer")
    //  */
    // private $hlsPlaylistLengthTimeshift = 10; //h
    
    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="timeForUpdates", type="integer")
    //  */
    // private $timeForUpdates = 1;
    
    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="hlsSync", type="integer")
    //  */
    // private $hlsSync = 100; //ms

    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="resellersLimit", type="integer")
    //  */
    // private $resellersLimit = 0;


    // /**
    //  * @var integer
    //  *
    //  * @ORM\Column(name="maxConcurentConnections", type="integer")
    //  */
    // private $maxConcurrentConnections = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="aboutUs", type="text", nullable=true)
     */
    private $aboutUs = null;

    /**
     * @var string
     *
     * @ORM\Column(name="servicesDescription", type="text", nullable=true)
     */
    private $servicesDescription = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime",nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="emailServiceType", type="string", length=255)
     * @Assert\Choice(choices = { "local", "remote"},message = "entity.settings.email_service_type.invalid")
     */
    private $emailServiceType = "local";

    /**
     * @var string
     *
     * @ORM\Column(name="emailSender", type="string", length=255)
     */
    private $emailSender = "example@domain.com";

    /**
     * @var string
     *
     * @ORM\Column(name="emailHost", type="string", length=255)
     */
    private $emailHost = "127.0.0.1";

    /**
     * @var string
     *
     * @ORM\Column(name="emailPort", type="string", length=255,nullable=true)
     */
    private $emailPort = 25;

    /**
     * @var string
     *
     * @ORM\Column(name="emailUsername", type="string", length=255,nullable=true)
     */
    private $emailUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPassword", type="string", length=255,nullable=true)
     */
    private $emailPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAuthenticationMode", type="string", length=255,nullable=true)
     */
    private $emailAuthenticationMode;

    /**
     * @var string
     *
     * @ORM\Column(name="emailEncryptionMode", type="string", length=255,nullable=true)
     */
    private $emailEncryptionMode;

    // /**
    //  * @var string
    //  *
    //  * @ORM\Column(name="vodUploadDir", type="string", length=255)
    //  */
    // private $vodUploadDir = "/tmp/";

    // /**
    //  * @var string
    //  *
    //  * @ORM\Column(name="vodBaseUrl", type="string", length=255)
    //  */
    // private $vodBaseUrl = "/vod/";


    private $temp;
    /**
     * @Assert\Image()
     */
    private $file;
    private $path;

    private $tempPlayer;

    /**
     * @Assert\Image()
     */
    private $filePlayer;
    private $pathPlayer;

    /**
     * @var
     * @ORM\Column(name="news", type="text", nullable=true)
     */
    private $news;

    /**
     * @var string
     *
     * @ORM\Column(name="styleLayout", type="string", length=150)
     */
    private $styleLayout = "sidebar-full-height sidebar-sm";

    /**
     * @var string
     *
     * @ORM\Column(name="styleColor", type="string", length=50)
     */
    private $styleColor = "style";

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
     * Set serverName
     *
     * @param string $serverName
     * @return Settings
     */
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;

        return $this;
    }

    /**
     * Get serverName
     *
     * @return string
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * Set timeZone
     *
     * @param string $timeZone
     * @return Settings
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Settings
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set allowRegistration
     *
     * @param boolean $allowRegistration
     * @return Settings
     */
    public function setAllowRegistration($allowRegistration)
    {
        $this->allowRegistration = $allowRegistration;

        return $this;
    }

    /**
     * Get allowRegistration
     *
     * @return boolean
     */
    public function getAllowRegistration()
    {
        return $this->allowRegistration;
    }

    // /**
    //  * Set allowResellersTranscoder
    //  *
    //  * @param boolean $allowResellersTranscoder
    //  * @return Settings
    //  */
    // public function setAllowResellersTranscoder($allowResellersTranscoder)
    // {
    //     $this->allowResellersTranscoder = $allowResellersTranscoder;

    //     return $this;
    // }

    // /**
    //  * Get allowResellersTranscoder
    //  *
    //  * @return boolean
    //  */
    // public function getAllowResellersTranscoder()
    // {
    //     return $this->allowResellersTranscoder;
    // }

    // /**
    //  * Set allowResellersAddChannels
    //  *
    //  * @param boolean $allowResellersAddChannels
    //  * @return Settings
    //  */
    // public function setAllowResellersAddChannels($allowResellersAddChannels)
    // {
    //     $this->allowResellersAddChannels = $allowResellersAddChannels;

    //     return $this;
    // }

    // /**
    //  * Get allowResellersAddChannels
    //  *
    //  * @return boolean
    //  */
    // public function getAllowResellersAddChannels()
    // {
    //     return $this->allowResellersAddChannels;
    // }

    // /**
    //  * Set allowResellersBlockIp
    //  *
    //  * @param boolean $allowResellersBlockIp
    //  * @return Settings
    //  */
    // public function setAllowResellersBlockIp($allowResellersBlockIp)
    // {
    //     $this->allowResellersBlockIp = $allowResellersBlockIp;

    //     return $this;
    // }

    // /**
    //  * Get allowResellersBlockIp
    //  *
    //  * @return boolean
    //  */
    // public function getAllowResellersBlockIp()
    // {
    //     return $this->allowResellersBlockIp;
    // }

    /**
     * Set siteEnabled
     *
     * @param boolean $siteEnabled
     * @return Settings
     */
    public function setSiteEnabled($siteEnabled)
    {
        $this->siteEnabled = $siteEnabled;

        return $this;
    }

    /**
     * Get siteEnabled
     *
     * @return boolean
     */
    public function getSiteEnabled()
    {
        return $this->siteEnabled;
    }

    /**
     * Set emailServiceType
     *
     * @param string $emailServiceType
     * @return Settings
     */
    public function setEmailServiceType($emailServiceType)
    {
        $this->emailServiceType = $emailServiceType;

        return $this;
    }

    /**
     * Get emailServiceType
     *
     * @return string
     */
    public function getEmailServiceType()
    {
        return $this->emailServiceType;
    }

    /**
     * Set emailHost
     *
     * @param string $emailHost
     * @return Settings
     */
    public function setEmailHost($emailHost)
    {
        $this->emailHost = $emailHost;

        return $this;
    }

    /**
     * Get emailHost
     *
     * @return string
     */
    public function getEmailHost()
    {
        return $this->emailHost;
    }

    /**
     * Set emailPort
     *
     * @param string $emailPort
     * @return Settings
     */
    public function setEnailPort($emailPort)
    {
        $this->emailPort = $emailPort;

        return $this;
    }

    /**
     * Get emailPort
     *
     * @return string
     */
    public function getEnailPort()
    {
        return $this->emailPort;
    }

    /**
     * Set emailUsername
     *
     * @param string $emailUsername
     * @return Settings
     */
    public function setEmailUsername($emailUsername)
    {
        $this->emailUsername = $emailUsername;

        return $this;
    }

    /**
     * Get emailUsername
     *
     * @return string
     */
    public function getEmailUsername()
    {
        return $this->emailUsername;
    }

    /**
     * Set emailPassword
     *
     * @param string $emailPassword
     * @return Settings
     */
    public function setEmailPassword($emailPassword)
    {
        $this->emailPassword = $emailPassword;

        return $this;
    }

    /**
     * Get emailPassword
     *
     * @return string
     */
    public function getEmailPassword()
    {
        return $this->emailPassword;
    }

    /**
     * Set emailAuthenticationMode
     *
     * @param string $emailAuthenticationMode
     * @return Settings
     */
    public function setEmailAuthenticationMode($emailAuthenticationMode)
    {
        $this->emailAuthenticationMode = $emailAuthenticationMode;

        return $this;
    }

    /**
     * Get emailAuthenticationMode
     *
     * @return string
     */
    public function getEmailAuthenticationMode()
    {
        return $this->emailAuthenticationMode;
    }

    /**
     * Set emailEncryptionMode
     *
     * @param string $emailEncryptionMode
     * @return Settings
     */
    public function setEmailEncryptionMode($emailEncryptionMode)
    {
        $this->emailEncryptionMode = $emailEncryptionMode;

        return $this;
    }

    /**
     * Get emailEncryptionMode
     *
     * @return string
     */
    public function getEmailEncryptionMode()
    {
        return $this->emailEncryptionMode;
    }

    /**
     * Set companyPhone
     *
     * @param string $companyPhone
     * @return Settings
     */
    public function setCompanyPhone($companyPhone)
    {
        $this->companyPhone = $companyPhone;

        return $this;
    }

    /**
     * Get companyPhone
     *
     * @return string
     */
    public function getCompanyPhone()
    {
        return $this->companyPhone;
    }

    /**
     * Set companyAddress
     *
     * @param string $companyAddress
     * @return Settings
     */
    public function setCompanyAddress($companyAddress)
    {
        $this->companyAddress = $companyAddress;

        return $this;
    }

    /**
     * Get companyAddress
     *
     * @return string
     */
    public function getCompanyAddress()
    {
        return $this->companyAddress;
    }

    /**
     * Set companyEmailSupport
     *
     * @param string $companyEmailSupport
     * @return Settings
     */
    public function setCompanyEmailSupport($companyEmailSupport)
    {
        $this->companyEmailSupport = $companyEmailSupport;

        return $this;
    }

    /**
     * Get companyEmailSupport
     *
     * @return string
     */
    public function getCompanyEmailSupport()
    {
        return $this->companyEmailSupport;
    }

    /**
     * Set serverAddress
     *
     * @param string $serverAddress
     * @return Settings
     */
    public function setServerAddress($serverAddress)
    {
        $this->serverAddress = $serverAddress;

        return $this;
    }

    /**
     * Get serverAddress
     *
     * @return string
     */
    public function getServerAddress()
    {
        return $this->serverAddress;
    }

    // /**
    //  * Set hlsPath
    //  *
    //  * @param string $hlsPath
    //  * @return Settings
    //  */
    // public function setHlsPath($hlsPath)
    // {
    //     $this->hlsPath = $hlsPath;

    //     return $this;
    // }

    // /**
    //  * Get hlsPath
    //  *
    //  * @return string
    //  */
    // public function getHlsPath()
    // {
    //     return $this->hlsPath;
    // }

    // /**
    //  * Set broadcastRTMPPort
    //  *
    //  * @param integer $broadcastRTMPPort
    //  * @return Settings
    //  */
    // public function setBroadcastRTMPPort($broadcastRTMPPort)
    // {
    //     $this->broadcastRTMPPort = $broadcastRTMPPort;

    //     return $this;
    // }

    // /**
    //  * Get broadcastRTMPPort
    //  *
    //  * @return integer
    //  */
    // public function getBroadcastRTMPPort()
    // {
    //     return $this->broadcastRTMPPort;
    // }
    
    // /**
    //     * Set refreshtime
    //     *
    //     * @param integer $refreshtime
    //     * @return Settings
    //     */
    // public function setRefreshtime($refreshtime)
    // {
    //     $this->refreshtime = $refreshtime;

    //     return $this;
    // }

    // /**
    //     * Get refreshtime
    //     *
    //     * @return integer
    //     */
    // public function getRefreshtime()
    // {
    //     return $this->refreshtime;
    // }

    // /**
    //  * Set rtspPort
    //  *
    //  * @param integer $rtspPort
    //  * @return Settings
    //  */
    // public function setRtspPort($rtspPort)
    // {
    //     $this->rtspPort = $rtspPort;

    //     return $this;
    // }

    // /**
    //  * Get rtspPort
    //  *
    //  * @return integer
    //  */
    //  public function getRtspPort()
    // {
    //     return $this->rtspPort;
    // }

    // /**
    //  * Set broadcastHTTPPort
    //  *
    //  * @param integer $broadcastHTTPPort
    //  * @return Settings
    //  */
    // public function setBroadcastHTTPPort($broadcastHTTPPort)
    // {
    //     $this->broadcastHTTPPort = $broadcastHTTPPort;

    //     return $this;
    // }

    // /**
    //  * Get broadcastHTTPPort
    //  *
    //  * @return integer
    //  */
    // public function getBroadcastHTTPPort()
    // {
    //     return $this->broadcastHTTPPort;
    // }

    // /**
    //  * Set timeForUpdates
    //  *
    //  * @param integer $timeForUpdates
    //  * @return Settings
    //  */
    // public function setTimeForUpdates($timeForUpdates)
    // {
    //     $this->timeForUpdates = $timeForUpdates;

    //     return $this;
    // }

    // /**
    //  * Get timeForUpdates
    //  *
    //  * @return integer
    //  */
    // public function getTimeForUpdates()
    // {
    //     return $this->timeForUpdates;
    // }

    /**
     * Set aboutUs
     *
     * @param string $aboutUs
     * @return Settings
     */
    public function setAboutUs($aboutUs)
    {
        $this->aboutUs = $aboutUs;

        return $this;
    }

    /**
     * Get aboutUs
     *
     * @return string
     */
    public function getAboutUs()
    {
        return $this->aboutUs;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Settings
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set emailPort
     *
     * @param string $emailPort
     * @return Settings
     */
    public function setEmailPort($emailPort)
    {
        $this->emailPort = $emailPort;

        return $this;
    }

    /**
     * Get emailPort
     *
     * @return string
     */
    public function getEmailPort()
    {
        return $this->emailPort;
    }

    /**
     * Set playerLogo
     *
     * @param string $playerLogo
     * @return Settings
     */
    public function setPlayerLogo($playerLogo)
    {
        $this->playerLogo = $playerLogo;

        return $this;
    }

    /**
     * Get playerLogo
     *
     * @return string
     */
    public function getPlayerLogo()
    {
        return $this->playerLogo;
    }


    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename . '.' . $this->getFile()->guessExtension();
            $this->logo = $this->path;
        }
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null != $this->getFile()) {
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFile()->move($this->getUploadRootDir(), $this->path);
            // check if we have an old image
            if (isset($this->temp)) {
                // delete the old image
                @unlink($this->getUploadRootDir() . '/' . $this->temp);
                // clear the temp image path
                $this->temp = null;
            }
            $this->file = null;
        }
        if (null != $this->getFilePlayer()) {
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFilePlayer()->move($this->getUploadRootDir(), $this->pathPlayer);

            // check if we have an old image
            if (isset($this->tempPlayer)) {
                // delete the old image
                @unlink($this->getUploadRootDir() . '/' . $this->tempPlayer);
                // clear the temp image path
                $this->tempPlayer = null;
            }
            $this->filePlayer = null;
        }
    }

    public function getAbsolutePath() {
        return null === $this->logo ? null : $this->getUploadRootDir() . '/' . $this->logo;
    }

    public function getWebPath() {
        return null === $this->logo ? null : $this->getUploadDir() . '/' . $this->logo;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->logo)) {
            // store the old name to delete after the update
            $this->temp = $this->logo;
            $this->path = null;
            $this->logo = null;
        } else {
            $this->path = 'initial';
            $this->logo = 'initial';
        }
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFilePlayer(UploadedFile $filePlayer = null) {
        $this->filePlayer = $filePlayer;
        // check if we have an old image path
        if (isset($this->playerLogo)) {
            // store the old name to delete after the update
            $this->tempPlayer = $this->playerLogo;
            $this->pathPlayer = null;
            $this->playerLogo = null;
        } else {
            $this->pathPlayer = 'initial';
            $this->playerLogo = 'initial';
        }
    }

    /**
     * @return mixed
     */
    public function getFilePlayer()
    {
        return $this->filePlayer;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }


    /**
     * Set uploadDir
     *
     * @param string $uploadDir
     * @return Settings
     */
    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;

        return $this;
    }

    // /**
    //  * Set vodUploadDir
    //  *
    //  * @param string $vodUploadDir
    //  * @return Settings
    //  */
    // public function setVodUploadDir($vodUploadDir)
    // {
    //     $this->vodUploadDir = $vodUploadDir;

    //     return $this;
    // }

    // /**
    //  * Get vodUploadDir
    //  *
    //  * @return string
    //  */
    // public function getVodUploadDir()
    // {
    //     return $this->vodUploadDir;
    // }

    // /**
    //  * Set vodBaseUrl
    //  *
    //  * @param string $vodBaseUrl
    //  * @return Settings
    //  */
    // public function setVodBaseUrl($vodBaseUrl)
    // {
    //     $this->vodBaseUrl = $vodBaseUrl;

    //     return $this;
    // }

    // /**
    //  * Get vodBaseUrl
    //  *
    //  * @return string
    //  */
    // public function getVodBaseUrl()
    // {
    //     return $this->vodBaseUrl;
    // }

    // /**
    //  * @return boolean
    //  */
    // public function isNotifyResellers()
    // {
    //     return $this->notifyResellers;
    // }

    // /**
    //  * @param boolean $notifyResellers
    //  */
    // public function setNotifyResellers($notifyResellers)
    // {
    //     $this->notifyResellers = $notifyResellers;
    // }

    /**
     * @return string
     */
    public function getServicesDescription()
    {
        return $this->servicesDescription;
    }

    /**
     * @param string $servicesDescription
     */
    public function setServicesDescription($servicesDescription)
    {
        $this->servicesDescription = $servicesDescription;
    }

    // /**
    //  * @return boolean
    //  */
    // public function isAllowResellersAddVod()
    // {
    //     return $this->allowResellersAddVod;
    // }

    // /**
    //  * @param boolean $allowResellersAddVod
    //  */
    // public function setAllowResellersAddVod($allowResellersAddVod)
    // {
    //     $this->allowResellersAddVod = $allowResellersAddVod;
    // }



    /**
     * Set emailSender
     *
     * @param string $mailSender
     * @return Settings
     */
    public function setEmailSender($emailSender)
    {
        $this->emailSender = $emailSender;

        return $this;
    }

    /**
     * Get emailSender
     *
     * @return string
     */
    public function getEmailSender()
    {
        return $this->emailSender;
    }

    // /**
    //  * @return int
    //  */
    // public function getResellersLimit()
    // {
    //     return $this->resellersLimit;
    // }

    // /**
    //  * @param int $resellersLimit
    //  */
    // public function setResellersLimit($resellersLimit)
    // {
    //     $this->resellersLimit = $resellersLimit;
    // }

    // /**
    //  * Set hlsPlaylistLength
    //  *
    //  * @param integer $hlsPlaylistLength
    //  * @return Settings
    //  */
    // public function setHlsPlaylistLength($hlsPlaylistLength)
    // {
    //     $this->hlsPlaylistLength = $hlsPlaylistLength;

    //     return $this;
    // }

    // /**
    //  * Get hlsPlaylistLength
    //  *
    //  * @return integer
    //  */
    // public function getHlsPlaylistLength()
    // {
    //     return $this->hlsPlaylistLength;
    // }

    // /**
    //  * Set hlsPlaylistLengthTimeshift
    //  *
    //  * @param integer $hlsPlaylistLengthTimeshift
    //  * @return Settings
    //  */
    // public function setHlsPlaylistLengthTimeshift($hlsPlaylistLengthTimeshift)
    // {
    //     $this->hlsPlaylistLengthTimeshift = $hlsPlaylistLengthTimeshift;

    //     return $this;
    // }

    // /**
    //  * Get hlsPlaylistLengthTimeshift
    //  *
    //  * @return integer
    //  */
    // public function getHlsPlaylistLengthTimeshift()
    // {
    //     return $this->hlsPlaylistLengthTimeshift;
    // }
        
    // /**
    //  * @return int
    //  */
    // public function getHlsFragment()
    // {
    //     return $this->hlsFragment;
    // }

    // /**
    //  * @param int $hlsFragment
    //  */
    // public function setHlsFragment($hlsFragment)
    // {
    //     $this->hlsFragment = $hlsFragment;
    // }
        
    // /**
    //  * @return int
    //  */
    // public function getHlsFragmentTimeshift()
    // {
    //     return $this->hlsFragmentTimeshift;
    // }

    // /**
    //  * @param int $hlsFragmentTimeshift
    //  */
    // public function setHlsFragmentTimeshift($hlsFragmentTimeshift)
    // {
    //     $this->hlsFragmentTimeshift = $hlsFragmentTimeshift;
    // }

    // /**
    //  * Set audioBitrate1
    //  *
    //  * @param integer $audioBitrate1
    //  * @return Settings
    //  */
    // public function setAudioBitrate1($audioBitrate1)
    // {
    //     $this->audioBitrate1 = $audioBitrate1;

    //     return $this;
    // }

    // /**
    //  * Get audioBitrate1
    //  *
    //  * @return integer
    //  */
    // public function getAudioBitrate1()
    // {
    //     return $this->audioBitrate1;
    // }

    // /**
    //  * Set audioBitrate2
    //  *
    //  * @param integer $audioBitrate2
    //  * @return Settings
    //  */
    // public function setAudioBitrate2($audioBitrate2)
    // {
    //     $this->audioBitrate2 = $audioBitrate2;

    //     return $this;
    // }

    // /**
    //  * Get audioBitrate2
    //  *
    //  * @return integer
    //  */
    // public function getAudioBitrate2()
    // {
    //     return $this->audioBitrate2;
    // }

    // /**
    //  * Set audioBitrate3
    //  *
    //  * @param integer $audioBitrate3
    //  * @return Settings
    //  */
    // public function setAudioBitrate3($audioBitrate3)
    // {
    //     $this->audioBitrate3 = $audioBitrate3;

    //     return $this;
    // }

    // /**
    //  * Get audioBitrate3
    //  *
    //  * @return integer
    //  */
    // public function getAudioBitrate3()
    // {
    //     return $this->audioBitrate3;
    // }

    // /**
    //  * Set videoBitrate1
    //  *
    //  * @param integer $videoBitrate1
    //  * @return Settings
    //  */
    // public function setVideoBitrate1($videoBitrate1)
    // {
    //     $this->videoBitrate1 = $videoBitrate1;

    //     return $this;
    // }

    // /**
    //  * Get videoBitrate1
    //  *
    //  * @return integer
    //  */
    // public function getVideoBitrate1()
    // {
    //     return $this->videoBitrate1;
    // }

    // /**
    //  * Set videoBitrate2
    //  *
    //  * @param integer $videoBitrate2
    //  * @return Settings
    //  */
    // public function setVideoBitrate2($videoBitrate2)
    // {
    //     $this->videoBitrate2 = $videoBitrate2;

    //     return $this;
    // }

    // /**
    //  * Get videoBitrate2
    //  *
    //  * @return integer
    //  */
    // public function getVideoBitrate2()
    // {
    //     return $this->videoBitrate2;
    // }

    // /**
    //  * Set videoBitrate3
    //  *
    //  * @param integer $videoBitrate3
    //  * @return Settings
    //  */
    // public function setVideoBitrate3($videoBitrate3)
    // {
    //     $this->videoBitrate3 = $videoBitrate3;

    //     return $this;
    // }

    // /**
    //  * Get videoBitrate3
    //  *
    //  * @return integer
    //  */
    // public function getVideoBitrate3()
    // {
    //     return $this->videoBitrate3;
    // }

    // /**
    //  * Set dashPlaylistLength
    //  *
    //  * @param integer $dashPlaylistLength
    //  * @return Settings
    //  */
    // public function setDashPlaylistLength($dashPlaylistLength)
    // {
    //     $this->dashPlaylistLength = $dashPlaylistLength;

    //     return $this;
    // }

    // /**
    //  * Get dashPlaylistLength
    //  *
    //  * @return integer
    //  */
    // public function getDashPlaylistLength()
    // {
    //     return $this->dashPlaylistLength;
    // }


    // /**
    //  * Set dashFragment
    //  *
    //  * @param integer $dashFragment
    //  * @return Settings
    //  */
    // public function setDashFragment($dashFragment)
    // {
    //     $this->dashFragment = $dashFragment;

    //     return $this;
    // }

    // /**
    //  * Get dashFragment
    //  *
    //  * @return integer
    //  */
    // public function getDashFragment()
    // {
    //     return $this->dashFragment;
    // }

    // /**
    //  * Set hlsSync
    //  *
    //  * @param integer $hlsSync
    //  * @return Settings
    //  */
    // public function setHlsSync($hlsSync)
    // {
    //     $this->hlsSync = $hlsSync;

    //     return $this;
    // }

    // /**
    //  * Get hlsSync
    //  *
    //  * @return integer
    //  */
    // public function getHlsSync()
    // {
    //     return $this->hlsSync;
    // }

    // /**
    //  * Get notifyResellers
    //  *
    //  * @return boolean
    //  */
    // public function getNotifyResellers()
    // {
    //     return $this->notifyResellers;
    // }

    // /**
    //  * Get allowResellersAddVod
    //  *
    //  * @return boolean
    //  */
    // public function getAllowResellersAddVod()
    // {
    //     return $this->allowResellersAddVod;
    // }

    // /**
    //  * Set maxConcurrentConnections
    //  *
    //  * @param integer $maxConcurrentConnections
    //  * @return Settings
    //  */
    // public function setMaxConcurrentConnections($maxConcurrentConnections)
    // {
    //     $this->maxConcurrentConnections = $maxConcurrentConnections;

    //     return $this;
    // }

    // /**
    //  * Get maxConcurrentConnections
    //  *
    //  * @return integer
    //  */
    // public function getMaxConcurrentConnections()
    // {
    //     return $this->maxConcurrentConnections;
    // }

    /**
     * Set news
     *
     * @param string $news
     *
     * @return Settings
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return string
     */
    public function getNews()
    {
        return $this->news;
    }

    // /**
    //  * Set trialPeriodoTime
    //  *
    //  * @param integer $trialPeriodoTime
    //  *
    //  * @return Settings
    //  */
    // public function setTrialPeriodoTime($trialPeriodoTime)
    // {
    //     $this->trialPeriodoTime = $trialPeriodoTime;

    //     return $this;
    // }

    // /**
    //  * Get trialPeriodoTime
    //  *
    //  * @return integer
    //  */
    // public function getTrialPeriodoTime()
    // {
    //     return $this->trialPeriodoTime;
    // }

    // /**
    //  * @return int
    //  */
    // public function getBroadcastDASHPort()
    // {
    //     return $this->broadcastDASHPort;
    // }

    // /**
    //  * @param int $broadcastDASHPort
    //  */
    // public function setBroadcastDASHPort($broadcastDASHPort)
    // {
    //     $this->broadcastDASHPort = $broadcastDASHPort;
    // }

    // /**
    //  * @return int
    //  */
    // public function getNodeJsPort()
    // {
    //     return $this->nodeJsPort;
    // }

    // /**
    //  * @param int $nodeJsPort
    //  */
    // public function setNodeJsPort($nodeJsPort)
    // {
    //     $this->nodeJsPort = $nodeJsPort;
    // }
    
    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**   
     * @param \Dmcl\AppBundle\Entity\User $user
     * @return Settings
     */
    public function setUser(\Dmcl\AppBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Set styleLayout
     *
     * @param string $styleLayout
     *
     * @return Settings
     */
    public function setStyleLayout($styleLayout)
    {
        $this->styleLayout = $styleLayout;

        return $this;
    }

    /**
     * Get styleLayout
     *
     * @return string
     */
    public function getStyleLayout()
    {
        return $this->styleLayout;
    }

    /**
     * Set styleColor
     *
     * @param string $styleColor
     *
     * @return Settings
     */
    public function setStyleColor($styleColor)
    {
        $this->styleColor = $styleColor;

        return $this;
    }

    /**
     * Get styleColor
     *
     * @return string
     */
    public function getStyleColor()
    {
        return $this->styleColor;
    }
}
