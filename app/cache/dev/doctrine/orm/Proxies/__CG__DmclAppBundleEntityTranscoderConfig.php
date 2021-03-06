<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class TranscoderConfig extends \Dmcl\AppBundle\Entity\TranscoderConfig implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'httpBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'hlsBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'rtmpBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'rtspBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'udpBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'type', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'user'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'httpBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'hlsBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'rtmpBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'rtspBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'udpBase', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'type', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\TranscoderConfig' . "\0" . 'user'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (TranscoderConfig $proxy) {
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
    public function setHttpBase($httpBase)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHttpBase', [$httpBase]);

        return parent::setHttpBase($httpBase);
    }

    /**
     * {@inheritDoc}
     */
    public function getHttpBase()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHttpBase', []);

        return parent::getHttpBase();
    }

    /**
     * {@inheritDoc}
     */
    public function setHlsBase($hlsBase)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHlsBase', [$hlsBase]);

        return parent::setHlsBase($hlsBase);
    }

    /**
     * {@inheritDoc}
     */
    public function getHlsBase()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHlsBase', []);

        return parent::getHlsBase();
    }

    /**
     * {@inheritDoc}
     */
    public function setRtmpBase($rtmpBase)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRtmpBase', [$rtmpBase]);

        return parent::setRtmpBase($rtmpBase);
    }

    /**
     * {@inheritDoc}
     */
    public function getRtmpBase()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRtmpBase', []);

        return parent::getRtmpBase();
    }

    /**
     * {@inheritDoc}
     */
    public function setRtspBase($rtspBase)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRtspBase', [$rtspBase]);

        return parent::setRtspBase($rtspBase);
    }

    /**
     * {@inheritDoc}
     */
    public function getRtspBase()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRtspBase', []);

        return parent::getRtspBase();
    }

    /**
     * {@inheritDoc}
     */
    public function setUdpBase($udpBase)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUdpBase', [$udpBase]);

        return parent::setUdpBase($udpBase);
    }

    /**
     * {@inheritDoc}
     */
    public function getUdpBase()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUdpBase', []);

        return parent::getUdpBase();
    }

    /**
     * {@inheritDoc}
     */
    public function setType($type)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', [$type]);

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', []);

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', [$user]);

        return parent::setUser($user);
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
