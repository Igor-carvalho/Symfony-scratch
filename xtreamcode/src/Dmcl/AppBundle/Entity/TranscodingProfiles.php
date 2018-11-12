<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TranscodingProfiles
 *
 * @ORM\Table(name="transcoding_profiles")
 * @ORM\Entity
 */
class TranscodingProfiles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="profile_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $profileId;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_name", type="string", length=255, nullable=false)
     */
    private $profileName;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_options", type="text", length=16777215, nullable=false)
     */
    private $profileOptions;



    /**
     * Get profileId
     *
     * @return integer
     */
    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * Set profileName
     *
     * @param string $profileName
     *
     * @return TranscodingProfiles
     */
    public function setProfileName($profileName)
    {
        $this->profileName = $profileName;

        return $this;
    }

    /**
     * Get profileName
     *
     * @return string
     */
    public function getProfileName()
    {
        return $this->profileName;
    }

    /**
     * Set profileOptions
     *
     * @param string $profileOptions
     *
     * @return TranscodingProfiles
     */
    public function setProfileOptions($profileOptions)
    {
        $this->profileOptions = $profileOptions;

        return $this;
    }

    /**
     * Get profileOptions
     *
     * @return string
     */
    public function getProfileOptions()
    {
        return $this->profileOptions;
    }
}
