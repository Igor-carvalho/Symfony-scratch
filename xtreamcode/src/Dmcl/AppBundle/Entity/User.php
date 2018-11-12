<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use \Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_super_admin", type="boolean")
     */
    private $isSuperAdmin;

    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="credits", type="integer", nullable=false)
     */
    private $credits;

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="integer", nullable=false)
     */
    private $ownerId = '0';
    
    public function __construct()
    {
      $this->roles = new ArrayCollection();
      
      $this->isActive = true;
      $this->isSuperAdmin = false;
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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstname($firstName)
    {
      $this->firstName = $firstName;

      return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstname()
    {
      return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastname($lastName)
    {
      $this->lastName = $lastName;

      return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastname()
    {
      return $this->lastName;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
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
     * @return User
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
     * @return User
     */
    public function setEmail($email)
    {
      $this->email = $email;

      return $this;
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
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
      return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setActive($isActive)
    {
      $this->isActive = $isActive;

      return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function isActive()
    {
      return $this->isActive;
    }

    /**
     * Set isSuperAdmin
     *
     * @param boolean $isSuperAdmin
     * @return User
     */
    public function setSuperAdmin($isSuperAdmin)
    {
      $this->isSuperAdmin = $isSuperAdmin;

      return $this;
    }

    /**
     * Get isSuperAdmin
     *
     * @return boolean 
     */
    public function isSuperAdmin()
    {
      return $this->isSuperAdmin;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {                
      $this->salt = $salt;    
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
     * Convert User to string
     *
     * @return string 
     */
    public function __toString() 
    {
      return $this->username;
    }
    
    /*
     * @Convert user to array   
     *
     */   
    public function toArray()
    {
      return array(
                    'id'             => $this->id,
                    'first_name'     => $this->firstName,
                    'last_name'      => $this->lastName,
                    'username'       => $this->username,
                    'email'          => $this->email,
                    'is_active'      => $this->isActive,
                    'is_super_admin' => $this->isSuperAdmin
                  );
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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->avatar)) {
            // store the old name to delete after the update
            $this->temp = $this->avatar;
            $this->path = null;
            $this->avatar = null;
        } else {
            $this->path = 'initial';
            $this->avatar = 'initial';
        }
    }

    /**
     * Set credits
     *
     * @param string $credits 
     */
    public function setCredits($credits)
    {
      $this->credits = $credits;
    }

    /**
     * Get credits
     *
     * @return integer 
     */
    public function getCredits()
    {
      return $this->credits;
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
}
