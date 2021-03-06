<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Subscriptions extends \Dmcl\AppBundle\Entity\Subscriptions implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'user', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'productType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'productId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'expired', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'expireAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'forTest', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'createdAt'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'user', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'productType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'productId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'expired', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'expireAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'forTest', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Subscriptions' . "\0" . 'createdAt'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Subscriptions $proxy) {
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

    /**
     * {@inheritDoc}
     */
    public function setProductType($productType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProductType', [$productType]);

        return parent::setProductType($productType);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProductType', []);

        return parent::getProductType();
    }

    /**
     * {@inheritDoc}
     */
    public function setProductId($productId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProductId', [$productId]);

        return parent::setProductId($productId);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProductId', []);

        return parent::getProductId();
    }

    /**
     * {@inheritDoc}
     */
    public function setExpired($expired)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpired', [$expired]);

        return parent::setExpired($expired);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpired', []);

        return parent::getExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function setExpireAt($expireAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpireAt', [$expireAt]);

        return parent::setExpireAt($expireAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpireAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpireAt', []);

        return parent::getExpireAt();
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
    public function isForTest()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isForTest', []);

        return parent::isForTest();
    }

    /**
     * {@inheritDoc}
     */
    public function setForTest($forTest)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setForTest', [$forTest]);

        return parent::setForTest($forTest);
    }

    /**
     * {@inheritDoc}
     */
    public function getForTest()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getForTest', []);

        return parent::getForTest();
    }

}
