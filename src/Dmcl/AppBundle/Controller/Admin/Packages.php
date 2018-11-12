<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * ChannelCategories
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\ChannelCategoriesRepository")
 * @Vich\Uploadable
 */
class ChannelCategories
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
     * @Assert\NotBlank(message = "entity.channel_categories.name.no_blank")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="channels", type="string", nullable=true)
     */
    private $channels;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime",nullable=true)
     */
    private $updatedAt;

    /**
     * @var
     * @ORM\Column(name="categorie_logo", type="string", nullable=true)
     */
    private $categorieLogo;

    /**
     * @var
     * @Vich\UploadableField(mapping="channel_categorie_logo", fileNameProperty="categorieLogo")
     */
    private $categorieLogoFile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
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
     * @return ChannelCategories
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ChannelCategories
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return ChannelCategories
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
     * Set channels
     *
     * @param Sting $channels
     * @return ChannelCategories
     */
    public function setChannel($channels)
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * Get channels
     *
     * @return Strings 
     */
    public function getChannels()
    {
        return $this->channels;
    }

    function __toString()
    {
        return $this->name;
    }

    /**
     * Set channels
     *
     * @param string $channels
     *
     * @return ChannelCategories
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * Set categorieLogo
     *
     * @param string $categorieLogo
     *
     * @return ChannelCategories
     */
    public function setCategorieLogo($categorieLogo)
    {
        $this->categorieLogo = $categorieLogo;

        return $this;
    }

    /**
     * Get categorieLogo
     *
     * @return string
     */
    public function getCategorieLogo()
    {
        return $this->categorieLogo;
    }

    /**
     * @return mixed
     */
    public function getCategorieLogoFile()
    {
        return $this->categorieLogoFile;
    }

    /**
     * @param mixed $categorieLogoFile
     */
    public function setCategorieLogoFile($categorieLogoFile)
    {
        $this->categorieLogoFile = $categorieLogoFile;

        if ($categorieLogoFile) {
            $this->updatedAt = new \DateTime();
        }
    }
}
