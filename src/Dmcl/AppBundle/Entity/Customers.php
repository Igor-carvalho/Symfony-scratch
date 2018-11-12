<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Customers
 *
 * @ORM\Table(name="customers")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\CustomersRepository")
 * @DoctrineAssert\UniqueEntity("email",message = "entity.customers.email.unique")
 * @DoctrineAssert\UniqueEntity("username",message = "entity.customers.username.unique")
 * @DoctrineAssert\UniqueEntity("code",message = "entity.customers.code.unique")
 */
class Customers implements UserInterface
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message = "entity.customer.name.no_blank")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true, unique=true)
     */
    private $username;

    /**
     * @var integer
     *
     * @ORM\Column(name="concurrentConnections", type="integer")
     */
    private $concurrentConnections = 5;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255,nullable=true)
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
     * @Assert\NotBlank(message = "entity.customer.email.no_blank")
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean",nullable=true)
     */
    private $enabled = true;

    /**
     * @var array
     *
     * @ORM\Column(name="macs", type="array",nullable=true)
     */
    private $macs;

    /**
     * @var array
     *
     * @ORM\Column(name="ips", type="array",nullable=true)
     */
    private $ips;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;
	
    /**
     *
     * @ORM\OneToMany(targetEntity="CustomerOrders", mappedBy="customer", cascade={"remove"})
     */
    private $customerOrders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->customerOrders = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Customers
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customers
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Customers
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set macs
     *
     * @param array $macs
     * @return Customers
     */
    public function setMacs($macs)
    {
        $this->macs = $macs;

        return $this;
    }

    /**
     * Get macs
     *
     * @return array
     */
    public function getMacs()
    {
        return $this->macs;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Customers
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
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        $roles = array('ROLE_CUSTOMER');
        return $roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        return;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Customers
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Customers
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Customers
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Customers
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set ips
     *
     * @param array $ips
     * @return Customers
     */
    public function setIps($ips)
    {
        $this->ips = $ips;

        return $this;
    }

    /**
     * Get ips
     *
     * @return array
     */
    public function getIps()
    {
        return $this->ips;
    }

    /**
     * @return int
     */
    public function getConcurrentConnections()
    {
        return $this->concurrentConnections;
    }

    /**
     * @param int $concurrentConnections
     */
    public function setConcurrentConnections($concurrentConnections)
    {
        $this->concurrentConnections = $concurrentConnections;
    }

    /**
     * Add CustomerOrders
     *
     * @param \Dmcl\AppBundle\Entity\CustomerOrders $customerOrders
     * @return Customers
     */
    public function addCustomerOrders(\Dmcl\AppBundle\Entity\CustomerOrders $customerOrders)
    {
        $this->customerOrders[] = $customerOrders;

        return $this;
    }

    /**
     * Remove CustomerOrders
     *
     * @param \Dmcl\AppBundle\Entity\CustomerOrders $CustomerOrders
     */
    public function removeCustomerOrders(\Dmcl\AppBundle\Entity\CustomerOrders $customerOrders)
    {
        $this->customerOrders->removeElement($customerOrders);
    }

    /**
     * Get CustomerOrders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomerOrders()
    {
        return $this->customerOrders;
    }

    /**
     * Add customerOrder
     *
     * @param \Dmcl\AppBundle\Entity\CustomerOrders $customerOrder
     *
     * @return Customers
     */
    public function addCustomerOrder(\Dmcl\AppBundle\Entity\CustomerOrders $customerOrder)
    {
        $this->customerOrders[] = $customerOrder;

        return $this;
    }

    /**
     * Remove customerOrder
     *
     * @param \Dmcl\AppBundle\Entity\CustomerOrders $customerOrder
     */
    public function removeCustomerOrder(\Dmcl\AppBundle\Entity\CustomerOrders $customerOrder)
    {
        $this->customerOrders->removeElement($customerOrder);
    }
}
