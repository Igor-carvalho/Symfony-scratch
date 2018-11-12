<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class StreamsArguments extends \Dmcl\AppBundle\Entity\StreamsArguments implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentCat', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentDescription', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentWprotocol', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentKey', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentCmd', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentDefaultValue'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentCat', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentDescription', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentWprotocol', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentKey', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentCmd', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\StreamsArguments' . "\0" . 'argumentDefaultValue'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (StreamsArguments $proxy) {
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
    public function setArgumentCat($argumentCat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentCat', [$argumentCat]);

        return parent::setArgumentCat($argumentCat);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentCat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentCat', []);

        return parent::getArgumentCat();
    }

    /**
     * {@inheritDoc}
     */
    public function setArgumentName($argumentName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentName', [$argumentName]);

        return parent::setArgumentName($argumentName);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentName', []);

        return parent::getArgumentName();
    }

    /**
     * {@inheritDoc}
     */
    public function setArgumentDescription($argumentDescription)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentDescription', [$argumentDescription]);

        return parent::setArgumentDescription($argumentDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentDescription', []);

        return parent::getArgumentDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setArgumentWprotocol($argumentWprotocol)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentWprotocol', [$argumentWprotocol]);

        return parent::setArgumentWprotocol($argumentWprotocol);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentWprotocol()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentWprotocol', []);

        return parent::getArgumentWprotocol();
    }

    /**
     * {@inheritDoc}
     */
    public function setArgumentKey($argumentKey)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentKey', [$argumentKey]);

        return parent::setArgumentKey($argumentKey);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentKey()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentKey', []);

        return parent::getArgumentKey();
    }

    /**
     * {@inheritDoc}
     */
    public function setArgumentCmd($argumentCmd)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentCmd', [$argumentCmd]);

        return parent::setArgumentCmd($argumentCmd);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentCmd()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentCmd', []);

        return parent::getArgumentCmd();
    }

    /**
     * {@inheritDoc}
     */
    public function setArgumentType($argumentType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentType', [$argumentType]);

        return parent::setArgumentType($argumentType);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentType', []);

        return parent::getArgumentType();
    }

    /**
     * {@inheritDoc}
     */
    public function setArgumentDefaultValue($argumentDefaultValue)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setArgumentDefaultValue', [$argumentDefaultValue]);

        return parent::setArgumentDefaultValue($argumentDefaultValue);
    }

    /**
     * {@inheritDoc}
     */
    public function getArgumentDefaultValue()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArgumentDefaultValue', []);

        return parent::getArgumentDefaultValue();
    }

}