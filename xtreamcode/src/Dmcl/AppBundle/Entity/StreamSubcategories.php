<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamSubcategories
 *
 * @ORM\Table(name="stream_subcategories", indexes={@ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class StreamSubcategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sub_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $subId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="subcategory_name", type="string", length=255, nullable=false)
     */
    private $subcategoryName;



    /**
     * Get subId
     *
     * @return integer
     */
    public function getSubId()
    {
        return $this->subId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return StreamSubcategories
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
     * Set subcategoryName
     *
     * @param string $subcategoryName
     *
     * @return StreamSubcategories
     */
    public function setSubcategoryName($subcategoryName)
    {
        $this->subcategoryName = $subcategoryName;

        return $this;
    }

    /**
     * Get subcategoryName
     *
     * @return string
     */
    public function getSubcategoryName()
    {
        return $this->subcategoryName;
    }
}
