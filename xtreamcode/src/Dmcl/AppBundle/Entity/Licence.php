<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Licence
 *
 * @ORM\Table(name="licence")
 * @ORM\Entity
 */
class Licence
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
     * @ORM\Column(name="licence_key", type="string", length=29, nullable=false)
     */
    private $licenceKey;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_message", type="boolean", nullable=false)
     */
    private $showMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="update_available", type="integer", nullable=false)
     */
    private $updateAvailable = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reshare_deny_addon", type="boolean", nullable=false)
     */
    private $reshareDenyAddon = '0';



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
     * Set licenceKey
     *
     * @param string $licenceKey
     *
     * @return Licence
     */
    public function setLicenceKey($licenceKey)
    {
        $this->licenceKey = $licenceKey;

        return $this;
    }

    /**
     * Get licenceKey
     *
     * @return string
     */
    public function getLicenceKey()
    {
        return $this->licenceKey;
    }

    /**
     * Set showMessage
     *
     * @param boolean $showMessage
     *
     * @return Licence
     */
    public function setShowMessage($showMessage)
    {
        $this->showMessage = $showMessage;

        return $this;
    }

    /**
     * Get showMessage
     *
     * @return boolean
     */
    public function getShowMessage()
    {
        return $this->showMessage;
    }

    /**
     * Set updateAvailable
     *
     * @param integer $updateAvailable
     *
     * @return Licence
     */
    public function setUpdateAvailable($updateAvailable)
    {
        $this->updateAvailable = $updateAvailable;

        return $this;
    }

    /**
     * Get updateAvailable
     *
     * @return integer
     */
    public function getUpdateAvailable()
    {
        return $this->updateAvailable;
    }

    /**
     * Set reshareDenyAddon
     *
     * @param boolean $reshareDenyAddon
     *
     * @return Licence
     */
    public function setReshareDenyAddon($reshareDenyAddon)
    {
        $this->reshareDenyAddon = $reshareDenyAddon;

        return $this;
    }

    /**
     * Get reshareDenyAddon
     *
     * @return boolean
     */
    public function getReshareDenyAddon()
    {
        return $this->reshareDenyAddon;
    }
}
