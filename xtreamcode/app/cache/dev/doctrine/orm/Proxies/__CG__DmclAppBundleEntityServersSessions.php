<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ServersSessions extends \Dmcl\AppBundle\Entity\ServersSessions implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'token', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'serverType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'serverId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'playerId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'playStartAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'finishedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'active'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'id', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'token', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'serverType', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'serverId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'playerId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'playStartAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'finishedAt', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\ServersSessions' . "\0" . 'active'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ServersSessions $proxy) {
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
    public function setServerType($serverType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServerType', [$serverType]);

        return parent::setServerType($serverType);
    }

    /**
     * {@inheritDoc}
     */
    public function getServerType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServerType', []);

        return parent::getServerType();
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
    public function setPlayerId($playerId)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlayerId', [$playerId]);

        return parent::setPlayerId($playerId);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayerId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlayerId', []);

        return parent::getPlayerId();
    }

    /**
     * {@inheritDoc}
     */
    public function setPlayStartAt($playStartAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlayStartAt', [$playStartAt]);

        return parent::setPlayStartAt($playStartAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getPlayStartAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlayStartAt', []);

        return parent::getPlayStartAt();
    }

    /**
     * {@inheritDoc}
     */
    public function isActive()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isActive', []);

        return parent::isActive();
    }

    /**
     * {@inheritDoc}
     */
    public function setActive($active)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setActive', [$active]);

        return parent::setActive($active);
    }

    /**
     * {@inheritDoc}
     */
    public function getFinishedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFinishedAt', []);

        return parent::getFinishedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setFinishedAt($finishedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFinishedAt', [$finishedAt]);

        return parent::setFinishedAt($finishedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function setToken($token)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setToken', [$token]);

        return parent::setToken($token);
    }

    /**
     * {@inheritDoc}
     */
    public function getToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getToken', []);

        return parent::getToken();
    }

    /**
     * {@inheritDoc}
     */
    public function getActive()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getActive', []);

        return parent::getActive();
    }

}
