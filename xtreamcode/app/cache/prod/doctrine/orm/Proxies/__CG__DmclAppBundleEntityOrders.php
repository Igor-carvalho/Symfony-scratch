<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Orders extends \Dmcl\AppBundle\Entity\Orders implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'customer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'customerName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'customerEmail', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'transactionId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'currency', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'amount', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'amountReal', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'verified', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'expireAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'expired', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'verifiedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'products', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'discount', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'createdAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'gateway'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'customer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'customerName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'customerEmail', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'transactionId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'currency', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'amount', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'amountReal', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'verified', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'expireAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'expired', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'verifiedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'products', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'discount', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'createdAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\Orders' . "\0" . 'gateway'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Orders $proxy) {
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
    public function setCustomer($customer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomer', [$customer]);

        return parent::setCustomer($customer);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomer', []);

        return parent::getCustomer();
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomerName($customerName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomerName', [$customerName]);

        return parent::setCustomerName($customerName);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomerName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomerName', []);

        return parent::getCustomerName();
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomerEmail($customerEmail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomerEmail', [$customerEmail]);

        return parent::setCustomerEmail($customerEmail);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomerEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomerEmail', []);

        return parent::getCustomerEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setTransactionId($transactionId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTransactionId', [$transactionId]);

        return parent::setTransactionId($transactionId);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransactionId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTransactionId', []);

        return parent::getTransactionId();
    }

    /**
     * {@inheritDoc}
     */
    public function setAmount($amount)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAmount', [$amount]);

        return parent::setAmount($amount);
    }

    /**
     * {@inheritDoc}
     */
    public function getAmount()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAmount', []);

        return parent::getAmount();
    }

    /**
     * {@inheritDoc}
     */
    public function setVerified($verified)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVerified', [$verified]);

        return parent::setVerified($verified);
    }

    /**
     * {@inheritDoc}
     */
    public function getVerified()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVerified', []);

        return parent::getVerified();
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
    public function setVerifiedAt($verifiedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVerifiedAt', [$verifiedAt]);

        return parent::setVerifiedAt($verifiedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getVerifiedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVerifiedAt', []);

        return parent::getVerifiedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setProducts($products)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProducts', [$products]);

        return parent::setProducts($products);
    }

    /**
     * {@inheritDoc}
     */
    public function getProducts()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProducts', []);

        return parent::getProducts();
    }

    /**
     * {@inheritDoc}
     */
    public function setDiscount($discount)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiscount', [$discount]);

        return parent::setDiscount($discount);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiscount()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiscount', []);

        return parent::getDiscount();
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
    public function to_float()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'to_float', []);

        return parent::to_float();
    }

    /**
     * {@inheritDoc}
     */
    public function setGateway(\Dmcl\AppBundle\Entity\Gateways $gateway = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGateway', [$gateway]);

        return parent::setGateway($gateway);
    }

    /**
     * {@inheritDoc}
     */
    public function getGateway()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGateway', []);

        return parent::getGateway();
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
    public function setAmountReal($amountReal)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAmountReal', [$amountReal]);

        return parent::setAmountReal($amountReal);
    }

    /**
     * {@inheritDoc}
     */
    public function getAmountReal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAmountReal', []);

        return parent::getAmountReal();
    }

}
