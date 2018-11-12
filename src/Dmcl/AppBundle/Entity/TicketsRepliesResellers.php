<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketsRepliesResellers
 *
 * @ORM\Table(name="tickets_replies_resellers")
 * @ORM\Entity
 */
class TicketsRepliesResellers
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
     * @var boolean
     *
     * @ORM\Column(name="admin_reply", type="boolean", nullable=false)
     */
    private $adminReply = true;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=255, nullable=false)
     */
    private $message;

    /**
     * @var integer
     *
     * @ORM\Column(name="createdAt", type="integer", nullable=false)
     */
    private $createdAt;

    /**
     *
     * @ORM\ManyToOne(targetEntity="TicketsResellers", inversedBy="tickets")
     */
    private $ticket;

    /**
     * Constructor
     */
    public function __construct()
    {
        $now = new \DateTime('now');
        $now = date_timestamp_get($now);
        
        $this->createdAt = $now;
    }

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
     * Set adminReply
     *
     * @param boolean $adminReply
     *
     * @return TicketsRepliesResellers
     */
    public function setAdminReply($adminReply)
    {
        $this->adminReply = $adminReply;

        return $this;
    }

    /**
     * Get adminReply
     *
     * @return boolean
     */
    public function getAdminReply()
    {
        return $this->adminReply;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return TicketsRepliesResellers
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param integer $createdAt
     *
     * @return TicketsRepliesResellers
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set ticket
     *
     * @param TicketsResellers $ticket
     *
     * @return TicketsRepliesResellers
     */
    public function setTicket(TicketsResellers $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return TicketsResellers
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
