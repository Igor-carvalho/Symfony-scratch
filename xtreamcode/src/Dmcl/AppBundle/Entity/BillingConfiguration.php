<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
/**
 * Class BillingConfiguration
 *
 * @package Dmcl\AppBundle\Entity
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 *
 * @ORM\Table(name="billing_configuration")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\BillingConfigurationRepository")
 */
class BillingConfiguration
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
     * @ORM\Column(name="currency", type="string", length=255)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="salesEmail", type="string", length=255)
     * @Assert\Email(message="entity.billing.sales_email.invalid")
     */
    private $salesEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="salesPhone", type="string", length=255,nullable=true)
     */
    private $salesPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="salesAddress", type="text")
     */
    private $salesAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordersTtl", type="integer")
     */
    private $ordersTtl = 30;

    /**
     * @var string
     *
     * @ORM\Column(name="ordersTtlInterval", type="string",length=255)
     * @Assert\Choice(choices = { "hours", "days" , "months" , "years" },message = "entity.billing.interval.invalid")
     */
    private $ordersTtlInterval = "days";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime",nullable=true)
     */
    private $updatedAt;

    /**
     * @var integer
     * 
     * @ORM\Column(name="user_id", type="integer")
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
     * Set currency
     *
     * @param string $currency
     * @return BillingConfiguration
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set ordersTtl
     *
     * @param integer $ordersTtl
     * @return BillingConfiguration
     */
    public function setOrdersTtl($ordersTtl)
    {
        $this->ordersTtl = $ordersTtl;

        return $this;
    }

    /**
     * Get ordersTtl
     *
     * @return integer 
     */
    public function getOrdersTtl()
    {
        return $this->ordersTtl;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return BillingConfiguration
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
     * Set salesEmail
     *
     * @param string $salesEmail
     * @return BillingConfiguration
     */
    public function setSalesEmail($salesEmail)
    {
        $this->salesEmail = $salesEmail;

        return $this;
    }

    /**
     * Get salesEmail
     *
     * @return string 
     */
    public function getSalesEmail()
    {
        return $this->salesEmail;
    }

    /**
     * Set salesPhone
     *
     * @param string $salesPhone
     * @return BillingConfiguration
     */
    public function setSalesPhone($salesPhone)
    {
        $this->salesPhone = $salesPhone;

        return $this;
    }

    /**
     * Get salesPhone
     *
     * @return string 
     */
    public function getSalesPhone()
    {
        return $this->salesPhone;
    }

    /**
     * Set salesAddress
     *
     * @param string $salesAddress
     * @return BillingConfiguration
     */
    public function setSalesAddress($salesAddress)
    {
        $this->salesAddress = $salesAddress;

        return $this;
    }

    /**
     * Get salesAddress
     *
     * @return string 
     */
    public function getSalesAddress()
    {
        return $this->salesAddress;
    }

    /**
     * Set ordersTtlInterval
     *
     * @param string $ordersTtlInterval
     * @return BillingConfiguration
     */
    public function setOrdersTtlInterval($ordersTtlInterval)
    {
        $this->ordersTtlInterval = $ordersTtlInterval;

        return $this;
    }

    /**
     * Get ordersTtlInterval
     *
     * @return string
     */
    public function getOrdersTtlInterval()
    {
        return $this->ordersTtlInterval;
    }

    /**
     * Set user
     *
     * @param integer $user
     * @return BillingConfiguration
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }
}
