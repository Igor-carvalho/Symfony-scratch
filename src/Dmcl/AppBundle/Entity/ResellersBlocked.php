<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * ResellersBlocked
 *
 * @ORM\Table()
 * @ORM\Entity
 * @DoctrineAssert\UniqueEntity("reseller",message = "entity.resellers_blocked.reseller.unique")
 */
class ResellersBlocked
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
     *
     * @Assert\NotBlank(message = "entity.resellers_blocked.reseller.no_blank")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="blocked")
     */
    private $reseller;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="text")
     */
    private $reason;


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
     * Set reason
     *
     * @param string $reason
     * @return ResellersBlocked
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string 
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set reseller
     *
     * @param \Dmcl\AppBundle\Entity\User $reseller
     * @return ResellersBlocked
     */
    public function setReseller(\Dmcl\AppBundle\Entity\User $reseller = null)
    {
        $this->reseller = $reseller;

        return $this;
    }

    /**
     * Get reseller
     *
     * @return \AppBundle\Entity\User 
     */
    public function getReseller()
    {
        return $this->reseller;
    }
}
