<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PanelLogs
 *
 * @ORM\Table(name="panel_logs")
 * @ORM\Entity
 */
class PanelLogs
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
     * @ORM\Column(name="log_message", type="text", length=16777215, nullable=false)
     */
    private $logMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer", nullable=false)
     */
    private $date;



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
     * Set logMessage
     *
     * @param string $logMessage
     *
     * @return PanelLogs
     */
    public function setLogMessage($logMessage)
    {
        $this->logMessage = $logMessage;

        return $this;
    }

    /**
     * Get logMessage
     *
     * @return string
     */
    public function getLogMessage()
    {
        return $this->logMessage;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return PanelLogs
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
}
