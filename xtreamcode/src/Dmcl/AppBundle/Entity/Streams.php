<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Streams
 *
 * @ORM\Table(name="streams", indexes={@ORM\Index(name="type", columns={"type"}), @ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="created_channel_location", columns={"created_channel_location"}), @ORM\Index(name="enable_transcode", columns={"enable_transcode"}), @ORM\Index(name="read_native", columns={"read_native"}), @ORM\Index(name="epg_id", columns={"epg_id"}), @ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="transcode_profile_id", columns={"transcode_profile_id"}), @ORM\Index(name="order", columns={"order"}), @ORM\Index(name="direct_source", columns={"direct_source"}), @ORM\Index(name="rtmp_output", columns={"rtmp_output"})})
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\StreamsRepository")
 */
class Streams
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
     * @ORM\Column(name="stream_display_name", type="text", length=255, nullable=false)
     */
    private $streamDisplayName;

    /**
     * @var string
     *
     * @ORM\Column(name="stream_source", type="text", length=16777215, nullable=true)
     */
    private $streamSource;

    /**
     * @var string
     *
     * @ORM\Column(name="stream_icon", type="text", length=16777215, nullable=false)
     */
    private $streamIcon = '';

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=16777215, nullable=true)
     */
    private $notes = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="created_channel_location", type="integer", nullable=true)
     */
    private $createdChannelLocation = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable_transcode", type="boolean", nullable=false)
     */
    private $enableTranscode = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="transcode_attributes", type="text", length=16777215, nullable=false)
     */
    private $transcodeAttributes = '';

    /**
     * @var string
     *
     * @ORM\Column(name="custom_ffmpeg", type="text", length=16777215, nullable=false)
     */
    private $customFfmpeg = '';

    /**
     * @var string
     *
     * @ORM\Column(name="movie_propeties", type="text", length=16777215, nullable=true)
     */
    private $moviePropeties = '';

    /**
     * @var string
     *
     * @ORM\Column(name="movie_subtitles", type="text", length=16777215, nullable=false)
     */
    private $movieSubtitles = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="read_native", type="boolean", nullable=false)
     */
    private $readNative = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="target_container", type="text", length=65535, nullable=true)
     */
    private $targetContainer = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="stream_all", type="boolean", nullable=false)
     */
    private $streamAll = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="remove_subtitles", type="boolean", nullable=false)
     */
    private $removeSubtitles = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="custom_sid", type="string", length=150, nullable=true)
     */
    private $customSid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="channel_id", type="string", length=255, nullable=true)
     */
    private $channelId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="epg_lang", type="string", length=255, nullable=true)
     */
    private $epgLang = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="`order`", type="integer", nullable=false)
     */
    private $order = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="auto_restart", type="text", length=65535, nullable=false)
     */
    private $autoRestart = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pids_create_channel", type="text", length=16777215, nullable=false)
     */
    private $pidsCreateChannel = '';

    /**
     * @var string
     *
     * @ORM\Column(name="cchannel_rsources", type="text", length=16777215, nullable=false)
     */
    private $cchannelRsources = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="gen_timestamps", type="boolean", nullable=false)
     */
    private $genTimestamps = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="added", type="integer", nullable=false)
     */
    private $added = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="series_no", type="integer", nullable=false)
     */
    private $seriesNo = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="direct_source", type="boolean", nullable=false)
     */
    private $directSource = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tv_archive_duration", type="integer", nullable=false)
     */
    private $tvArchiveDuration = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tv_archive_server_id", type="integer", nullable=false)
     */
    private $tvArchiveServerId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tv_archive_pid", type="integer", nullable=false)
     */
    private $tvArchivePid = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="movie_symlink", type="boolean", nullable=false)
     */
    private $movieSymlink = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="redirect_stream", type="boolean", nullable=false)
     */
    private $redirectStream = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rtmp_output", type="boolean", nullable=false)
     */
    private $rtmpOutput = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_record", type="boolean", nullable=false)
     */
    private $allowRecord = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="probesize_ondemand", type="integer", nullable=false)
     */
    private $probesizeOndemand = '512000';

    /**
     * @var string
     *
     * @ORM\Column(name="custom_map", type="text", length=65535, nullable=false)
     */
    private $customMap = '';

    /**
     * @var string
     *
     * @ORM\Column(name="external_push", type="text", length=16777215, nullable=false)
     */
    private $externalPush = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="delay_minutes", type="integer", nullable=false)
     */
    private $delayMinutes = '0';

    /**
     *
     * @ORM\ManyToOne(targetEntity="StreamCategories", inversedBy="streams")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     */
    private $category;
