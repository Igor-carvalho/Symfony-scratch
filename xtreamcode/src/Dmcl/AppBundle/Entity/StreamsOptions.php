<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamsOptions
 *
 * @ORM\Table(name="streams_options", indexes={@ORM\Index(name="stream_id", columns={"stream_id"}), @ORM\Index(name="argument_id", columns={"argument_id"})})
 * @ORM\Entity
 */
class StreamsOptions
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
     * @ORM\Column(name="value", type="text", length=65535, nullable=true)
     */
    private $value;

    /**
     * @var \Streams
     *
     * @ORM\ManyToOne(targetEntity="Streams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stream_id", referencedColumnName="id")
     * })
     */
    private $stream;

    /**
     * @var \StreamsArguments
     *
     * @ORM\ManyToOne(targetEntity="StreamsArguments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="argument_id", referencedColumnName="id")
     * })
     */
    private $argument;



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
     * Set value
     *
     * @param string $value
     *
     * @return StreamsOptions
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set stream
     *
     * @param \Dmcl\AppBundle\Entity\Streams $stream
     *
     * @return StreamsOptions
     */
    public function setStream(\Dmcl\AppBundle\Entity\Streams $stream = null)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get stream
     *
     * @return \Dmcl\AppBundle\Entity\Streams
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set argument
     *
     * @param \Dmcl\AppBundle\Entity\StreamsArguments $argument
     *
     * @return StreamsOptions
     */
    public function setArgument(\Dmcl\AppBundle\Entity\StreamsArguments $argument = null)
    {
        $this->argument = $argument;

        return $this;
    }

    /**
     * Get argument
     *
     * @return \Dmcl\AppBundle\Entity\StreamsArguments
     */
    public function getArgument()
    {
        return $this->argument;
    }
}
