<?php
/**
 * Created by PhpStorm.
 * User: lazaro.garcia
 * Date: 4/8/2016
 * Time: 9:54 AM
 */

namespace Dmcl\AppBundle\Form\Model;

use Dmcl\AppBundle\Entity\Paypal;
use Doctrine\ORM\Mapping as ORM;
use Dmcl\AppBundle\Entity\ChannelsPackage;
use Dmcl\AppBundle\Entity\User;
use Dmcl\AppBundle\Entity\Customers;
use Dmcl\AppBundle\Entity\VodPackage;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ActivationCodeModel
{
    /**
     * @var
     * @Assert\NotBlank(message="Type an ammount")
     * @Assert\GreaterThanOrEqual(value="1", message="The amount could be greater than or equal to 1")
     */
    private $activationCodeAmount;

    /**
     * @var integer
     *
     * @Assert\NotBlank(message="Type a period")
     * @Assert\GreaterThanOrEqual(value="1", message="The amount could be greater than or equal to 1")
     */
    private $period;

    /**
     * @var integer
     *
     */
    private $customer;

    /**
     * @var paypalId
     */
    private $paypalId;

    /**
     *@var String
     *
     * @ORM\Column(name="reset_login", type="string", length=255, nullable=true)
     */
    private $resetLogin;

    private $channelsPackage;
    private $vodsPackage;
    private $seriesPackage;

    /**
     * ActivationCodeModel constructor.
     */
    public function __construct($activationcode=null)
    {
        $this->activationCodeAmount = 1;
		$this->channelsPackage = array();
        $this->vodsPackage = array();
        $this->seriesPackage = array();

        if($activationcode){
            $this->id = $activationcode->id;            
            $this->period = $activationcode->period;
            $this->customer = $activationcode->customer->id;
        }
    }

    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

	/**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }
    
	/**
     * Add channelsPackage
     *
     * @param integer $channelsPackage
     * @return ActivationCode
     */
    public function addChannelsPackage($channelsPackage)
    {
        $this->channelsPackage[] = $channelsPackage;

        return $this;
    }
	
	/**
     * Remove channelsPackage
     *
     * @param \Dmcl\AppBundle\Entity\ChannelsPackage $channelsPackage
     */
    public function removeChannelsPackage($channelsPackage)
    {
        //$this->channelsPackage->removeElement($channelsPackage);
    }
	
    /**
     * @return mixed
     */
    public function getChannelsPackage()
    {
        return $this->channelsPackage;
    }

    /**
     * Add vods
     *
     * @param integer $vodPackage
     * @return ActivationCode
     */
    public function addVodsPackage($vodPackage)
    {
        $this->vodsPackage[] = $vodPackage;

        return $this;
    }


    /**
     * Remove vods
     *
     * @param integer $vodPackage
     */
    public function removeVodsPackage($vodPackage)
    {
        //$this->vodsPackage->removeElement($vodPackage);
    }


    /**
     * Get vodsPackage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVodsPackage()
    {
        return $this->vodsPackage;
    }

    /**
     * Add series
     *
     * @param integer $seriePackage
     * @return ActivationCode
     */
    public function addSeriesPackage($seriePackage)
    {
        $this->seriesPackage[] = $seriePackage;

        return $this;
    }


    /**
     * Remove vods
     *
     * @param \Dmcl\AppBundle\Entity\VodPackage $seriePackage
     */
    public function removeSeriesPackage($seriePackage)
    {
        //$this->seriesPackage->removeElement($seriePackage);
    }


    /**
     * Get seriesPackage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeriesPackage()
    {
        return $this->seriesPackage;
    }
    /**
     * @return mixed
     */
    public function getActivationCodeAmount()
    {
        return $this->activationCodeAmount;
    }

    /**
     * @param mixed $activationCodeAmount
     */
    public function setActivationCodeAmount($activationCodeAmount)
    {
        $this->activationCodeAmount = $activationCodeAmount;
    }

    /**
     * @return String
     */
    public function getResetLogin()
    {
        return $this->resetLogin;
    }

    /**
     * @param String $resetLogin
     */
    public function setResetLogin($resetLogin)
    {
        $this->resetLogin = $resetLogin;
    }

    /**
     * @return mixed
     */
    public function getPaypalId()
    {
        return $this->paypalId;
    }

    /**
     * @param mixed $paypalId
     */
    public function setPaypalId(Paypal $paypalIds)
    {
        $this->paypalId = $paypalIds;
    }

}