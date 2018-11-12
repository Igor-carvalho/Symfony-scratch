<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RegUsers
 *
 * @ORM\Table(name="reg_users")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\RegUsersRepository")
 */
class RegUsers implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255, nullable=true)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_registered", type="integer", nullable=false)
     */
    private $dateRegistered;

    /**
     * @var string
     *
     * @ORM\Column(name="verify_key", type="text", length=16777215, nullable=true)
     */
    private $verifyKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_login", type="integer", nullable=true)
     */
    private $lastLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="verified", type="integer", nullable=false)
     */
    private $verified = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="credits", type="float", precision=10, scale=0, nullable=false)
     */
    private $credits = 50;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=16777215, nullable=true)
     */
    private $notes = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="default_lang", type="text", length=16777215, nullable=false)
     */
    private $defaultLang = "English";

    /**
     * @var string
     *
     * @ORM\Column(name="reseller_dns", type="text", length=65535, nullable=false)
     */
    private $resellerDns = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="integer", nullable=false)
     */
    private $ownerId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="override_packages", type="text", length=65535, nullable=true)
     */
    private $overridePackages;

    /**
     * @var string
     *
     * @ORM\Column(name="google_2fa_sec", type="string", length=50, nullable=false)
     */
    private $google2faSec = '';

    private $salt = "xtreamcodes";//'b0675653405fa6b765ea1aa8b3d25fb1';

    private $roles;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MemberGroups", inversedBy="users")
     * @ORM\JoinColumn(name="member_group_id", referencedColumnName="group_id", nullable=true)
     */
    private $memberGroup;

    /**
     *
     * @ORM\OneToMany(targetEntity="RegUserlog", mappedBy="user",cascade={"remove"})
     */
    private $logs;

    private $avatar;
    
    public function __construct()
    {
      $this->roles = new ArrayCollection();
      $this->logs = new ArrayCollection();

      $now = new \DateTime('now');
      $now = date_timestamp_get($now);

      $this->dateRegistered = $now;
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
     * Set username
     *
     * @param string $username
     *
     * @return RegUsers
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
     * @return RegUsers
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
     * Set email
     *
     * @param string $email
     *
     * @return RegUsers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return RegUsers
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
     * Set dateRegistered
     *
     * @param integer $dateRegistered
     *
     * @return RegUsers
     */
    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;

        return $this;
    }

    /**
     * Get dateRegistered
     *
     * @return integer
     */
    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }

    /**
     * Set verifyKey
     *
     * @param string $verifyKey
     *
     * @return RegUsers
     */
    public function setVerifyKey($verifyKey)
    {
        $this->verifyKey = $verifyKey;

        return $this;
    }

    /**
     * Get verifyKey
     *
     * @return string
     */
    public function getVerifyKey()
    {
        return $this->verifyKey;
    }

    /**
     * Set lastLogin
     *
     * @param integer $lastLogin
     *
     * @return RegUsers
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return integer
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set verified
     *
     * @param integer $verified
     *
     * @return RegUsers
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return integer
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set credits
     *
     * @param float $credits
     *
     * @return RegUsers
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return float
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return RegUsers
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
     * Set status
     *
     * @param boolean $status
     *
     * @return RegUsers
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
     * Set defaultLang
     *
     * @param string $defaultLang
     *
     * @return RegUsers
     */
    public function setDefaultLang($defaultLang)
    {
        $this->defaultLang = $defaultLang;

        return $this;
    }

    /**
     * Get defaultLang
     *
     * @return string
     */
    public function getDefaultLang()
    {
        return $this->defaultLang;
    }

    /**
     * Set resellerDns
     *
     * @param string $resellerDns
     *
     * @return RegUsers
     */
    public function setResellerDns($resellerDns)
    {
        $this->resellerDns = $resellerDns;

        return $this;
    }

    /**
     * Get resellerDns
     *
     * @return string
     */
    public function getResellerDns()
    {
        return $this->resellerDns;
    }

    /**
     * Set ownerId
     *
     * @param integer $ownerId
     *
     * @return RegUsers
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * Get ownerId
     *
     * @return integer
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Set overridePackages
     *
     * @param string $overridePackages
     *
     * @return RegUsers
     */
    public function setOverridePackages($overridePackages)
    {
        $this->overridePackages = $overridePackages;

        return $this;
    }

    /**
     * Get overridePackages
     *
     * @return string
     */
    public function getOverridePackages()
    {
        return $this->overridePackages;
    }

    /**
     * Set google2faSec
     *
     * @param string $google2faSec
     *
     * @return RegUsers
     */
    public function setGoogle2faSec($google2faSec)
    {
        $this->google2faSec = $google2faSec;

        return $this;
    }

    /**
     * Get google2faSec
     *
     * @return string
     */
    public function getGoogle2faSec()
    {
        return $this->google2faSec;
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
     * @inheritDoc
     */
    public function getSalt()
    {                
      return $this->salt;      
    }
    
    /**
     * Compares this user to another to determine if they are the same.
     *
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function equals(UserInterface $user) 
    {
      return md5($this->getUsername()) == md5($user->getUsername());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(){}

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
      return serialize(array(
          $this->id,
          $this->username,
          $this->password,
          $this->email,
          $this->salt
      ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
      list (
          $this->id,
          $this->username,
          $this->password,
          $this->email,            
          $this->salt
      ) = unserialize($serialized);
    }
    
    /**
     * Get roles
     *
     * @return ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    /**
     * Convert User to string
     *
     * @return string 
     */
    public function __toString() 
    {
      return $this->username;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add logs
     *
     * @param RegUserlog $logs
     * @return RegUsers
     */
    public function addLog(RegUsers $logs)
    {
        $this->logs[] = $logs;

        return $this;
    }

    /**
     * Remove logs
     *
     * @param RegUsers $logs
     */
    public function removeLog(RegUserlog $logs)
    {
        $this->logs->removeElement($logs);
    }

    /**
     * Get logs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLogs()
    {
        return $this->logs;
    }
}