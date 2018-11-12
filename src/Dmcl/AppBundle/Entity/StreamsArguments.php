<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamsArguments
 *
 * @ORM\Table(name="streams_arguments")
 * @ORM\Entity
 */
class StreamsArguments
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
     * @ORM\Column(name="argument_cat", type="string", length=255, nullable=false)
     */
    private $argumentCat;

    /**
     * @var string
     *
     * @ORM\Column(name="argument_name", type="string", length=255, nullable=false)
     */
    private $argumentName;

    /**
     * @var string
     *
     * @ORM\Column(name="argument_description", type="text", length=16777215, nullable=false)
     */
    private $argumentDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="argument_wprotocol", type="string", length=255, nullable=true)
     */
    private $argumentWprotocol;

    /**
     * @var string
     *
     * @ORM\Column(name="argument_key", type="string", length=255, nullable=false)
     */
    private $argumentKey;

    /**
     * @var string
     *
     * @ORM\Column(name="argument_cmd", type="string", length=255, nullable=true)
     */
    private $argumentCmd;

    /**
     * @var string
     *
     * @ORM\Column(name="argument_type", type="string", length=255, nullable=false)
     */
    private $argumentType;

    /**
     * @var string
     *
     * @ORM\Column(name="argument_default_value", type="string", length=255, nullable=true)
     */
    private $argumentDefaultValue;



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
     * Set argumentCat
     *
     * @param string $argumentCat
     *
     * @return StreamsArguments
     */
    public function setArgumentCat($argumentCat)
    {
        $this->argumentCat = $argumentCat;

        return $this;
    }

    /**
     * Get argumentCat
     *
     * @return string
     */
    public function getArgumentCat()
    {
        return $this->argumentCat;
    }

    /**
     * Set argumentName
     *
     * @param string $argumentName
     *
     * @return StreamsArguments
     */
    public function setArgumentName($argumentName)
    {
        $this->argumentName = $argumentName;

        return $this;
    }

    /**
     * Get argumentName
     *
     * @return string
     */
    public function getArgumentName()
    {
        return $this->argumentName;
    }

    /**
     * Set argumentDescription
     *
     * @param string $argumentDescription
     *
     * @return StreamsArguments
     */
    public function setArgumentDescription($argumentDescription)
    {
        $this->argumentDescription = $argumentDescription;

        return $this;
    }

    /**
     * Get argumentDescription
     *
     * @return string
     */
    public function getArgumentDescription()
    {
        return $this->argumentDescription;
    }

    /**
     * Set argumentWprotocol
     *
     * @param string $argumentWprotocol
     *
     * @return StreamsArguments
     */
    public function setArgumentWprotocol($argumentWprotocol)
    {
        $this->argumentWprotocol = $argumentWprotocol;

        return $this;
    }

    /**
     * Get argumentWprotocol
     *
     * @return string
     */
    public function getArgumentWprotocol()
    {
        return $this->argumentWprotocol;
    }

    /**
     * Set argumentKey
     *
     * @param string $argumentKey
     *
     * @return StreamsArguments
     */
    public function setArgumentKey($argumentKey)
    {
        $this->argumentKey = $argumentKey;

        return $this;
    }

    /**
     * Get argumentKey
     *
     * @return string
     */
    public function getArgumentKey()
    {
        return $this->argumentKey;
    }

    /**
     * Set argumentCmd
     *
     * @param string $argumentCmd
     *
     * @return StreamsArguments
     */
    public function setArgumentCmd($argumentCmd)
    {
        $this->argumentCmd = $argumentCmd;

        return $this;
    }

    /**
     * Get argumentCmd
     *
     * @return string
     */
    public function getArgumentCmd()
    {
        return $this->argumentCmd;
    }

    /**
     * Set argumentType
     *
     * @param string $argumentType
     *
     * @return StreamsArguments
     */
    public function setArgumentType($argumentType)
    {
        $this->argumentType = $argumentType;

        return $this;
    }

    /**
     * Get argumentType
     *
     * @return string
     */
    public function getArgumentType()
    {
        return $this->argumentType;
    }

    /**
     * Set argumentDefaultValue
     *
     * @param string $argumentDefaultValue
     *
     * @return StreamsArguments
     */
    public function setArgumentDefaultValue($argumentDefaultValue)
    {
        $this->argumentDefaultValue = $argumentDefaultValue;

        return $this;
    }

    /**
     * Get argumentDefaultValue
     *
     * @return string
     */
    public function getArgumentDefaultValue()
    {
        return $this->argumentDefaultValue;
    }
}