//$conn->getDatabasePlatform()->setUseBooleanTrueFalseStrings($flag).
    /**
     * @var integer
     *
     * @ORM\Column(name="epg_id", type="integer", nullable=true)
     */
    private $epg_id = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="transcode_profile_id", type="integer", nullable=true)
     */
    private $transcode_profile_id = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type = '';

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
     * Set streamDisplayName
     *
     * @param string $streamDisplayName
     *
     * @return Streams
     */
    public function setStreamDisplayName($streamDisplayName)
    {
        $this->streamDisplayName = $streamDisplayName;

        return $this;
    }

    /**
     * Get streamDisplayName
     *
     * @return string
     */
    public function getStreamDisplayName()
    {
        return $this->streamDisplayName;
    }

    /**
     * Set streamSource
     *
     * @param string $streamSource
     *
     * @return Streams
     */
    public function setStreamSource($streamSource)
    {
        $this->streamSource = $streamSource;

        return $this;
    }

    /**
     * Get streamSource
     *
     * @return string
     */
    public function getStreamSource()
    {
        $source = "";

        if($this->streamSource)
            $source = json_decode($this->streamSource);

        if(is_array($source))
            $source = $source[0];
        
        return $source;
    }

    /**
     * Set streamIcon
     *
     * @param string $streamIcon
     *
     * @return Streams
     */
    public function setStreamIcon($streamIcon)
    {
        $this->streamIcon = $streamIcon;

        return $this;
    }

    /**
     * Get streamIcon
     *
     * @return string
     */
    public function getStreamIcon()
    {
        return $this->streamIcon;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Streams
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set createdChannelLocation
     *
     * @param integer $createdChannelLocation
     *
     * @return Streams
     */
    public function setCreatedChannelLocation($createdChannelLocation)
    {
        $this->createdChannelLocation = $createdChannelLocation;

        return $this;
    }

    /**
     * Get createdChannelLocation
     *
     * @return integer
     */
    public function getCreatedChannelLocation()
    {
        return $this->createdChannelLocation;
    }

    /**
     * Set enableTranscode
     *
     * @param boolean $enableTranscode
     *
     * @return Streams
     */
    public function setEnableTranscode($enableTranscode)
    {
        $this->enableTranscode = $enableTranscode;

        return $this;
    }

    /**
     * Get enableTranscode
     *
     * @return boolean
     */
    public function getEnableTranscode()
    {
        return $this->enableTranscode;
    }

    /**
     * Set transcodeAttributes
     *
     * @param string $transcodeAttributes
     *
     * @return Streams
     */
    public function setTranscodeAttributes($transcodeAttributes)
    {
        $this->transcodeAttributes = $transcodeAttributes;

        return $this;
    }

    /**
     * Get transcodeAttributes
     *
     * @return string
     */
    public function getTranscodeAttributes()
    {
        return $this->transcodeAttributes;
    }

    /**
     * Set customFfmpeg
     *
     * @param string $customFfmpeg
     *
     * @return Streams
     */
    public function setCustomFfmpeg($customFfmpeg)
    {
        $this->customFfmpeg = $customFfmpeg;

        return $this;
    }

    /**
     * Get customFfmpeg
     *
     * @return string
     */
    public function getCustomFfmpeg()
    {
        return $this->customFfmpeg;
    }

    /**
     * Set moviePropeties
     *
     * @param string $moviePropeties
     *
     * @return Streams
     */
    public function setMoviePropeties($moviePropeties)
    {
        $this->moviePropeties = $moviePropeties;

        return $this;
    }

    /**
     * Get moviePropeties
     *
     * @return string
     */
    public function getMoviePropeties()
    {
        return $this->moviePropeties;
    }

    /**
     * Set movieSubtitles
     *
     * @param string $movieSubtitles
     *
     * @return Streams
     */
    public function setMovieSubtitles($movieSubtitles)
    {
        $this->movieSubtitles = $movieSubtitles;

        return $this;
    }

    /**
     * Get movieSubtitles
     *
     * @return string
     */
    public function getMovieSubtitles()
    {
        return $this->movieSubtitles;
    }

    /**
     * Set readNative
     *
     * @param boolean $readNative
     *
     * @return Streams
     */
    public function setReadNative($readNative)
    {
        $this->readNative = $readNative;

        return $this;
    }

    /**
     * Get readNative
     *
     * @return boolean
     */
    public function getReadNative()
    {
        return $this->readNative;
    }

    /**
     * Set targetContainer
     *
     * @param string $targetContainer
     *
     * @return Streams
     */
    public function setTargetContainer($targetContainer)
    {
        $this->targetContainer = $targetContainer;

        return $this;
    }

    /**
     * Get targetContainer
     *
     * @return string
     */
    public function getTargetContainer()
    {
        return $this->targetContainer;
    }

    /**
     * Set streamAll
     *
     * @param boolean $streamAll
     *
     * @return Streams
     */
    public function setStreamAll($streamAll)
    {
        $this->streamAll = $streamAll;

        return $this;
    }

    /**
     * Get streamAll
     *
     * @return boolean
     */
    public function getStreamAll()
    {
        return $this->streamAll;
    }

    /**
     * Set removeSubtitles
     *
     * @param boolean $removeSubtitles
     *
     * @return Streams
     */
    public function setRemoveSubtitles($removeSubtitles)
    {
        $this->removeSubtitles = $removeSubtitles;

        return $this;
    }

    /**
     * Get removeSubtitles
     *
     * @return boolean
     */
    public function getRemoveSubtitles()
    {
        return $this->removeSubtitles;
    }

    /**
     * Set customSid
     *
     * @param string $customSid
     *
     * @return Streams
     */
    public function setCustomSid($customSid)
    {
        $this->customSid = $customSid;

        return $this;
    }

    /**
     * Get customSid
     *
     * @return string
     */
    public function getCustomSid()
    {
        return $this->customSid;
    }

    /**
     * Set channelId
     *
     * @param string $channelId
     *
     * @return Streams
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Get channelId
     *
     * @return string
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set epgLang
     *
     * @param string $epgLang
     *
     * @return Streams
     */
    public function setEpgLang($epgLang)
    {
        $this->epgLang = $epgLang;

        return $this;
    }

    /**
     * Get epgLang
     *
     * @return string
     */
    public function getEpgLang()
    {
        return $this->epgLang;
    }

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return Streams
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set autoRestart
     *
     * @param string $autoRestart
     *
     * @return Streams
     */
    public function setAutoRestart($autoRestart)
    {
        $this->autoRestart = $autoRestart;

        return $this;
    }

    /**
     * Get autoRestart
     *
     * @return string
     */
    public function getAutoRestart()
    {
        return $this->autoRestart;
    }

    /**
     * Set pidsCreateChannel
     *
     * @param string $pidsCreateChannel
     *
     * @return Streams
     */
    public function setPidsCreateChannel($pidsCreateChannel)
    {
        $this->pidsCreateChannel = $pidsCreateChannel;

        return $this;
    }

    /**
     * Get pidsCreateChannel
     *
     * @return string
     */
    public function getPidsCreateChannel()
    {
        return $this->pidsCreateChannel;
    }

    /**
     * Set cchannelRsources
     *
     * @param string $cchannelRsources
     *
     * @return Streams
     */
    public function setCchannelRsources($cchannelRsources)
    {
        $this->cchannelRsources = $cchannelRsources;

        return $this;
    }

    /**
     * Get cchannelRsources
     *
     * @return string
     */
    public function getCchannelRsources()
    {
        return $this->cchannelRsources;
    }

    /**
     * Set genTimestamps
     *
     * @param boolean $genTimestamps
     *
     * @return Streams
     */
    public function setGenTimestamps($genTimestamps)
    {
        $this->genTimestamps = $genTimestamps;

        return $this;
    }

    /**
     * Get genTimestamps
     *
     * @return boolean
     */
    public function getGenTimestamps()
    {
        return $this->genTimestamps;
    }

    /**
     * Set added
     *
     * @param integer $added
     *
     * @return Streams
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return integer
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set seriesNo
     *
     * @param integer $seriesNo
     *
     * @return Streams
     */
    public function setSeriesNo($seriesNo)
    {
        $this->seriesNo = $seriesNo;

        return $this;
    }

    /**
     * Get seriesNo
     *
     * @return integer
     */
    public function getSeriesNo()
    {
        return $this->seriesNo;
    }

    /**
     * Set directSource
     *
     * @param boolean $directSource
     *
     * @return Streams
     */
    public function setDirectSource($directSource)
    {
        $this->directSource = $directSource;

        return $this;
    }

    /**
     * Get directSource
     *
     * @return boolean
     */
    public function getDirectSource()
    {
        return $this->directSource;
    }

    /**
     * Set tvArchiveDuration
     *
     * @param integer $tvArchiveDuration
     *
     * @return Streams
     */
    public function setTvArchiveDuration($tvArchiveDuration)
    {
        $this->tvArchiveDuration = $tvArchiveDuration;

        return $this;
    }

    /**
     * Get tvArchiveDuration
     *
     * @return integer
     */
    public function getTvArchiveDuration()
    {
        return $this->tvArchiveDuration;
    }

    /**
     * Set tvArchiveServerId
     *
     * @param integer $tvArchiveServerId
     *
     * @return Streams
     */
    public function setTvArchiveServerId($tvArchiveServerId)
    {
        $this->tvArchiveServerId = $tvArchiveServerId;

        return $this;
    }

    /**
     * Get tvArchiveServerId
     *
     * @return integer
     */
    public function getTvArchiveServerId()
    {
        return $this->tvArchiveServerId;
    }

    /**
     * Set tvArchivePid
     *
     * @param integer $tvArchivePid
     *
     * @return Streams
     */
    public function setTvArchivePid($tvArchivePid)
    {
        $this->tvArchivePid = $tvArchivePid;

        return $this;
    }

    /**
     * Get tvArchivePid
     *
     * @return integer
     */
    public function getTvArchivePid()
    {
        return $this->tvArchivePid;
    }

    /**
     * Set movieSymlink
     *
     * @param boolean $movieSymlink
     *
     * @return Streams
     */
    public function setMovieSymlink($movieSymlink)
    {
        $this->movieSymlink = $movieSymlink;

        return $this;
    }

    /**
     * Get movieSymlink
     *
     * @return boolean
     */
    public function getMovieSymlink()
    {
        return $this->movieSymlink;
    }

    /**
     * Set redirectStream
     *
     * @param boolean $redirectStream
     *
     * @return Streams
     */
    public function setRedirectStream($redirectStream)
    {
        $this->redirectStream = $redirectStream;

        return $this;
    }

    /**
     * Get redirectStream
     *
     * @return boolean
     */
    public function getRedirectStream()
    {
        return $this->redirectStream;
    }

    /**
     * Set rtmpOutput
     *
     * @param boolean $rtmpOutput
     *
     * @return Streams
     */
    public function setRtmpOutput($rtmpOutput)
    {
        $this->rtmpOutput = $rtmpOutput;

        return $this;
    }

    /**
     * Get rtmpOutput
     *
     * @return boolean
     */
    public function getRtmpOutput()
    {
        return $this->rtmpOutput;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Streams
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set allowRecord
     *
     * @param boolean $allowRecord
     *
     * @return Streams
     */
    public function setAllowRecord($allowRecord)
    {
        $this->allowRecord = $allowRecord;

        return $this;
    }

    /**
     * Get allowRecord
     *
     * @return boolean
     */
    public function getAllowRecord()
    {
        return $this->allowRecord;
    }

    /**
     * Set probesizeOndemand
     *
     * @param integer $probesizeOndemand
     *
     * @return Streams
     */
    public function setProbesizeOndemand($probesizeOndemand)
    {
        $this->probesizeOndemand = $probesizeOndemand;

        return $this;
    }

    /**
     * Get probesizeOndemand
     *
     * @return integer
     */
    public function getProbesizeOndemand()
    {
        return $this->probesizeOndemand;
    }

    /**
     * Set customMap
     *
     * @param string $customMap
     *
     * @return Streams
     */
    public function setCustomMap($customMap)
    {
        $this->customMap = $customMap;

        return $this;
    }

    /**
     * Get customMap
     *
     * @return string
     */
    public function getCustomMap()
    {
        return $this->customMap;
    }

    /**
     * Set externalPush
     *
     * @param string $externalPush
     *
     * @return Streams
     */
    public function setExternalPush($externalPush)
    {
        $this->externalPush = $externalPush;

        return $this;
    }

    /**
     * Get externalPush
     *
     * @return string
     */
    public function getExternalPush()
    {
        return $this->externalPush;
    }

    /**
     * Set delayMinutes
     *
     * @param integer $delayMinutes
     *
     * @return Streams
     */
    public function setDelayMinutes($delayMinutes)
    {
        $this->delayMinutes = $delayMinutes;

        return $this;
    }

    /**
     * Get delayMinutes
     *
     * @return integer
     */
    public function getDelayMinutes()
    {
        return $this->delayMinutes;
    }

    /**
     * Set epg_id
     *
     * @param integer $epg_id
     *
     * @return Streams
     */
    public function setEpg($epg_id)
    {
        $this->epg_id = $epg_id;

        return $this;
    }

    /**
     * Get epg_id
     *
     * @return integer
     */
    public function getEpg()
    {
        return $this->epg_id;
    }

    /**
     * Set transcode_profile_id
     *
     * @param integer $transcode_profile_id
     *
     * @return Streams
     */
    public function setTranscodeProfile($transcode_profile_id)
    {
        $this->transcode_profile_id = $transcode_profile_id;

        return $this;
    }

    /**
     * Get transcode_profile_id
     *
     * @return integer
     */
    public function getTranscodeProfile()
    {
        return $this->transcode_profile_id;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Streams
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set category
     *
     * @param StreamCategories $category
     *
     * @return Streams
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return StreamCategories
     */
    public function getCategory()
    {
        return $this->category;
    }

    function __toString()
    {
        return $this->streamDisplayName;
    }
}
