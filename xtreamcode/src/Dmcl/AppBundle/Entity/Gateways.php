<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gateways
 *
 * @ORM\Table(name="gateways")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\GatewaysRepository")
 */
class Gateways
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
     * @ORM\Column(name="uniqueName", type="string", length=255)
     */
    private $uniqueName;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=255)
     */
    private $displayName;

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
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime",nullable=true)
     */
    private $updatedAt;

    /**
     *
     * @ORM\OneToMany(targetEntity="Orders", mappedBy="gateway")
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
     * Set uniqueName
     *
     * @param string $uniqueName
     * @return Gateways
     */
    public function setUniqueName($uniqueName)
    {
        $this->uniqueName = $uniqueName;

        return $this;
    }

    /**
     * Get uniqueName
     *
     * @return string 
     */
    public function getUniqueName()
    {
        return $this->uniqueName;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return Gateways
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Gateways
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
