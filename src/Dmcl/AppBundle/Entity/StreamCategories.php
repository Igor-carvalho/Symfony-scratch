<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamCategories
 *
 * @ORM\Table(name="stream_categories", uniqueConstraints={@ORM\UniqueConstraint(name="category_type_2", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_3", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_4", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_5", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_6", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_7", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_8", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_9", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_10", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_11", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_12", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_13", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_14", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_15", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_16", columns={"category_type", "category_name", "parent_id"}), @ORM\UniqueConstraint(name="category_type_17", columns={"category_type", "category_name", "parent_id"})}, indexes={@ORM\Index(name="category_type", columns={"category_type"}), @ORM\Index(name="cat_order", columns={"cat_order"}), @ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\StreamCategoriesRepository")
 */
class StreamCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category_type", type="string", length=255, nullable=false)
     */
    private $categoryType;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=255, nullable=false)
     */
    private $categoryName;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=false)
     */
    private $parentId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_order", type="integer", nullable=false)
     */
    private $catOrder = '0';

    /**
     *
     * @ORM\OneToMany(targetEntity="Streams", mappedBy="category", cascade={"remove"})
     */
    private $streams;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->streams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set categoryType
     *
     * @param string $categoryType
     *
     * @return StreamCategories
     */
    public function setCategoryType($categoryType)
    {
        $this->categoryType = $categoryType;

        return $this;
    }

    /**
     * Get categoryType
     *
     * @return string
     */
    public function getCategoryType()
    {
        return $this->categoryType;
    }

    /**
     * Set categoryName
     *
     * @param string $categoryName
     *
     * @return StreamCategories
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return StreamCategories
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set catOrder
     *
     * @param integer $catOrder
     *
     * @return StreamCategories
     */
    public function setCatOrder($catOrder)
    {
        $this->catOrder = $catOrder;

        return $this;
    }

    /**
     * Get catOrder
     *
     * @return integer
     */
    public function getCatOrder()
    {
        return $this->catOrder;
    }

    /**
     * Add streams
     *
     * @param Streams $streams
     * @return StreamCategories
     */
    public function addStream(Streams $streams)
    {
        $this->streams[] = $streams;

        return $this;
    }

    /**
     * Remove streams
     *
     * @param Sstreams $streams
     */
    public function removeStream(Streams $streams)
    {
        $this->streams->removeElement($streams);
    }

    /**
     * Get streams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStreams()
    {
        return $this->streams;
    }

    function __toString()
    {
        return $this->categoryName;
    }
}
