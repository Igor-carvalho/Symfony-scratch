<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlockedUserAgents
 *
 * @ORM\Table(name="blocked_user_agents", indexes={@ORM\Index(name="user_agent", columns={"user_agent"}), @ORM\Index(name="exact_match", columns={"exact_match"})})
 * @ORM\Entity
 */
class BlockedUserAgents
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
     * @ORM\Column(name="user_agent", type="string", length=255, nullable=false)
     */
    private $userAgent;

    /**
     * @var integer
     *
     * @ORM\Column(name="exact_match", type="integer", nullable=false)
     */
    private $exactMatch = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="attempts_blocked", type="integer", nullable=false)
     */
    private $attemptsBlocked = '0';



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
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return BlockedUserAgents
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set exactMatch
     *
     * @param integer $exactMatch
     *
     * @return BlockedUserAgents
     */
    public function setExactMatch($exactMatch)
    {
        $this->exactMatch = $exactMatch;

        return $this;
    }

    /**
     * Get exactMatch
     *
     * @return integer
     */
    public function getExactMatch()
    {
        return $this->exactMatch;
    }

    /**
     * Set attemptsBlocked
     *
     * @param integer $attemptsBlocked
     *
     * @return BlockedUserAgents
     */
    public function setAttemptsBlocked($attemptsBlocked)
    {
        $this->attemptsBlocked = $attemptsBlocked;

        return $this;
    }

    /**
     * Get attemptsBlocked
     *
     * @return integer
     */
    public function getAttemptsBlocked()
    {
        return $this->attemptsBlocked;
    }
}
