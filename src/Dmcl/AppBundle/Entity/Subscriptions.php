<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscriptions
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\SubscriptionsRepository")
 */
class Subscriptions
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
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="subscriptions")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="productType", type="string", length=255)
     */
    private $productType;

    /**
     * @var string
     *
     * @ORM\Column(name="productId", type="string", length=255)
     */
    private $productId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="expired", type="boolean",nullable=true)
     */
    private $expired=false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expireAt", type="datetime")
     */
    private $expireAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="forTest", type="boolean",nullable=true)
     */
    private $forTest = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    function __construct()
    {
        $this->createdAt = new \DateTime("now");;
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
     * Set user
     *
     * @param string $user
     * @return Subscriptions
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

    /**
     * Set productType
     *
     * @param string $productType
     * @return Subscriptions
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get productType
     *
     * @return string
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set productId
     *
     * @param string $productId
     * @return Subscriptions
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set expired
     *
     * @param boolean $expired
     * @return Subscriptions
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return boolean
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set expireAt
     *
     * @param \DateTime $expireAt
     * @return Subscriptions
     */
    public function setExpireAt($expireAt)
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    /**
     * Get expireAt
     *
     * @return \DateTime
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Subscriptions
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
     * @return boolean
     */
    public function isForTest()
    {
        return $this->forTest;
    }

    /**
     * @param boolean $forTest
     */
    public function setForTest($forTest)
    {
        $this->forTest = $forTest;
    }




    /**
     * Get forTest
     *
     * @return boolean
     */
    public function getForTest()
    {
        return $this->forTest;
    }
}
