<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class StreamLogs extends \Dmcl\AppBundle\Entity\StreamLogs implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'serverId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'date', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'error', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'stream'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'serverId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'date', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'error', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamLogs' . "\0" . 'stream'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (StreamLogs $proxy) {
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
    public function setServerId($serverId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServerId', [$serverId]);

        return parent::setServerId($serverId);
    }

    /**
     * {@inheritDoc}
     */
    public function getServerId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServerId', []);

        return parent::getServerId();
    }

    /**
     * {@inheritDoc}
     */
    public function setDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDate', [$date]);

        return parent::setDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDate', []);

        return parent::getDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setError($error)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setError', [$error]);

        return parent::setError($error);
    }

    /**
     * {@inheritDoc}
     */
    public function getError()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getError', []);

        return parent::getError();
    }

    /**
     * {@inheritDoc}
     */
    public function setStream(\Dmcl\AppBundle\Entity\Streams $stream = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStream', [$stream]);

        return parent::setStream($stream);
    }

    /**
     * {@inheritDoc}
     */
    public function getStream()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStream', []);

        return parent::getStream();
    }

}
