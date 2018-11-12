<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieContainers
 *
 * @ORM\Table(name="movie_containers", indexes={@ORM\Index(name="container_extension", columns={"container_extension"})})
 * @ORM\Entity
 */
class MovieContainers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="container_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $containerId;

    /**
     * @var string
     *
     * @ORM\Column(name="container_extension", type="string", length=255, nullable=false)
     */
    private $containerExtension;

    /**
     * @var string
     *
     * @ORM\Column(name="container_header", type="string", length=255, nullable=false)
     */
    private $containerHeader;



    /**
     * Get containerId
     *
     * @return integer
     */
    public function getContainerId()
    {
        return $this->containerId;
    }

    /**
     * Set containerExtension
     *
     * @param string $containerExtension
     *
     * @return MovieContainers
     */
    public function setContainerExtension($containerExtension)
    {
        $this->containerExtension = $containerExtension;

        return $this;
    }

    /**
     * Get containerExtension
     *
     * @return string
     */
    public function getContainerExtension()
    {
        return $this->containerExtension;
    }

    /**
     * Set containerHeader
     *
     * @param string $containerHeader
     *
     * @return MovieContainers
     */
    public function setContainerHeader($containerHeader)
    {
        $this->containerHeader = $containerHeader;

        return $this;
    }

    /**
     * Get containerHeader
     *
     * @return string
     */
    public function getContainerHeader()
    {
        return $this->containerHeader;
    }
}
