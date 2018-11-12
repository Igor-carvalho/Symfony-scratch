<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paypal
 *
 * @ORM\Table(name="user_paypal")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\UserPaypalRepository")
 */
class UserPaypal
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
     * @ORM\Column(name="paypal_id", type="integer")
     */
    private $paypalId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", length=255,nullable=true)
     */
    private $userId;

    


    function __construct()
    {
    

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
     * Set paypalId
     *
     * @param integer $paypalId
     * @return UserPaypal
     */
    public function setPaypalId($paypalId)
    {
        $this->paypalId = $paypalId;

        return $this;
    }

    /**
     * Get paypalId
     *
     * @return integer 
     */
    public function getPaypalId()
    {
        return $this->paypalId;
    }

    
    /**
     * Set userId
     *
     * @param integer $userId
     * @return UserPaypal
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
