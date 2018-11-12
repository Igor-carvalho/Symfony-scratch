<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MagDevices
 *
 * @ORM\Table(name="mag_devices", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="mac", columns={"mac"})})
 * @ORM\Entity
 */
class MagDevices
{
    /**
     * @var integer
     *
     * @ORM\Column(name="mag_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $magId;

    /**
     * @var integer
     *
     * @ORM\Column(name="bright", type="integer", nullable=false)
     */
    private $bright = '200';

    /**
     * @var integer
     *
     * @ORM\Column(name="contrast", type="integer", nullable=false)
     */
    private $contrast = '127';

    /**
     * @var integer
     *
     * @ORM\Column(name="saturation", type="integer", nullable=false)
     */
    private $saturation = '127';

    /**
     * @var string
     *
     * @ORM\Column(name="aspect", type="text", length=16777215, nullable=false)
     */
    private $aspect;

    /**
     * @var string
     *
     * @ORM\Column(name="video_out", type="string", length=20, nullable=false)
     */
    private $videoOut = 'rca';

    /**
     * @var integer
     *
     * @ORM\Column(name="volume", type="integer", nullable=false)
     */
    private $volume = '50';

    /**
     * @var integer
     *
     * @ORM\Column(name="playback_buffer_bytes", type="integer", nullable=false)
     */
    private $playbackBufferBytes = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="playback_buffer_size", type="integer", nullable=false)
     */
    private $playbackBufferSize = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="audio_out", type="integer", nullable=false)
     */
    private $audioOut = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=50, nullable=false)
     */
    private $mac;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=20, nullable=true)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="ls", type="string", length=20, nullable=true)
     */
    private $ls;

    /**
     * @var string
     *
     * @ORM\Column(name="ver", type="string", length=300, nullable=true)
     */
    private $ver;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=50, nullable=true)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=30, nullable=false)
     */
    private $locale = 'en_GB.utf8';

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer", nullable=true)
     */
    private $cityId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="hd", type="integer", nullable=false)
     */
    private $hd = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="main_notify", type="integer", nullable=false)
     */
    private $mainNotify = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="fav_itv_on", type="integer", nullable=false)
     */
    private $favItvOn = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="now_playing_start", type="integer", nullable=true)
     */
    private $nowPlayingStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="now_playing_type", type="integer", nullable=false)
     */
    private $nowPlayingType = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="now_playing_content", type="string", length=50, nullable=true)
     */
    private $nowPlayingContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="time_last_play_tv", type="integer", nullable=true)
     */
    private $timeLastPlayTv;

    /**
     * @var integer
     *
     * @ORM\Column(name="time_last_play_video", type="integer", nullable=true)
     */
    private $timeLastPlayVideo;

    /**
     * @var integer
     *
     * @ORM\Column(name="hd_content", type="integer", nullable=false)
     */
    private $hdContent = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="image_version", type="string", length=350, nullable=true)
     */
    private $imageVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_change_status", type="integer", nullable=true)
     */
    private $lastChangeStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_start", type="integer", nullable=true)
     */
    private $lastStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_active", type="integer", nullable=true)
     */
    private $lastActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="keep_alive", type="integer", nullable=true)
     */
    private $keepAlive;

    /**
     * @var integer
     *
     * @ORM\Column(name="playback_limit", type="integer", nullable=false)
     */
    private $playbackLimit = '3';

    /**
     * @var integer
     *
     * @ORM\Column(name="screensaver_delay", type="integer", nullable=false)
     */
    private $screensaverDelay = '10';

    /**
     * @var string
     *
     * @ORM\Column(name="stb_type", type="string", length=20, nullable=false)
     */
    private $stbType;

    /**
     * @var string
     *
     * @ORM\Column(name="sn", type="string", length=255, nullable=true)
     */
    private $sn;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_watchdog", type="integer", nullable=true)
     */
    private $lastWatchdog;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=5, nullable=true)
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="plasma_saving", type="integer", nullable=false)
     */
    private $plasmaSaving = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ts_enabled", type="integer", nullable=true)
     */
    private $tsEnabled = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ts_enable_icon", type="integer", nullable=false)
     */
    private $tsEnableIcon = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ts_path", type="string", length=35, nullable=true)
     */
    private $tsPath;

    /**
     * @var integer
     *
     * @ORM\Column(name="ts_max_length", type="integer", nullable=false)
     */
    private $tsMaxLength = '3600';

    /**
     * @var string
     *
     * @ORM\Column(name="ts_buffer_use", type="string", length=15, nullable=false)
     */
    private $tsBufferUse = 'cyclic';

    /**
     * @var string
     *
     * @ORM\Column(name="ts_action_on_exit", type="string", length=20, nullable=false)
     */
    private $tsActionOnExit = 'no_save';

    /**
     * @var string
     *
     * @ORM\Column(name="ts_delay", type="string", length=20, nullable=false)
     */
    private $tsDelay = 'on_pause';

    /**
     * @var string
     *
     * @ORM\Column(name="video_clock", type="string", length=10, nullable=false)
     */
    private $videoClock = 'Off';

    /**
     * @var integer
     *
     * @ORM\Column(name="rtsp_type", type="integer", nullable=false)
     */
    private $rtspType = '4';

    /**
     * @var integer
     *
     * @ORM\Column(name="rtsp_flags", type="integer", nullable=false)
     */
    private $rtspFlags = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="stb_lang", type="string", length=15, nullable=false)
     */
    private $stbLang = 'en';

    /**
     * @var integer
     *
     * @ORM\Column(name="display_menu_after_loading", type="integer", nullable=false)
     */
    private $displayMenuAfterLoading = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="record_max_length", type="integer", nullable=false)
     */
    private $recordMaxLength = '180';

    /**
     * @var integer
     *
     * @ORM\Column(name="plasma_saving_timeout", type="integer", nullable=false)
     */
    private $plasmaSavingTimeout = '600';

    /**
     * @var integer
     *
     * @ORM\Column(name="now_playing_link_id", type="integer", nullable=true)
     */
    private $nowPlayingLinkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="now_playing_streamer_id", type="integer", nullable=true)
     */
    private $nowPlayingStreamerId;

    /**
     * @var string
     *
     * @ORM\Column(name="device_id", type="string", length=255, nullable=true)
     */
    private $deviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="device_id2", type="string", length=255, nullable=true)
     */
    private $deviceId2;

    /**
     * @var string
     *
     * @ORM\Column(name="hw_version", type="string", length=255, nullable=true)
     */
    private $hwVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_password", type="string", length=20, nullable=false)
     */
    private $parentPassword = '0000';

    /**
     * @var integer
     *
     * @ORM\Column(name="spdif_mode", type="integer", nullable=false)
     */
    private $spdifMode = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="show_after_loading", type="string", length=60, nullable=false)
     */
    private $showAfterLoading = 'main_menu';

    /**
     * @var integer
     *
     * @ORM\Column(name="play_in_preview_by_ok", type="integer", nullable=false)
     */
    private $playInPreviewByOk = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="hdmi_event_reaction", type="integer", nullable=false)
     */
    private $hdmiEventReaction = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="mag_player", type="string", length=20, nullable=true)
     */
    private $magPlayer = 'ffmpeg';

    /**
     * @var string
     *
     * @ORM\Column(name="play_in_preview_only_by_ok", type="string", length=10, nullable=false)
     */
    private $playInPreviewOnlyByOk = 'true';

    /**
     * @var string
     *
     * @ORM\Column(name="fav_channels", type="text", length=16777215, nullable=false)
     */
    private $favChannels;

    /**
     * @var string
     *
     * @ORM\Column(name="tv_archive_continued", type="text", length=16777215, nullable=false)
     */
    private $tvArchiveContinued;

    /**
     * @var string
     *
     * @ORM\Column(name="tv_channel_default_aspect", type="string", length=255, nullable=false)
     */
    private $tvChannelDefaultAspect = 'stretch';

    /**
     * @var integer
     *
     * @ORM\Column(name="last_itv_id", type="integer", nullable=false)
     */
    private $lastItvId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="units", type="string", length=20, nullable=true)
     */
    private $units = 'metric';

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=32, nullable=true)
     */
    private $token = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="lock_device", type="boolean", nullable=false)
     */
    private $lockDevice = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="watchdog_timeout", type="integer", nullable=false)
     */
    private $watchdogTimeout;

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
     * Get magId
     *
     * @return integer
     */
    public function getMagId()
    {
        return $this->magId;
    }

    /**
     * Set bright
     *
     * @param integer $bright
     *
     * @return MagDevices
     */
    public function setBright($bright)
    {
        $this->bright = $bright;

        return $this;
    }

    /**
     * Get bright
     *
     * @return integer
     */
    public function getBright()
    {
        return $this->bright;
    }

    /**
     * Set contrast
     *
     * @param integer $contrast
     *
     * @return MagDevices
     */
    public function setContrast($contrast)
    {
        $this->contrast = $contrast;

        return $this;
    }

    /**
     * Get contrast
     *
     * @return integer
     */
    public function getContrast()
    {
        return $this->contrast;
    }

    /**
     * Set saturation
     *
     * @param integer $saturation
     *
     * @return MagDevices
     */
    public function setSaturation($saturation)
    {
        $this->saturation = $saturation;

        return $this;
    }

    /**
     * Get saturation
     *
     * @return integer
     */
    public function getSaturation()
    {
        return $this->saturation;
    }

    /**
     * Set aspect
     *
     * @param string $aspect
     *
     * @return MagDevices
     */
    public function setAspect($aspect)
    {
        $this->aspect = $aspect;

        return $this;
    }

    /**
     * Get aspect
     *
     * @return string
     */
    public function getAspect()
    {
        return $this->aspect;
    }

    /**
     * Set videoOut
     *
     * @param string $videoOut
     *
     * @return MagDevices
     */
    public function setVideoOut($videoOut)
    {
        $this->videoOut = $videoOut;

        return $this;
    }

    /**
     * Get videoOut
     *
     * @return string
     */
    public function getVideoOut()
    {
        return $this->videoOut;
    }

    /**
     * Set volume
     *
     * @param integer $volume
     *
     * @return MagDevices
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return integer
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set playbackBufferBytes
     *
     * @param integer $playbackBufferBytes
     *
     * @return MagDevices
     */
    public function setPlaybackBufferBytes($playbackBufferBytes)
    {
        $this->playbackBufferBytes = $playbackBufferBytes;

        return $this;
    }

    /**
     * Get playbackBufferBytes
     *
     * @return integer
     */
    public function getPlaybackBufferBytes()
    {
        return $this->playbackBufferBytes;
    }

    /**
     * Set playbackBufferSize
     *
     * @param integer $playbackBufferSize
     *
     * @return MagDevices
     */
    public function setPlaybackBufferSize($playbackBufferSize)
    {
        $this->playbackBufferSize = $playbackBufferSize;

        return $this;
    }

    /**
     * Get playbackBufferSize
     *
     * @return integer
     */
    public function getPlaybackBufferSize()
    {
        return $this->playbackBufferSize;
    }

    /**
     * Set audioOut
     *
     * @param integer $audioOut
     *
     * @return MagDevices
     */
    public function setAudioOut($audioOut)
    {
        $this->audioOut = $audioOut;

        return $this;
    }

    /**
     * Get audioOut
     *
     * @return integer
     */
    public function getAudioOut()
    {
        return $this->audioOut;
    }

    /**
     * Set mac
     *
     * @param string $mac
     *
     * @return MagDevices
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
     * Set ip
     *
     * @param string $ip
     *
     * @return MagDevices
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set ls
     *
     * @param string $ls
     *
     * @return MagDevices
     */
    public function setLs($ls)
    {
        $this->ls = $ls;

        return $this;
    }

    /**
     * Get ls
     *
     * @return string
     */
    public function getLs()
    {
        return $this->ls;
    }

    /**
     * Set ver
     *
     * @param string $ver
     *
     * @return MagDevices
     */
    public function setVer($ver)
    {
        $this->ver = $ver;

        return $this;
    }

    /**
     * Get ver
     *
     * @return string
     */
    public function getVer()
    {
        return $this->ver;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return MagDevices
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return MagDevices
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     *
     * @return MagDevices
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set hd
     *
     * @param integer $hd
     *
     * @return MagDevices
     */
    public function setHd($hd)
    {
        $this->hd = $hd;

        return $this;
    }

    /**
     * Get hd
     *
     * @return integer
     */
    public function getHd()
    {
        return $this->hd;
    }

    /**
     * Set mainNotify
     *
     * @param integer $mainNotify
     *
     * @return MagDevices
     */
    public function setMainNotify($mainNotify)
    {
        $this->mainNotify = $mainNotify;

        return $this;
    }

    /**
     * Get mainNotify
     *
     * @return integer
     */
    public function getMainNotify()
    {
        return $this->mainNotify;
    }

    /**
     * Set favItvOn
     *
     * @param integer $favItvOn
     *
     * @return MagDevices
     */
    public function setFavItvOn($favItvOn)
    {
        $this->favItvOn = $favItvOn;

        return $this;
    }

    /**
     * Get favItvOn
     *
     * @return integer
     */
    public function getFavItvOn()
    {
        return $this->favItvOn;
    }

    /**
     * Set nowPlayingStart
     *
     * @param integer $nowPlayingStart
     *
     * @return MagDevices
     */
    public function setNowPlayingStart($nowPlayingStart)
    {
        $this->nowPlayingStart = $nowPlayingStart;

        return $this;
    }

    /**
     * Get nowPlayingStart
     *
     * @return integer
     */
    public function getNowPlayingStart()
    {
        return $this->nowPlayingStart;
    }

    /**
     * Set nowPlayingType
     *
     * @param integer $nowPlayingType
     *
     * @return MagDevices
     */
    public function setNowPlayingType($nowPlayingType)
    {
        $this->nowPlayingType = $nowPlayingType;

        return $this;
    }

    /**
     * Get nowPlayingType
     *
     * @return integer
     */
    public function getNowPlayingType()
    {
        return $this->nowPlayingType;
    }

    /**
     * Set nowPlayingContent
     *
     * @param string $nowPlayingContent
     *
     * @return MagDevices
     */
    public function setNowPlayingContent($nowPlayingContent)
    {
        $this->nowPlayingContent = $nowPlayingContent;

        return $this;
    }

    /**
     * Get nowPlayingContent
     *
     * @return string
     */
    public function getNowPlayingContent()
    {
        return $this->nowPlayingContent;
    }

    /**
     * Set timeLastPlayTv
     *
     * @param integer $timeLastPlayTv
     *
     * @return MagDevices
     */
    public function setTimeLastPlayTv($timeLastPlayTv)
    {
        $this->timeLastPlayTv = $timeLastPlayTv;

        return $this;
    }

    /**
     * Get timeLastPlayTv
     *
     * @return integer
     */
    public function getTimeLastPlayTv()
    {
        return $this->timeLastPlayTv;
    }

    /**
     * Set timeLastPlayVideo
     *
     * @param integer $timeLastPlayVideo
     *
     * @return MagDevices
     */
    public function setTimeLastPlayVideo($timeLastPlayVideo)
    {
        $this->timeLastPlayVideo = $timeLastPlayVideo;

        return $this;
    }

    /**
     * Get timeLastPlayVideo
     *
     * @return integer
     */
    public function getTimeLastPlayVideo()
    {
        return $this->timeLastPlayVideo;
    }

    /**
     * Set hdContent
     *
     * @param integer $hdContent
     *
     * @return MagDevices
     */
    public function setHdContent($hdContent)
    {
        $this->hdContent = $hdContent;

        return $this;
    }

    /**
     * Get hdContent
     *
     * @return integer
     */
    public function getHdContent()
    {
        return $this->hdContent;
    }

    /**
     * Set imageVersion
     *
     * @param string $imageVersion
     *
     * @return MagDevices
     */
    public function setImageVersion($imageVersion)
    {
        $this->imageVersion = $imageVersion;

        return $this;
    }

    /**
     * Get imageVersion
     *
     * @return string
     */
    public function getImageVersion()
    {
        return $this->imageVersion;
    }

    /**
     * Set lastChangeStatus
     *
     * @param integer $lastChangeStatus
     *
     * @return MagDevices
     */
    public function setLastChangeStatus($lastChangeStatus)
    {
        $this->lastChangeStatus = $lastChangeStatus;

        return $this;
    }

    /**
     * Get lastChangeStatus
     *
     * @return integer
     */
    public function getLastChangeStatus()
    {
        return $this->lastChangeStatus;
    }

    /**
     * Set lastStart
     *
     * @param integer $lastStart
     *
     * @return MagDevices
     */
    public function setLastStart($lastStart)
    {
        $this->lastStart = $lastStart;

        return $this;
    }

    /**
     * Get lastStart
     *
     * @return integer
     */
    public function getLastStart()
    {
        return $this->lastStart;
    }

    /**
     * Set lastActive
     *
     * @param integer $lastActive
     *
     * @return MagDevices
     */
    public function setLastActive($lastActive)
    {
        $this->lastActive = $lastActive;

        return $this;
    }

    /**
     * Get lastActive
     *
     * @return integer
     */
    public function getLastActive()
    {
        return $this->lastActive;
    }

    /**
     * Set keepAlive
     *
     * @param integer $keepAlive
     *
     * @return MagDevices
     */
    public function setKeepAlive($keepAlive)
    {
        $this->keepAlive = $keepAlive;

        return $this;
    }

    /**
     * Get keepAlive
     *
     * @return integer
     */
    public function getKeepAlive()
    {
        return $this->keepAlive;
    }

    /**
     * Set playbackLimit
     *
     * @param integer $playbackLimit
     *
     * @return MagDevices
     */
    public function setPlaybackLimit($playbackLimit)
    {
        $this->playbackLimit = $playbackLimit;

        return $this;
    }

    /**
     * Get playbackLimit
     *
     * @return integer
     */
    public function getPlaybackLimit()
    {
        return $this->playbackLimit;
    }

    /**
     * Set screensaverDelay
     *
     * @param integer $screensaverDelay
     *
     * @return MagDevices
     */
    public function setScreensaverDelay($screensaverDelay)
    {
        $this->screensaverDelay = $screensaverDelay;

        return $this;
    }

    /**
     * Get screensaverDelay
     *
     * @return integer
     */
    public function getScreensaverDelay()
    {
        return $this->screensaverDelay;
    }

    /**
     * Set stbType
     *
     * @param string $stbType
     *
     * @return MagDevices
     */
    public function setStbType($stbType)
    {
        $this->stbType = $stbType;

        return $this;
    }

    /**
     * Get stbType
     *
     * @return string
     */
    public function getStbType()
    {
        return $this->stbType;
    }

    /**
     * Set sn
     *
     * @param string $sn
     *
     * @return MagDevices
     */
    public function setSn($sn)
    {
        $this->sn = $sn;

        return $this;
    }

    /**
     * Get sn
     *
     * @return string
     */
    public function getSn()
    {
        return $this->sn;
    }

    /**
     * Set lastWatchdog
     *
     * @param integer $lastWatchdog
     *
     * @return MagDevices
     */
    public function setLastWatchdog($lastWatchdog)
    {
        $this->lastWatchdog = $lastWatchdog;

        return $this;
    }

    /**
     * Get lastWatchdog
     *
     * @return integer
     */
    public function getLastWatchdog()
    {
        return $this->lastWatchdog;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return MagDevices
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return MagDevices
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set plasmaSaving
     *
     * @param integer $plasmaSaving
     *
     * @return MagDevices
     */
    public function setPlasmaSaving($plasmaSaving)
    {
        $this->plasmaSaving = $plasmaSaving;

        return $this;
    }

    /**
     * Get plasmaSaving
     *
     * @return integer
     */
    public function getPlasmaSaving()
    {
        return $this->plasmaSaving;
    }

    /**
     * Set tsEnabled
     *
     * @param integer $tsEnabled
     *
     * @return MagDevices
     */
    public function setTsEnabled($tsEnabled)
    {
        $this->tsEnabled = $tsEnabled;

        return $this;
    }

    /**
     * Get tsEnabled
     *
     * @return integer
     */
    public function getTsEnabled()
    {
        return $this->tsEnabled;
    }

    /**
     * Set tsEnableIcon
     *
     * @param integer $tsEnableIcon
     *
     * @return MagDevices
     */
    public function setTsEnableIcon($tsEnableIcon)
    {
        $this->tsEnableIcon = $tsEnableIcon;

        return $this;
    }

    /**
     * Get tsEnableIcon
     *
     * @return integer
     */
    public function getTsEnableIcon()
    {
        return $this->tsEnableIcon;
    }

    /**
     * Set tsPath
     *
     * @param string $tsPath
     *
     * @return MagDevices
     */
    public function setTsPath($tsPath)
    {
        $this->tsPath = $tsPath;

        return $this;
    }

    /**
     * Get tsPath
     *
     * @return string
     */
    public function getTsPath()
    {
        return $this->tsPath;
    }

    /**
     * Set tsMaxLength
     *
     * @param integer $tsMaxLength
     *
     * @return MagDevices
     */
    public function setTsMaxLength($tsMaxLength)
    {
        $this->tsMaxLength = $tsMaxLength;

        return $this;
    }

    /**
     * Get tsMaxLength
     *
     * @return integer
     */
    public function getTsMaxLength()
    {
        return $this->tsMaxLength;
    }

    /**
     * Set tsBufferUse
     *
     * @param string $tsBufferUse
     *
     * @return MagDevices
     */
    public function setTsBufferUse($tsBufferUse)
    {
        $this->tsBufferUse = $tsBufferUse;

        return $this;
    }

    /**
     * Get tsBufferUse
     *
     * @return string
     */
    public function getTsBufferUse()
    {
        return $this->tsBufferUse;
    }

    /**
     * Set tsActionOnExit
     *
     * @param string $tsActionOnExit
     *
     * @return MagDevices
     */
    public function setTsActionOnExit($tsActionOnExit)
    {
        $this->tsActionOnExit = $tsActionOnExit;

        return $this;
    }

    /**
     * Get tsActionOnExit
     *
     * @return string
     */
    public function getTsActionOnExit()
    {
        return $this->tsActionOnExit;
    }

    /**
     * Set tsDelay
     *
     * @param string $tsDelay
     *
     * @return MagDevices
     */
    public function setTsDelay($tsDelay)
    {
        $this->tsDelay = $tsDelay;

        return $this;
    }

    /**
     * Get tsDelay
     *
     * @return string
     */
    public function getTsDelay()
    {
        return $this->tsDelay;
    }

    /**
     * Set videoClock
     *
     * @param string $videoClock
     *
     * @return MagDevices
     */
    public function setVideoClock($videoClock)
    {
        $this->videoClock = $videoClock;

        return $this;
    }

    /**
     * Get videoClock
     *
     * @return string
     */
    public function getVideoClock()
    {
        return $this->videoClock;
    }

    /**
     * Set rtspType
     *
     * @param integer $rtspType
     *
     * @return MagDevices
     */
    public function setRtspType($rtspType)
    {
        $this->rtspType = $rtspType;

        return $this;
    }

    /**
     * Get rtspType
     *
     * @return integer
     */
    public function getRtspType()
    {
        return $this->rtspType;
    }

    /**
     * Set rtspFlags
     *
     * @param integer $rtspFlags
     *
     * @return MagDevices
     */
    public function setRtspFlags($rtspFlags)
    {
        $this->rtspFlags = $rtspFlags;

        return $this;
    }

    /**
     * Get rtspFlags
     *
     * @return integer
     */
    public function getRtspFlags()
    {
        return $this->rtspFlags;
    }

    /**
     * Set stbLang
     *
     * @param string $stbLang
     *
     * @return MagDevices
     */
    public function setStbLang($stbLang)
    {
        $this->stbLang = $stbLang;

        return $this;
    }

    /**
     * Get stbLang
     *
     * @return string
     */
    public function getStbLang()
    {
        return $this->stbLang;
    }

    /**
     * Set displayMenuAfterLoading
     *
     * @param integer $displayMenuAfterLoading
     *
     * @return MagDevices
     */
    public function setDisplayMenuAfterLoading($displayMenuAfterLoading)
    {
        $this->displayMenuAfterLoading = $displayMenuAfterLoading;

        return $this;
    }

    /**
     * Get displayMenuAfterLoading
     *
     * @return integer
     */
    public function getDisplayMenuAfterLoading()
    {
        return $this->displayMenuAfterLoading;
    }

    /**
     * Set recordMaxLength
     *
     * @param integer $recordMaxLength
     *
     * @return MagDevices
     */
    public function setRecordMaxLength($recordMaxLength)
    {
        $this->recordMaxLength = $recordMaxLength;

        return $this;
    }

    /**
     * Get recordMaxLength
     *
     * @return integer
     */
    public function getRecordMaxLength()
    {
        return $this->recordMaxLength;
    }

    /**
     * Set plasmaSavingTimeout
     *
     * @param integer $plasmaSavingTimeout
     *
     * @return MagDevices
     */
    public function setPlasmaSavingTimeout($plasmaSavingTimeout)
    {
        $this->plasmaSavingTimeout = $plasmaSavingTimeout;

        return $this;
    }

    /**
     * Get plasmaSavingTimeout
     *
     * @return integer
     */
    public function getPlasmaSavingTimeout()
    {
        return $this->plasmaSavingTimeout;
    }

    /**
     * Set nowPlayingLinkId
     *
     * @param integer $nowPlayingLinkId
     *
     * @return MagDevices
     */
    public function setNowPlayingLinkId($nowPlayingLinkId)
    {
        $this->nowPlayingLinkId = $nowPlayingLinkId;

        return $this;
    }

    /**
     * Get nowPlayingLinkId
     *
     * @return integer
     */
    public function getNowPlayingLinkId()
    {
        return $this->nowPlayingLinkId;
    }

    /**
     * Set nowPlayingStreamerId
     *
     * @param integer $nowPlayingStreamerId
     *
     * @return MagDevices
     */
    public function setNowPlayingStreamerId($nowPlayingStreamerId)
    {
        $this->nowPlayingStreamerId = $nowPlayingStreamerId;

        return $this;
    }

    /**
     * Get nowPlayingStreamerId
     *
     * @return integer
     */
    public function getNowPlayingStreamerId()
    {
        return $this->nowPlayingStreamerId;
    }

    /**
     * Set deviceId
     *
     * @param string $deviceId
     *
     * @return MagDevices
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * Get deviceId
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * Set deviceId2
     *
     * @param string $deviceId2
     *
     * @return MagDevices
     */
    public function setDeviceId2($deviceId2)
    {
        $this->deviceId2 = $deviceId2;

        return $this;
    }

    /**
     * Get deviceId2
     *
     * @return string
     */
    public function getDeviceId2()
    {
        return $this->deviceId2;
    }

    /**
     * Set hwVersion
     *
     * @param string $hwVersion
     *
     * @return MagDevices
     */
    public function setHwVersion($hwVersion)
    {
        $this->hwVersion = $hwVersion;

        return $this;
    }

    /**
     * Get hwVersion
     *
     * @return string
     */
    public function getHwVersion()
    {
        return $this->hwVersion;
    }

    /**
     * Set parentPassword
     *
     * @param string $parentPassword
     *
     * @return MagDevices
     */
    public function setParentPassword($parentPassword)
    {
        $this->parentPassword = $parentPassword;

        return $this;
    }

    /**
     * Get parentPassword
     *
     * @return string
     */
    public function getParentPassword()
    {
        return $this->parentPassword;
    }

    /**
     * Set spdifMode
     *
     * @param integer $spdifMode
     *
     * @return MagDevices
     */
    public function setSpdifMode($spdifMode)
    {
        $this->spdifMode = $spdifMode;

        return $this;
    }

    /**
     * Get spdifMode
     *
     * @return integer
     */
    public function getSpdifMode()
    {
        return $this->spdifMode;
    }

    /**
     * Set showAfterLoading
     *
     * @param string $showAfterLoading
     *
     * @return MagDevices
     */
    public function setShowAfterLoading($showAfterLoading)
    {
        $this->showAfterLoading = $showAfterLoading;

        return $this;
    }

    /**
     * Get showAfterLoading
     *
     * @return string
     */
    public function getShowAfterLoading()
    {
        return $this->showAfterLoading;
    }

    /**
     * Set playInPreviewByOk
     *
     * @param integer $playInPreviewByOk
     *
     * @return MagDevices
     */
    public function setPlayInPreviewByOk($playInPreviewByOk)
    {
        $this->playInPreviewByOk = $playInPreviewByOk;

        return $this;
    }

    /**
     * Get playInPreviewByOk
     *
     * @return integer
     */
    public function getPlayInPreviewByOk()
    {
        return $this->playInPreviewByOk;
    }

    /**
     * Set hdmiEventReaction
     *
     * @param integer $hdmiEventReaction
     *
     * @return MagDevices
     */
    public function setHdmiEventReaction($hdmiEventReaction)
    {
        $this->hdmiEventReaction = $hdmiEventReaction;

        return $this;
    }

    /**
     * Get hdmiEventReaction
     *
     * @return integer
     */
    public function getHdmiEventReaction()
    {
        return $this->hdmiEventReaction;
    }

    /**
     * Set magPlayer
     *
     * @param string $magPlayer
     *
     * @return MagDevices
     */
    public function setMagPlayer($magPlayer)
    {
        $this->magPlayer = $magPlayer;

        return $this;
    }

    /**
     * Get magPlayer
     *
     * @return string
     */
    public function getMagPlayer()
    {
        return $this->magPlayer;
    }

    /**
     * Set playInPreviewOnlyByOk
     *
     * @param string $playInPreviewOnlyByOk
     *
     * @return MagDevices
     */
    public function setPlayInPreviewOnlyByOk($playInPreviewOnlyByOk)
    {
        $this->playInPreviewOnlyByOk = $playInPreviewOnlyByOk;

        return $this;
    }

    /**
     * Get playInPreviewOnlyByOk
     *
     * @return string
     */
    public function getPlayInPreviewOnlyByOk()
    {
        return $this->playInPreviewOnlyByOk;
    }

    /**
     * Set favChannels
     *
     * @param string $favChannels
     *
     * @return MagDevices
     */
    public function setFavChannels($favChannels)
    {
        $this->favChannels = $favChannels;

        return $this;
    }

    /**
     * Get favChannels
     *
     * @return string
     */
    public function getFavChannels()
    {
        return $this->favChannels;
    }

    /**
     * Set tvArchiveContinued
     *
     * @param string $tvArchiveContinued
     *
     * @return MagDevices
     */
    public function setTvArchiveContinued($tvArchiveContinued)
    {
        $this->tvArchiveContinued = $tvArchiveContinued;

        return $this;
    }

    /**
     * Get tvArchiveContinued
     *
     * @return string
     */
    public function getTvArchiveContinued()
    {
        return $this->tvArchiveContinued;
    }

    /**
     * Set tvChannelDefaultAspect
     *
     * @param string $tvChannelDefaultAspect
     *
     * @return MagDevices
     */
    public function setTvChannelDefaultAspect($tvChannelDefaultAspect)
    {
        $this->tvChannelDefaultAspect = $tvChannelDefaultAspect;

        return $this;
    }

    /**
     * Get tvChannelDefaultAspect
     *
     * @return string
     */
    public function getTvChannelDefaultAspect()
    {
        return $this->tvChannelDefaultAspect;
    }

    /**
     * Set lastItvId
     *
     * @param integer $lastItvId
     *
     * @return MagDevices
     */
    public function setLastItvId($lastItvId)
    {
        $this->lastItvId = $lastItvId;

        return $this;
    }

    /**
     * Get lastItvId
     *
     * @return integer
     */
    public function getLastItvId()
    {
        return $this->lastItvId;
    }

    /**
     * Set units
     *
     * @param string $units
     *
     * @return MagDevices
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }

    /**
     * Get units
     *
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return MagDevices
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
     * Set lockDevice
     *
     * @param boolean $lockDevice
     *
     * @return MagDevices
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
     * Set watchdogTimeout
     *
     * @param integer $watchdogTimeout
     *
     * @return MagDevices
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
     * Set user
     *
     * @param \Dmcl\AppBundle\Entity\Users $user
     *
     * @return MagDevices
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
