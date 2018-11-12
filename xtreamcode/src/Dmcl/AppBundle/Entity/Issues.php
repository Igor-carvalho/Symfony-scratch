<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Issues
 *
 * @ORM\Table(name="issues")
 * @ORM\Entity(repositoryClass="Dmcl\AppBundle\Repository\IssuesRepository")
 */
class Issues
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
     * @var string
     *
     * @ORM\Column(name="issue", type="string", length=255)
     */
    private $issue;
	
   /**
     * @var TicketsResellers
     * @ORM\OneToMany(targetEntity="TicketsResellers", mappedBy="issue")
     */
    private $tickets;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime("now");
		$this->tickets = new ArrayCollection();
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
     * Set issue
     *
     * @param string $issue
     * @return Issues
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return string 
     */
    public function getIssue()
    {
        return $this->issue;
    }
    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Issues
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
	
	// /**
    //  * Add tickets
    //  *
    //  * @param TicketsResellers $tickets
    //  *
    //  * @return Issues
    //  */
    // public function addTickets(TicketsResellers $tickets)
    // {
    //     $this->tickets[] = $tickets;

    //     return $this;
    // }

    // /**
    //  * Remove tickets
    //  *
    //  * @param TicketsResellers $tickets
    //  */
    // public function removeTickets(TicketsResellers $tickets)
    // {
    //     $this->tickets->removeElement($tickets);
    // }

    // /**
    //  * Get tickets
    //  *
    //  * @return \Doctrine\Common\Collections\Collection
    //  */
    // public function getTickets()
    // {
    //     return $this->tickets;
    // }


    // /**
    //  * Add ticket
    //  *
    //  * @param TicketsResellers $ticket
    //  *
    //  * @return Issues
    //  */
    // public function addTicket(TicketsResellers $ticket)
    // {
    //     $this->tickets[] = $ticket;

    //     return $this;
    // }

    // /**
    //  * Remove ticket
    //  *
    //  * @param TicketsResellers $ticket
    //  */
    // public function removeTicket(TicketsResellers $ticket)
    // {
    //     $this->tickets->removeElement($ticket);
    // }
}
