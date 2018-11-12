<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlockedIps
 *
 * @ORM\Table(name="blocked_ips", indexes={@ORM\Index(name="ip", columns={"ip"}), @ORM\Index(name="date", columns={"date"})})
 * @ORM\Entity
 */
class BlockedIps
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
     * @ORM\Column(name="ip", type="string", length=39, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", length=16777215, nullable=false)
     */
    private $notes;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="attempts_blocked", type="integer", nullable=false)
     */
    private $attemptsBlocked;



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
     * Set ip
     *
     * @param string $ip
     *
     * @return BlockedIps
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return BlockedIps
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return BlockedIps
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set attemptsBlocked
     *
     * @param integer $attemptsBlocked
     *
     * @return BlockedIps
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
