<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @var integer
     * 
     * @ORM\Column(name="customer_id", type="integer")
     */
    private $customer;

    /**
     * @var string
     *
     * @ORM\Column(name="customerName", type="string", length=255)
     */
    private $customerName;

    /**
     * @var string
     *
     * @ORM\Column(name="customerEmail", type="string", length=255)
     */
    private $customerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="transactionId", type="string", length=255)
     */
    private $transactionId;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255)
     */
    private $currency;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var float
     *
     * @ORM\Column(name="amountReal", type="float")
     */
    private $amountReal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verified", type="boolean",nullable=true)
     */
    private $verified=false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expireAt", type="datetime")
     */
    private $expireAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="expired", type="boolean",nullable=true)
     */
    private $expired;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="verifiedAt", type="datetime",nullable=true)
     */
    private $verifiedAt;

    /**
     * @var array
     *
     * @ORM\Column(name="products", type="json_array")
     */
    private $products;

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float")
     */
    private $discount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Gateways", inversedBy="orders")
     */
    private $gateway;


    function __construct()
    {
        $this->createdAt = new \DateTime("now");
        $this->transactionId = uniqid(time());
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
     * Set customer
     *
     * @param integer $customer
     * @return Orders
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return integer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set customerName
     *
     * @param string $customerName
     * @return Orders
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get customerName
     *
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     * @return Orders
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Get customerEmail
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set transactionId
     *
     * @param string $transactionId
     * @return Orders
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Orders
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set verified
     *
     * @param boolean $verified
     * @return Orders
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set expireAt
     *
     * @param \DateTime $expireAt
     * @return Orders
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
     * Set expired
     *
     * @param boolean $expired
     * @return Orders
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
     * Set verifiedAt
     *
     * @param \DateTime $verifiedAt
     * @return Orders
     */
    public function setVerifiedAt($verifiedAt)
    {
        $this->verifiedAt = $verifiedAt;

        return $this;
    }

    /**
     * Get verifiedAt
     *
     * @return \DateTime
     */
    public function getVerifiedAt()
    {
        return $this->verifiedAt;
    }

    /**
     * Set products
     *
     * @param array $products
     * @return Orders
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }


    /**
     * Set discount
     *
     * @param float $discount
     * @return Orders
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Orders
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

    function to_float() {
        $sum = $this->amount;
        if (strpos($sum, ".")) {
            $sum = round($sum, 2);
        } else {
            $sum = $sum . ".0";
        }
        return $sum;
    }

    /**
     * Set gateway
     *
     * @param \Dmcl\AppBundle\Entity\Gateways $gateway
     * @return Orders
     */
    public function setGateway(\Dmcl\AppBundle\Entity\Gateways $gateway = null)
    {
        $this->gateway = $gateway;

        return $this;
    }

    /**
     * Get gateway
     *
     * @return \Dmcl\AppBundle\Entity\Gateways
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Orders
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
     * Set amountReal
     *
     * @param float $amountReal
     * @return Orders
     */
    public function setAmountReal($amountReal)
    {
        $this->amountReal = $amountReal;

        return $this;
    }

    /**
     * Get amountReal
     *
     * @return float
     */
    public function getAmountReal()
    {
        return $this->amountReal;
    }
}
