<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class BillingConfiguration extends \Dmcl\AppBundle\Entity\BillingConfiguration implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'currency', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'salesEmail', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'salesPhone', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'salesAddress', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'ordersTtl', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'ordersTtlInterval', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'updatedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'user'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'currency', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'salesEmail', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'salesPhone', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'salesAddress', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'ordersTtl', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'ordersTtlInterval', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'updatedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\BillingConfiguration' . "\0" . 'user'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (BillingConfiguration $proxy) {
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
    public function setCurrency($currency)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCurrency', [$currency]);

        return parent::setCurrency($currency);
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCurrency', []);

        return parent::getCurrency();
    }

    /**
     * {@inheritDoc}
     */
    public function setOrdersTtl($ordersTtl)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrdersTtl', [$ordersTtl]);

        return parent::setOrdersTtl($ordersTtl);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrdersTtl()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrdersTtl', []);

        return parent::getOrdersTtl();
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
    public function setSalesEmail($salesEmail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSalesEmail', [$salesEmail]);

        return parent::setSalesEmail($salesEmail);
    }

    /**
     * {@inheritDoc}
     */
    public function getSalesEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalesEmail', []);

        return parent::getSalesEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setSalesPhone($salesPhone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSalesPhone', [$salesPhone]);

        return parent::setSalesPhone($salesPhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getSalesPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalesPhone', []);

        return parent::getSalesPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setSalesAddress($salesAddress)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSalesAddress', [$salesAddress]);

        return parent::setSalesAddress($salesAddress);
    }

    /**
     * {@inheritDoc}
     */
    public function getSalesAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalesAddress', []);

        return parent::getSalesAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setOrdersTtlInterval($ordersTtlInterval)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrdersTtlInterval', [$ordersTtlInterval]);

        return parent::setOrdersTtlInterval($ordersTtlInterval);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrdersTtlInterval()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrdersTtlInterval', []);

        return parent::getOrdersTtlInterval();
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
