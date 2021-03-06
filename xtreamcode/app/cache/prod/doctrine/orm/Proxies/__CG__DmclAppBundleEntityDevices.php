<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Devices extends \Dmcl\AppBundle\Entity\Devices implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceKey', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceFilename', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceHeader', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceConf', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceFooter', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'copyText', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'defaultOutput', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'user'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceKey', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceFilename', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceHeader', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceConf', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'deviceFooter', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'copyText', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'defaultOutput', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Devices' . "\0" . 'user'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Devices $proxy) {
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
    public function getDeviceId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getDeviceId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeviceId', []);

        return parent::getDeviceId();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeviceName($deviceName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeviceName', [$deviceName]);

        return parent::setDeviceName($deviceName);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeviceName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeviceName', []);

        return parent::getDeviceName();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeviceKey($deviceKey)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeviceKey', [$deviceKey]);

        return parent::setDeviceKey($deviceKey);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeviceKey()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeviceKey', []);

        return parent::getDeviceKey();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeviceFilename($deviceFilename)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeviceFilename', [$deviceFilename]);

        return parent::setDeviceFilename($deviceFilename);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeviceFilename()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeviceFilename', []);

        return parent::getDeviceFilename();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeviceHeader($deviceHeader)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeviceHeader', [$deviceHeader]);

        return parent::setDeviceHeader($deviceHeader);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeviceHeader()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeviceHeader', []);

        return parent::getDeviceHeader();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeviceConf($deviceConf)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeviceConf', [$deviceConf]);

        return parent::setDeviceConf($deviceConf);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeviceConf()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeviceConf', []);

        return parent::getDeviceConf();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeviceFooter($deviceFooter)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeviceFooter', [$deviceFooter]);

        return parent::setDeviceFooter($deviceFooter);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeviceFooter()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeviceFooter', []);

        return parent::getDeviceFooter();
    }

    /**
     * {@inheritDoc}
     */
    public function setCopyText($copyText)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCopyText', [$copyText]);

        return parent::setCopyText($copyText);
    }

    /**
     * {@inheritDoc}
     */
    public function getCopyText()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCopyText', []);

        return parent::getCopyText();
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOutput(\Dmcl\AppBundle\Entity\AccessOutput $defaultOutput = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDefaultOutput', [$defaultOutput]);

        return parent::setDefaultOutput($defaultOutput);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOutput()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefaultOutput', []);

        return parent::getDefaultOutput();
    }

    /**
     * {@inheritDoc}
     */
    public function addUser(\Dmcl\AppBundle\Entity\Users $user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUser', [$user]);

        return parent::addUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUser(\Dmcl\AppBundle\Entity\Users $user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUser', [$user]);

        return parent::removeUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

}
