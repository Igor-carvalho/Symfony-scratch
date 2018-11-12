<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketsResellers
 *
 * @ORM\Table(name="tickets_resellers")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\TicketsResellersRepository")
 */
class TicketsResellers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="from_read", type="boolean", nullable=false)
     */
    private $fromRead = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="to_read", type="boolean", nullable=false)
     */
    private $toRead = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="TicketsRepliesResellers", mappedBy="ticket", cascade={"all"})
     */
    private $tickets;

    /**
     * @var integer
     *
     * @ORM\Column(name="from_id", type="integer", nullable=false)
     */
    private $from;

    /**
     * @var integer
     *
     * @ORM\Column(name="to_id", type="integer", nullable=false)
     */
    private $to;

    /**
    * @ORM\Column(name="issue", type="string", length=100)
     */
    private $issue;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime("now");
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
     * Set status
     *
     * @param boolean $status
     *
     * @return TicketsResellers
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set fromRead
     *
     * @param boolean $fromRead
     *
     * @return TicketsResellers
     */
    public function setFromRead($fromRead)
    {
        $this->fromRead = $fromRead;

        return $this;
    }

    /**
     * Get fromRead
     *
     * @return boolean
     */
    public function getFromRead()
    {
        return $this->fromRead;
    }

    /**
     * Set toRead
     *
     * @param boolean $toRead
     *
     * @return TicketsResellers
     */
    public function setToRead($toRead)
    {
        $this->toRead = $toRead;

        return $this;
    }

    /**
     * Get toRead
     *
     * @return boolean
     */
    public function getToRead()
    {
        return $this->toRead;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TicketsResellers
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add ticket
     *
     * @param \Dmcl\AppBundle\Entity\TicketsRepliesResellers $ticket
     *
     * @return TicketsResellers
     */
    public function addTicket(\Dmcl\AppBundle\Entity\TicketsRepliesResellers $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \Dmcl\AppBundle\Entity\TicketsRepliesResellers $ticket
     */
    public function removeTicket(\Dmcl\AppBundle\Entity\TicketsRepliesResellers $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set from
     *
     * @param Integer $from
     *
     * @return TicketsResellers
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return Integer
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param Integer $to
     *
     * @return TicketsResellers
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return Integer
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set issue
     *
     * @param string $issue
     *
     * @return TicketsResellers
     */
    public function setIssue($issue = null)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return String
     */
    public function getIssue()
    {
        return $this->issue;
    }
}
