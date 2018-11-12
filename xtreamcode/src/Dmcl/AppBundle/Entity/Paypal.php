<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paypal
 *
 * @ORM\Table(name="paypal_accounts")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\PaypalRepository")
 */
class Paypal
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
     * @ORM\Column(name="paypal_name", type="string", length=255)
     */
    private $paypalName;

    /**
     * @var string
     *
     * @ORM\Column(name="shopIdPublicKey", type="string", length=255,nullable=true)
     */
    private $shopIdPublicKey;

    /**
     * @var string
     *
     * @ORM\Column(name="secretKey", type="string", length=255,nullable=true)
     */
    private $secretKey;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean",nullable=true)
     */
    private $enabled = true;

    /**
     *
     * @ORM\OneToMany(targetEntity="Orders", mappedBy="paypal")
     */
    private $orders;



    function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();

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
     * Set paypalName
     *
     * @param string $paypalName
     * @return Gateways
     */
    public function setPaypalName($paypalName)
    {
        $this->paypalName = $paypalName;

        return $this;
    }

    /**
     * Get paypalName
     *
     * @return string 
     */
    public function getPaypalName()
    {
        return $this->paypalName;
    }

    
    /**
     * Set shopIdPublicKey
     *
     * @param string $shopIdPublicKey
     * @return Gateways
     */
    public function setShopIdPublicKey($shopIdPublicKey)
    {
        $this->shopIdPublicKey = $shopIdPublicKey;

        return $this;
    }

    /**
     * Get shopIdPublicKey
     *
     * @return string 
     */
    public function getShopIdPublicKey()
    {
        return $this->shopIdPublicKey;
    }

    /**
     * Set secretKey
     *
     * @param string $secretKey
     * @return Gateways
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;

        return $this;
    }

    /**
     * Get secretKey
     *
     * @return string 
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Gateways
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

    
    /**
     * Add orders
     *
     * @param \Dmcl\AppBundle\Entity\Orders $orders
     * @return Gateways
     */
    public function addOrder(\Dmcl\AppBundle\Entity\Orders $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \Dmcl\AppBundle\Entity\Orders $orders
     */
    public function removeOrder(\Dmcl\AppBundle\Entity\Orders $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
