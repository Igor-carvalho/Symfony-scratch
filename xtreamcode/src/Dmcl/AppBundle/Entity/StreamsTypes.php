<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamsTypes
 *
 * @ORM\Table(name="streams_types", indexes={@ORM\Index(name="type_key", columns={"type_key"}), @ORM\Index(name="type_output", columns={"type_output"}), @ORM\Index(name="live", columns={"live"})})
 * @ORM\Entity
 */
class StreamsTypes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $typeId;

    /**
     * @var string
     *
     * @ORM\Column(name="type_name", type="string", length=255, nullable=false)
     */
    private $typeName;

    /**
     * @var string
     *
     * @ORM\Column(name="type_key", type="string", length=255, nullable=false)
     */
    private $typeKey;

    /**
     * @var string
     *
     * @ORM\Column(name="type_output", type="string", length=255, nullable=false)
     */
    private $typeOutput;

    /**
     * @var boolean
     *
     * @ORM\Column(name="live", type="boolean", nullable=false)
     */
    private $live;



    /**
     * Get typeId
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set typeName
     *
     * @param string $typeName
     *
     * @return StreamsTypes
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * Get typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Set typeKey
     *
     * @param string $typeKey
     *
     * @return StreamsTypes
     */
    public function setTypeKey($typeKey)
    {
        $this->typeKey = $typeKey;

        return $this;
    }

    /**
     * Get typeKey
     *
     * @return string
     */
    public function getTypeKey()
    {
        return $this->typeKey;
    }

    /**
     * Set typeOutput
     *
     * @param string $typeOutput
     *
     * @return StreamsTypes
     */
    public function setTypeOutput($typeOutput)
    {
        $this->typeOutput = $typeOutput;

        return $this;
    }

    /**
     * Get typeOutput
     *
     * @return string
     */
    public function getTypeOutput()
    {
        return $this->typeOutput;
    }

    /**
     * Set live
     *
     * @param boolean $live
     *
     * @return StreamsTypes
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    /**
     * Get live
     *
     * @return boolean
     */
    public function getLive()
    {
        return $this->live;
    }
}
