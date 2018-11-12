<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOutput
 *
 * @ORM\Table(name="user_output", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="access_output_id", columns={"access_output_id"})})
 * @ORM\Entity
 */
class UserOutput
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="access_output_id", type="integer", nullable=false)
     */
    private $accessOutputId;



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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserOutput
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set accessOutputId
     *
     * @param integer $accessOutputId
     *
     * @return UserOutput
     */
    public function setAccessOutputId($accessOutputId)
    {
        $this->accessOutputId = $accessOutputId;

        return $this;
    }

    /**
     * Get accessOutputId
     *
     * @return integer
     */
    public function getAccessOutputId()
    {
        return $this->accessOutputId;
    }
}
