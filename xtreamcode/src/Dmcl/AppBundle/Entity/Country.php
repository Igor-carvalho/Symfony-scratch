<?php
/**
 * Created by PhpStorm.
 * User: lazaro.garcia
 * Date: 4/20/2016
 * Time: 2:14 PM
 */

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @package Dmcl\AppBundle\Entity
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\CountryRepository")
 */
class Country
{
    /**
     * @var
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="code", type="string", length=2)
     */
    private $code;

    /**
     * @var
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Country
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Country
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
}
