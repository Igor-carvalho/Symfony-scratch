<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\UsersRepository")
 */
class Users
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
     *
     * @ORM\ManyToOne(targetEntity="MemberGroups", inversedBy="usersResellers")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="group_id", nullable=true)
     */
    private $memberGroup;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Dmcl\AppBundle\Entity\RegUsers")
     */
    private $member;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="exp_date", type="integer", nullable=true)
     */
    private $expDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="admin_enabled", type="integer", nullable=false)
     */
    private $adminEnabled = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer", nullable=false)
     */
    private $enabled = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="admin_notes", type="text", length=16777215, nullable=true)
     */
    private $adminNotes = "";

    /**
     * @var string
     *
     * @ORM\Column(name="reseller_notes", type="text", length=16777215, nullable=true)
     */
    private $resellerNotes = "";

    /**
     * @var string
     *
     * @ORM\Column(name="bouquet", type="text", length=16777215, nullable=false)
     */
    private $bouquet;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_connections", type="integer", nullable=false)
     */
    private $maxConnections = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_restreamer", type="boolean", nullable=false)
     */
    private $isRestreamer = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="allowed_ips", type="text", length=16777215, nullable=false)
     */
    private $allowedIps = "";

    /**
     * @var string
     *
     * @ORM\Column(name="allowed_ua", type="text", length=16777215, nullable=false)
     */
    private $allowedUa = "";

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_trial", type="boolean", nullable=false)
     */
    private $isTrial = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="pair_id", type="integer", nullable=true)
     */
    private $pairId = "";

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_mag", type="boolean", nullable=false)
     */
    private $isMag = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_e2", type="boolean", nullable=false)
     */
    private $isE2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="force_server_id", type="integer", nullable=false)
     */
    private $forceServerId = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_isplock", type="boolean", nullable=false)
     */
    private $isIsplock = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="isp_desc", type="text", length=16777215, nullable=true)
     */
    private $ispDesc = "";

    /**
     * @var string
     *
     * @ORM\Column(name="forced_country", type="string", length=3, nullable=false)
     */
    private $forcedCountry = "";

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_stalker", type="boolean", nullable=false)
     */
    private $isStalker = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="bypass_ua", type="boolean", nullable=false)
     */
    private $bypassUa = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="as_number", type="string", length=30, nullable=true)
     */
    private $asNumber = "";

    /**
     *
     * @ORM\ManyToMany(targetEntity="Devices", inversedBy="user")
     * @ORM\JoinTable(name="mag_devices",joinColumns={
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")},inverseJoinColumns={
     * @ORM\JoinColumn(name="mag_id", referencedColumnName="device_id")})
     */
    private $devices;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->devices = new ArrayCollection();

        $username = md5(date('Y-m-d H:i:s'));
        sleep(1);
        $password = md5(date('Y-m-d H:i:s'));

        $this->username = str_split($username, 10)[0];
        $this->password = str_split($password, 10)[0];
        $this->createdAt = new \DateTime('now');
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
     * Set memberId
     *
     * @param integer $member
     *
     * @return Users
     */
    public function setMember($member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get memberId
     *
     * @return integer
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set expDate
     *
     * @param integer $expDate
     *
     * @return Users
     */
    public function setExpDate($expDate)
    {
        $this->expDate = $expDate;

        return $this;
    }

    /**
     * Get expDate
     *
     * @return integer
     */
    public function getExpDate()
    {
        return $this->expDate;
    }

    /**
     * Set adminEnabled
     *
     * @param integer $adminEnabled
     *
     * @return Users
     */
    public function setAdminEnabled($adminEnabled)
    {
        $this->adminEnabled = $adminEnabled;

        return $this;
    }

    /**
     * Get adminEnabled
     *
     * @return integer
     */
    public function getAdminEnabled()
    {
        return $this->adminEnabled;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return Users
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set adminNotes
     *
     * @param string $adminNotes
     *
     * @return Users
     */
    public function setAdminNotes($adminNotes)
    {
        $this->adminNotes = $adminNotes;

        return $this;
    }

    /**
     * Get adminNotes
     *
     * @return string
     */
    public function getAdminNotes()
    {
        return $this->adminNotes;
    }

    /**
     * Set resellerNotes
     *
     * @param string $resellerNotes
     *
     * @return Users
     */
    public function setResellerNotes($resellerNotes)
    {
        $this->resellerNotes = $resellerNotes;

        return $this;
    }

    /**
     * Get resellerNotes
     *
     * @return string
     */
    public function getResellerNotes()
    {
        return $this->resellerNotes;
    }

    /**
     * Set bouquet
     *
     * @param string $bouquet
     *
     * @return Users
     */
    public function setBouquet($bouquet)
    {
        $this->bouquet = $bouquet;

        return $this;
    }

    /**
     * Get bouquet
     *
     * @return string
     */
    public function getBouquet()
    {
        return $this->bouquet;
    }

    /**
     * Set maxConnections
     *
     * @param integer $maxConnections
     *
     * @return Users
     */
    public function setMaxConnections($maxConnections)
    {
        $this->maxConnections = $maxConnections;

        return $this;
    }

    /**
     * Get maxConnections
     *
     * @return integer
     */
    public function getMaxConnections()
    {
        return $this->maxConnections;
    }

    /**
     * Set isRestreamer
     *
     * @param boolean $isRestreamer
     *
     * @return Users
     */
    public function setIsRestreamer($isRestreamer)
    {
        $this->isRestreamer = $isRestreamer;

        return $this;
    }

    /**
     * Get isRestreamer
     *
     * @return boolean
     */
    public function getIsRestreamer()
    {
        return $this->isRestreamer;
    }

    /**
     * Set allowedIps
     *
     * @param string $allowedIps
     *
     * @return Users
     */
    public function setAllowedIps($allowedIps)
    {
        $this->allowedIps = $allowedIps;

        return $this;
    }

    /**
     * Get allowedIps
     *
     * @return string
     */
    public function getAllowedIps()
    {
        return $this->allowedIps;
    }

    /**
     * Set allowedUa
     *
     * @param string $allowedUa
     *
     * @return Users
     */
    public function setAllowedUa($allowedUa)
    {
        $this->allowedUa = $allowedUa;

        return $this;
    }

    /**
     * Get allowedUa
     *
     * @return string
     */
    public function getAllowedUa()
    {
        return $this->allowedUa;
    }

    /**
     * Set isTrial
     *
     * @param boolean $isTrial
     *
     * @return Users
     */
    public function setIsTrial($isTrial)
    {
        $this->isTrial = $isTrial;

        return $this;
    }

    /**
     * Get isTrial
     *
     * @return boolean
     */
    public function getIsTrial()
    {
        return $this->isTrial;
    }

    /**
     * Set createdAt
     *
     * @param integer $createdAt
     *
     * @return Users
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Users
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set pairId
     *
     * @param integer $pairId
     *
     * @return Users
     */
    public function setPairId($pairId)
    {
        $this->pairId = $pairId;

        return $this;
    }

    /**
     * Get pairId
     *
     * @return integer
     */
    public function getPairId()
    {
        return $this->pairId;
    }

    /**
     * Set isMag
     *
     * @param boolean $isMag
     *
     * @return Users
     */
    public function setIsMag($isMag)
    {
        $this->isMag = $isMag;

        return $this;
    }

    /**
     * Get isMag
     *
     * @return boolean
     */
    public function getIsMag()
    {
        return $this->isMag;
    }

    /**
     * Set isE2
     *
     * @param boolean $isE2
     *
     * @return Users
     */
    public function setIsE2($isE2)
    {
        $this->isE2 = $isE2;

        return $this;
    }

    /**
     * Get isE2
     *
     * @return boolean
     */
    public function getIsE2()
    {
        return $this->isE2;
    }

    /**
     * Set forceServerId
     *
     * @param integer $forceServerId
     *
     * @return Users
     */
    public function setForceServerId($forceServerId)
    {
        $this->forceServerId = $forceServerId;

        return $this;
    }

    /**
     * Get forceServerId
     *
     * @return integer
     */
    public function getForceServerId()
    {
        return $this->forceServerId;
    }

    /**
     * Set isIsplock
     *
     * @param boolean $isIsplock
     *
     * @return Users
     */
    public function setIsIsplock($isIsplock)
    {
        $this->isIsplock = $isIsplock;

        return $this;
    }

    /**
     * Get isIsplock
     *
     * @return boolean
     */
    public function getIsIsplock()
    {
        return $this->isIsplock;
    }

    /**
     * Set ispDesc
     *
     * @param string $ispDesc
     *
     * @return Users
     */
    public function setIspDesc($ispDesc)
    {
        $this->ispDesc = $ispDesc;

        return $this;
    }

    /**
     * Get ispDesc
     *
     * @return string
     */
    public function getIspDesc()
    {
        return $this->ispDesc;
    }

    /**
     * Set forcedCountry
     *
     * @param string $forcedCountry
     *
     * @return Users
     */
    public function setForcedCountry($forcedCountry)
    {
        $this->forcedCountry = $forcedCountry;

        return $this;
    }

    /**
     * Get forcedCountry
     *
     * @return string
     */
    public function getForcedCountry()
    {
        return $this->forcedCountry;
    }

    /**
     * Set isStalker
     *
     * @param boolean $isStalker
     *
     * @return Users
     */
    public function setIsStalker($isStalker)
    {
        $this->isStalker = $isStalker;

        return $this;
    }

    /**
     * Get isStalker
     *
     * @return boolean
     */
    public function getIsStalker()
    {
        return $this->isStalker;
    }

    /**
     * Set bypassUa
     *
     * @param boolean $bypassUa
     *
     * @return Users
     */
    public function setBypassUa($bypassUa)
    {
        $this->bypassUa = $bypassUa;

        return $this;
    }

    /**
     * Get bypassUa
     *
     * @return boolean
     */
    public function getBypassUa()
    {
        return $this->bypassUa;
    }

    /**
     * Set asNumber
     *
     * @param string $asNumber
     *
     * @return Users
     */
    public function setAsNumber($asNumber)
    {
        $this->asNumber = $asNumber;

        return $this;
    }

    /**
     * Get asNumber
     *
     * @return string
     */
    public function getAsNumber()
    {
        return $this->asNumber;
    }

    /**
     * Set memberGroup
     *
     * @param MemberGroups $memberGroup
     *
     * @return RegUsers
     */
    public function setMemberGroup($memberGroup)
    {
        $this->memberGroup = $memberGroup;

        return $this;
    }

    /**
     * Get memberGroup
     *
     * @return MemberGroups
     */
    public function getMemberGroup()
    {
        return $this->memberGroup;
    }

    /**
     * Add device
     *
     * @param \Dmcl\AppBundle\Entity\Devices $device
     *
     * @return Users
     */
    public function addDevice(\Dmcl\AppBundle\Entity\Devices $device)
    {
        $this->devices[] = $device;

        return $this;
    }

    /**
     * Remove device
     *
     * @param \Dmcl\AppBundle\Entity\Devices $device
     */
    public function removeDevice(\Dmcl\AppBundle\Entity\Devices $device)
    {
        $this->devices->removeElement($device);
    }

    /**
     * Get devices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevices()
    {
        return $this->devices;
    }
}
