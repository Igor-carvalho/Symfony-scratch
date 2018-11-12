<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Users extends \Dmcl\AppBundle\Entity\Users implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'memberGroup', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'member', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'username', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'password', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'expDate', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'adminEnabled', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'enabled', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'adminNotes', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'resellerNotes', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'bouquet', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'maxConnections', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isRestreamer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'allowedIps', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'allowedUa', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isTrial', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'createdAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'createdBy', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'pairId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isMag', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isE2', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'forceServerId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isIsplock', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'ispDesc', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'forcedCountry', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isStalker', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'bypassUa', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'asNumber', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'devices'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'memberGroup', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'member', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'username', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'password', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'expDate', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'adminEnabled', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'enabled', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'adminNotes', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'resellerNotes', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'bouquet', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'maxConnections', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isRestreamer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'allowedIps', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'allowedUa', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isTrial', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'createdAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'createdBy', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'pairId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isMag', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isE2', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'forceServerId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isIsplock', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'ispDesc', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'forcedCountry', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'isStalker', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'bypassUa', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'asNumber', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Users' . "\0" . 'devices'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Users $proxy) {
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
    public function setMember($member)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMember', [$member]);

        return parent::setMember($member);
    }

    /**
     * {@inheritDoc}
     */
    public function getMember()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMember', []);

        return parent::getMember();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsername', [$username]);

        return parent::setUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', []);

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setExpDate($expDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpDate', [$expDate]);

        return parent::setExpDate($expDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpDate', []);

        return parent::getExpDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminEnabled($adminEnabled)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdminEnabled', [$adminEnabled]);

        return parent::setAdminEnabled($adminEnabled);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdminEnabled', []);

        return parent::getAdminEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled($enabled)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEnabled', [$enabled]);

        return parent::setEnabled($enabled);
    }

    /**
     * {@inheritDoc}
     */
    public function getEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnabled', []);

        return parent::getEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminNotes($adminNotes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdminNotes', [$adminNotes]);

        return parent::setAdminNotes($adminNotes);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminNotes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdminNotes', []);

        return parent::getAdminNotes();
    }

    /**
     * {@inheritDoc}
     */
    public function setResellerNotes($resellerNotes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResellerNotes', [$resellerNotes]);

        return parent::setResellerNotes($resellerNotes);
    }

    /**
     * {@inheritDoc}
     */
    public function getResellerNotes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResellerNotes', []);

        return parent::getResellerNotes();
    }

    /**
     * {@inheritDoc}
     */
    public function setBouquet($bouquet)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBouquet', [$bouquet]);

        return parent::setBouquet($bouquet);
    }

    /**
     * {@inheritDoc}
     */
    public function getBouquet()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBouquet', []);

        return parent::getBouquet();
    }

    /**
     * {@inheritDoc}
     */
    public function setMaxConnections($maxConnections)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMaxConnections', [$maxConnections]);

        return parent::setMaxConnections($maxConnections);
    }

    /**
     * {@inheritDoc}
     */
    public function getMaxConnections()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMaxConnections', []);

        return parent::getMaxConnections();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsRestreamer($isRestreamer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsRestreamer', [$isRestreamer]);

        return parent::setIsRestreamer($isRestreamer);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsRestreamer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsRestreamer', []);

        return parent::getIsRestreamer();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowedIps($allowedIps)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowedIps', [$allowedIps]);

        return parent::setAllowedIps($allowedIps);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowedIps()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowedIps', []);

        return parent::getAllowedIps();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowedUa($allowedUa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowedUa', [$allowedUa]);

        return parent::setAllowedUa($allowedUa);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowedUa()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowedUa', []);

        return parent::getAllowedUa();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsTrial($isTrial)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsTrial', [$isTrial]);

        return parent::setIsTrial($isTrial);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsTrial()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsTrial', []);

        return parent::getIsTrial();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt($createdAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', [$createdAt]);

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedBy($createdBy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedBy', [$createdBy]);

        return parent::setCreatedBy($createdBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedBy', []);

        return parent::getCreatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setPairId($pairId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPairId', [$pairId]);

        return parent::setPairId($pairId);
    }

    /**
     * {@inheritDoc}
     */
    public function getPairId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPairId', []);

        return parent::getPairId();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsMag($isMag)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsMag', [$isMag]);

        return parent::setIsMag($isMag);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsMag()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsMag', []);

        return parent::getIsMag();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsE2($isE2)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsE2', [$isE2]);

        return parent::setIsE2($isE2);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsE2()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsE2', []);

        return parent::getIsE2();
    }

    /**
     * {@inheritDoc}
     */
    public function setForceServerId($forceServerId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setForceServerId', [$forceServerId]);

        return parent::setForceServerId($forceServerId);
    }

    /**
     * {@inheritDoc}
     */
    public function getForceServerId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getForceServerId', []);

        return parent::getForceServerId();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsIsplock($isIsplock)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsIsplock', [$isIsplock]);

        return parent::setIsIsplock($isIsplock);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsIsplock()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsIsplock', []);

        return parent::getIsIsplock();
    }

    /**
     * {@inheritDoc}
     */
    public function setIspDesc($ispDesc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIspDesc', [$ispDesc]);

        return parent::setIspDesc($ispDesc);
    }

    /**
     * {@inheritDoc}
     */
    public function getIspDesc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIspDesc', []);

        return parent::getIspDesc();
    }

    /**
     * {@inheritDoc}
     */
    public function setForcedCountry($forcedCountry)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setForcedCountry', [$forcedCountry]);

        return parent::setForcedCountry($forcedCountry);
    }

    /**
     * {@inheritDoc}
     */
    public function getForcedCountry()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getForcedCountry', []);

        return parent::getForcedCountry();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsStalker($isStalker)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsStalker', [$isStalker]);

        return parent::setIsStalker($isStalker);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsStalker()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsStalker', []);

        return parent::getIsStalker();
    }

    /**
     * {@inheritDoc}
     */
    public function setBypassUa($bypassUa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBypassUa', [$bypassUa]);

        return parent::setBypassUa($bypassUa);
    }

    /**
     * {@inheritDoc}
     */
    public function getBypassUa()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBypassUa', []);

        return parent::getBypassUa();
    }

    /**
     * {@inheritDoc}
     */
    public function setAsNumber($asNumber)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAsNumber', [$asNumber]);

        return parent::setAsNumber($asNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getAsNumber()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAsNumber', []);

        return parent::getAsNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setMemberGroup($memberGroup)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMemberGroup', [$memberGroup]);

        return parent::setMemberGroup($memberGroup);
    }

    /**
     * {@inheritDoc}
     */
    public function getMemberGroup()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMemberGroup', []);

        return parent::getMemberGroup();
    }

    /**
     * {@inheritDoc}
     */
    public function addDevice(\Dmcl\AppBundle\Entity\Devices $device)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDevice', [$device]);

        return parent::addDevice($device);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDevice(\Dmcl\AppBundle\Entity\Devices $device)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDevice', [$device]);

        return parent::removeDevice($device);
    }

    /**
     * {@inheritDoc}
     */
    public function getDevices()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDevices', []);

        return parent::getDevices();
    }

}
