<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccessOutput
 *
 * @ORM\Table(name="access_output", indexes={@ORM\Index(name="output_key", columns={"output_key"}), @ORM\Index(name="output_ext", columns={"output_ext"})})
 * @ORM\Entity
 */
class AccessOutput
{
    /**
     * @var integer
     *
     * @ORM\Column(name="access_output_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="output_name", type="string", length=255, nullable=false)
     */
    private $outputName;

    /**
     * @var string
     *
     * @ORM\Column(name="output_key", type="string", length=255, nullable=false)
     */
    private $outputKey;

    /**
     * @var string
     *
     * @ORM\Column(name="output_ext", type="string", length=255, nullable=false)
     */
    private $outputExt;

    /**
     * Get Id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set outputName
     *
     * @param string $outputName
     *
     * @return AccessOutput
     */
    public function setOutputName($outputName)
    {
        $this->outputName = $outputName;

        return $this;
    }

    /**
     * Get outputName
     *
     * @return string
     */
    public function getOutputName()
    {
        return $this->outputName;
    }

    /**
     * Set outputKey
     *
     * @param string $outputKey
     *
     * @return AccessOutput
     */
    public function setOutputKey($outputKey)
    {
        $this->outputKey = $outputKey;

        return $this;
    }

    /**
     * Get outputKey
     *
     * @return string
     */
    public function getOutputKey()
    {
        return $this->outputKey;
    }

    /**
     * Set outputExt
     *
     * @param string $outputExt
     *
     * @return AccessOutput
     */
    public function setOutputExt($outputExt)
    {
        $this->outputExt = $outputExt;

        return $this;
    }

    /**
     * Get outputExt
     *
     * @return string
     */
    public function getOutputExt()
    {
        return $this->outputExt;
    }
}
