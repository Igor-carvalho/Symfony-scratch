<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * PackagesLocal
 *
 * @ORM\Table(name="packages_local")
 * @Vich\Uploadable
 * @ORM\Entity
 */
class PackagesLocal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="super_reseller", type="boolean", nullable=false)
     */
    private $superReseller = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = true;

    /**
     * @var integer
     *
     * @ORM\Column(name="credits", type="integer", length=5, nullable=false)
     */
    private $credits = 8;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", length=5, nullable=false)
     */
    private $price = 5;

    /**
     * @var integer
     *
     * @ORM\Column(name="period", type="integer", length=2, nullable=false)
     */
    private $period = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var
     * 
     * @Vich\UploadableField(mapping="package_logo", fileNameProperty="logo")
     */
    private $logoFile;

    /**
     * @var
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var
     * @ORM\Column(name="user_id", type="integer", nullable=false)
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
     * Get user
     *
     * @return PackagseLocal
     */
    public function setUser($user)
    {
        return $this->user = $user;
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

    /**
     * Set logo
     *
     * @param string $logo
     * @return Package
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PackagesLocal
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
     * Set superReseller
     *
     * @param boolean $superReseller
     *
     * @return PackagesLocal
     */
    public function setSuperReseller($superReseller)
    {
        $this->superReseller = $superReseller;

        return $this;
    }

    /**
     * Get superReseller
     *
     * @return boolean
     */
    public function getSuperReseller()
    {
        return $this->superReseller;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return PackagesLocal
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
     * Set credits
     *
     * @param integer $credits
     *
     * @return PackagesLocal
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
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
     * Set period
     *
     * @param integer $period
     *
     * @return PackagesLocal
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return integer
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return PackagesLocal
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * @param mixed $logoFile
     */
    public function setLogoFile($logoFile)
    {
        $this->logoFile = $logoFile;

        if ($logoFile) {
            $this->updatedAt = new \DateTime();
        }
    }
}
