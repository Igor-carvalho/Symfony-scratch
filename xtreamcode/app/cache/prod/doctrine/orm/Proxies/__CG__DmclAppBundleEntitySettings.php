<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Settings extends \Dmcl\AppBundle\Entity\Settings implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'user', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'serverName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'timeZone', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'logo', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'playerLogo', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'allowRegistration', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'siteEnabled', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'companyPhone', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'companyAddress', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'companyEmailSupport', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'serverAddress', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'aboutUs', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'servicesDescription', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'updatedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailServiceType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailSender', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailHost', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailPort', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailUsername', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailPassword', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailAuthenticationMode', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailEncryptionMode', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'temp', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'file', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'path', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'tempPlayer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'filePlayer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'pathPlayer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'news', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'styleLayout', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'styleColor'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'user', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'serverName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'timeZone', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'logo', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'playerLogo', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'allowRegistration', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'siteEnabled', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'companyPhone', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'companyAddress', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'companyEmailSupport', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'serverAddress', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'aboutUs', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'servicesDescription', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'updatedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailServiceType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailSender', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailHost', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailPort', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailUsername', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailPassword', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailAuthenticationMode', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'emailEncryptionMode', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'temp', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'file', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'path', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'tempPlayer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'filePlayer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'pathPlayer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'news', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'styleLayout', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Settings' . "\0" . 'styleColor'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Settings $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setServerName($serverName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServerName', [$serverName]);

        return parent::setServerName($serverName);
    }

    /**
     * {@inheritDoc}
     */
    public function getServerName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServerName', []);

        return parent::getServerName();
    }

    /**
     * {@inheritDoc}
     */
    public function setTimeZone($timeZone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTimeZone', [$timeZone]);

        return parent::setTimeZone($timeZone);
    }

    /**
     * {@inheritDoc}
     */
    public function getTimeZone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTimeZone', []);

        return parent::getTimeZone();
    }

    /**
     * {@inheritDoc}
     */
    public function setLogo($logo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLogo', [$logo]);

        return parent::setLogo($logo);
    }

    /**
     * {@inheritDoc}
     */
    public function getLogo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLogo', []);

        return parent::getLogo();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowRegistration($allowRegistration)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowRegistration', [$allowRegistration]);

        return parent::setAllowRegistration($allowRegistration);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowRegistration()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowRegistration', []);

        return parent::getAllowRegistration();
    }

    /**
     * {@inheritDoc}
     */
    public function setSiteEnabled($siteEnabled)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSiteEnabled', [$siteEnabled]);

        return parent::setSiteEnabled($siteEnabled);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSiteEnabled', []);

        return parent::getSiteEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailServiceType($emailServiceType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailServiceType', [$emailServiceType]);

        return parent::setEmailServiceType($emailServiceType);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailServiceType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailServiceType', []);

        return parent::getEmailServiceType();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailHost($emailHost)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailHost', [$emailHost]);

        return parent::setEmailHost($emailHost);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailHost()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailHost', []);

        return parent::getEmailHost();
    }

    /**
     * {@inheritDoc}
     */
    public function setEnailPort($emailPort)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEnailPort', [$emailPort]);

        return parent::setEnailPort($emailPort);
    }

    /**
     * {@inheritDoc}
     */
    public function getEnailPort()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnailPort', []);

        return parent::getEnailPort();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailUsername($emailUsername)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailUsername', [$emailUsername]);

        return parent::setEmailUsername($emailUsername);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailUsername', []);

        return parent::getEmailUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailPassword($emailPassword)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailPassword', [$emailPassword]);

        return parent::setEmailPassword($emailPassword);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailPassword', []);

        return parent::getEmailPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailAuthenticationMode($emailAuthenticationMode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailAuthenticationMode', [$emailAuthenticationMode]);

        return parent::setEmailAuthenticationMode($emailAuthenticationMode);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailAuthenticationMode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailAuthenticationMode', []);

        return parent::getEmailAuthenticationMode();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailEncryptionMode($emailEncryptionMode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailEncryptionMode', [$emailEncryptionMode]);

        return parent::setEmailEncryptionMode($emailEncryptionMode);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailEncryptionMode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailEncryptionMode', []);

        return parent::getEmailEncryptionMode();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyPhone($companyPhone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyPhone', [$companyPhone]);

        return parent::setCompanyPhone($companyPhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompanyPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyPhone', []);

        return parent::getCompanyPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyAddress($companyAddress)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyAddress', [$companyAddress]);

        return parent::setCompanyAddress($companyAddress);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompanyAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyAddress', []);

        return parent::getCompanyAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyEmailSupport($companyEmailSupport)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyEmailSupport', [$companyEmailSupport]);

        return parent::setCompanyEmailSupport($companyEmailSupport);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompanyEmailSupport()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyEmailSupport', []);

        return parent::getCompanyEmailSupport();
    }

    /**
     * {@inheritDoc}
     */
    public function setServerAddress($serverAddress)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServerAddress', [$serverAddress]);

        return parent::setServerAddress($serverAddress);
    }

    /**
     * {@inheritDoc}
     */
    public function getServerAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServerAddress', []);

        return parent::getServerAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setAboutUs($aboutUs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAboutUs', [$aboutUs]);

        return parent::setAboutUs($aboutUs);
    }

    /**
     * {@inheritDoc}
     */
    public function getAboutUs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAboutUs', []);

        return parent::getAboutUs();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt($updatedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', [$updatedAt]);

        return parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', []);

        return parent::getUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailPort($emailPort)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailPort', [$emailPort]);

        return parent::setEmailPort($emailPort);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailPort()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailPort', []);

        return parent::getEmailPort();
    }

    /**
     * {@inheritDoc}
     */
    public function setPlayerLogo($playerLogo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlayerLogo', [$playerLogo]);

        return parent::setPlayerLogo($playerLogo);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayerLogo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlayerLogo', []);

        return parent::getPlayerLogo();
    }

    /**
     * {@inheritDoc}
     */
    public function getFile()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFile', []);

        return parent::getFile();
    }

    /**
     * {@inheritDoc}
     */
    public function preUpload()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'preUpload', []);

        return parent::preUpload();
    }

    /**
     * {@inheritDoc}
     */
    public function upload()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'upload', []);

        return parent::upload();
    }

    /**
     * {@inheritDoc}
     */
    public function getAbsolutePath()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAbsolutePath', []);

        return parent::getAbsolutePath();
    }

    /**
     * {@inheritDoc}
     */
    public function getWebPath()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWebPath', []);

        return parent::getWebPath();
    }

    /**
     * {@inheritDoc}
     */
    public function setFile(\Symfony\Component\HttpFoundation\File\UploadedFile $file = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFile', [$file]);

        return parent::setFile($file);
    }

    /**
     * {@inheritDoc}
     */
    public function setFilePlayer(\Symfony\Component\HttpFoundation\File\UploadedFile $filePlayer = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFilePlayer', [$filePlayer]);

        return parent::setFilePlayer($filePlayer);
    }

    /**
     * {@inheritDoc}
     */
    public function getFilePlayer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFilePlayer', []);

        return parent::getFilePlayer();
    }

    /**
     * {@inheritDoc}
     */
    public function setUploadDir($uploadDir)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUploadDir', [$uploadDir]);

        return parent::setUploadDir($uploadDir);
    }

    /**
     * {@inheritDoc}
     */
    public function getServicesDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServicesDescription', []);

        return parent::getServicesDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setServicesDescription($servicesDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServicesDescription', [$servicesDescription]);

        return parent::setServicesDescription($servicesDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailSender($emailSender)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailSender', [$emailSender]);

        return parent::setEmailSender($emailSender);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailSender()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailSender', []);

        return parent::getEmailSender();
    }

    /**
     * {@inheritDoc}
     */
    public function setNews($news)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNews', [$news]);

        return parent::setNews($news);
    }

    /**
     * {@inheritDoc}
     */
    public function getNews()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNews', []);

        return parent::getNews();
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(\Dmcl\AppBundle\Entity\User $user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', [$user]);

        return parent::setUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function setStyleLayout($styleLayout)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStyleLayout', [$styleLayout]);

        return parent::setStyleLayout($styleLayout);
    }

    /**
     * {@inheritDoc}
     */
    public function getStyleLayout()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStyleLayout', []);

        return parent::getStyleLayout();
    }

    /**
     * {@inheritDoc}
     */
    public function setStyleColor($styleColor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStyleColor', [$styleColor]);

        return parent::setStyleColor($styleColor);
    }

    /**
     * {@inheritDoc}
     */
    public function getStyleColor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStyleColor', []);

        return parent::getStyleColor();
    }

}
