<?php

namespace Proxies\__CG__\Dmcl\AppBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class MemberGroups extends \Dmcl\AppBundle\Entity\MemberGroups implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'groupId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'groupName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'groupColor', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'isBanned', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'isAdmin', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'isReseller', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'totalAllowedGenTrials', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'totalAllowedGenIn', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'deleteUsers', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowedPages', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'canDelete', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerForceServer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'createSubResellersPrice', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'createSubResellers', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'alterPackagesIds', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'alterPackagesPrices', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerClientConnectionLogs', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerAssignPass', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowChangePass', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowImport', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowExport', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerTrialCreditAllow', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'editMac', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'editIsplock', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resetStbData', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerBonusPackageInc', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowDownload', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'users'];
        }

        return ['__isInitialized__', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'groupId', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'groupName', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'groupColor', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'isBanned', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'isAdmin', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'isReseller', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'totalAllowedGenTrials', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'totalAllowedGenIn', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'deleteUsers', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowedPages', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'canDelete', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerForceServer', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'createSubResellersPrice', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'createSubResellers', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'alterPackagesIds', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'alterPackagesPrices', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerClientConnectionLogs', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerAssignPass', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowChangePass', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowImport', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowExport', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerTrialCreditAllow', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'editMac', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'editIsplock', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resetStbData', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'resellerBonusPackageInc', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'allowDownload', '' . "\0" . 'Dmcl\\AppBundle\\Entity\\MemberGroups' . "\0" . 'users'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (MemberGroups $proxy) {
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
    public function getGroupId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getGroupId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupId', []);

        return parent::getGroupId();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroupName($groupName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroupName', [$groupName]);

        return parent::setGroupName($groupName);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupName', []);

        return parent::getGroupName();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroupColor($groupColor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroupColor', [$groupColor]);

        return parent::setGroupColor($groupColor);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupColor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupColor', []);

        return parent::getGroupColor();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsBanned($isBanned)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsBanned', [$isBanned]);

        return parent::setIsBanned($isBanned);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsBanned()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsBanned', []);

        return parent::getIsBanned();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAdmin($isAdmin)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAdmin', [$isAdmin]);

        return parent::setIsAdmin($isAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAdmin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAdmin', []);

        return parent::getIsAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsReseller($isReseller)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsReseller', [$isReseller]);

        return parent::setIsReseller($isReseller);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsReseller()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsReseller', []);

        return parent::getIsReseller();
    }

    /**
     * {@inheritDoc}
     */
    public function setTotalAllowedGenTrials($totalAllowedGenTrials)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTotalAllowedGenTrials', [$totalAllowedGenTrials]);

        return parent::setTotalAllowedGenTrials($totalAllowedGenTrials);
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalAllowedGenTrials()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTotalAllowedGenTrials', []);

        return parent::getTotalAllowedGenTrials();
    }

    /**
     * {@inheritDoc}
     */
    public function setTotalAllowedGenIn($totalAllowedGenIn)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTotalAllowedGenIn', [$totalAllowedGenIn]);

        return parent::setTotalAllowedGenIn($totalAllowedGenIn);
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalAllowedGenIn()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTotalAllowedGenIn', []);

        return parent::getTotalAllowedGenIn();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeleteUsers($deleteUsers)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeleteUsers', [$deleteUsers]);

        return parent::setDeleteUsers($deleteUsers);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeleteUsers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeleteUsers', []);

        return parent::getDeleteUsers();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowedPages($allowedPages)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowedPages', [$allowedPages]);

        return parent::setAllowedPages($allowedPages);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowedPages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowedPages', []);

        return parent::getAllowedPages();
    }

    /**
     * {@inheritDoc}
     */
    public function setCanDelete($canDelete)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCanDelete', [$canDelete]);

        return parent::setCanDelete($canDelete);
    }

    /**
     * {@inheritDoc}
     */
    public function getCanDelete()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCanDelete', []);

        return parent::getCanDelete();
    }

    /**
     * {@inheritDoc}
     */
    public function setResellerForceServer($resellerForceServer)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResellerForceServer', [$resellerForceServer]);

        return parent::setResellerForceServer($resellerForceServer);
    }

    /**
     * {@inheritDoc}
     */
    public function getResellerForceServer()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResellerForceServer', []);

        return parent::getResellerForceServer();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreateSubResellersPrice($createSubResellersPrice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreateSubResellersPrice', [$createSubResellersPrice]);

        return parent::setCreateSubResellersPrice($createSubResellersPrice);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreateSubResellersPrice()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreateSubResellersPrice', []);

        return parent::getCreateSubResellersPrice();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreateSubResellers($createSubResellers)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreateSubResellers', [$createSubResellers]);

        return parent::setCreateSubResellers($createSubResellers);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreateSubResellers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreateSubResellers', []);

        return parent::getCreateSubResellers();
    }

    /**
     * {@inheritDoc}
     */
    public function setAlterPackagesIds($alterPackagesIds)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAlterPackagesIds', [$alterPackagesIds]);

        return parent::setAlterPackagesIds($alterPackagesIds);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlterPackagesIds()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlterPackagesIds', []);

        return parent::getAlterPackagesIds();
    }

    /**
     * {@inheritDoc}
     */
    public function setAlterPackagesPrices($alterPackagesPrices)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAlterPackagesPrices', [$alterPackagesPrices]);

        return parent::setAlterPackagesPrices($alterPackagesPrices);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlterPackagesPrices()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAlterPackagesPrices', []);

        return parent::getAlterPackagesPrices();
    }

    /**
     * {@inheritDoc}
     */
    public function setResellerClientConnectionLogs($resellerClientConnectionLogs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResellerClientConnectionLogs', [$resellerClientConnectionLogs]);

        return parent::setResellerClientConnectionLogs($resellerClientConnectionLogs);
    }

    /**
     * {@inheritDoc}
     */
    public function getResellerClientConnectionLogs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResellerClientConnectionLogs', []);

        return parent::getResellerClientConnectionLogs();
    }

    /**
     * {@inheritDoc}
     */
    public function setResellerAssignPass($resellerAssignPass)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResellerAssignPass', [$resellerAssignPass]);

        return parent::setResellerAssignPass($resellerAssignPass);
    }

    /**
     * {@inheritDoc}
     */
    public function getResellerAssignPass()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResellerAssignPass', []);

        return parent::getResellerAssignPass();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowChangePass($allowChangePass)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowChangePass', [$allowChangePass]);

        return parent::setAllowChangePass($allowChangePass);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowChangePass()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowChangePass', []);

        return parent::getAllowChangePass();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowImport($allowImport)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowImport', [$allowImport]);

        return parent::setAllowImport($allowImport);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowImport()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowImport', []);

        return parent::getAllowImport();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowExport($allowExport)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowExport', [$allowExport]);

        return parent::setAllowExport($allowExport);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowExport()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowExport', []);

        return parent::getAllowExport();
    }

    /**
     * {@inheritDoc}
     */
    public function setResellerTrialCreditAllow($resellerTrialCreditAllow)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResellerTrialCreditAllow', [$resellerTrialCreditAllow]);

        return parent::setResellerTrialCreditAllow($resellerTrialCreditAllow);
    }

    /**
     * {@inheritDoc}
     */
    public function getResellerTrialCreditAllow()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResellerTrialCreditAllow', []);

        return parent::getResellerTrialCreditAllow();
    }

    /**
     * {@inheritDoc}
     */
    public function setEditMac($editMac)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEditMac', [$editMac]);

        return parent::setEditMac($editMac);
    }

    /**
     * {@inheritDoc}
     */
    public function getEditMac()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEditMac', []);

        return parent::getEditMac();
    }

    /**
     * {@inheritDoc}
     */
    public function setEditIsplock($editIsplock)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEditIsplock', [$editIsplock]);

        return parent::setEditIsplock($editIsplock);
    }

    /**
     * {@inheritDoc}
     */
    public function getEditIsplock()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEditIsplock', []);

        return parent::getEditIsplock();
    }

    /**
     * {@inheritDoc}
     */
    public function setResetStbData($resetStbData)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResetStbData', [$resetStbData]);

        return parent::setResetStbData($resetStbData);
    }

    /**
     * {@inheritDoc}
     */
    public function getResetStbData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResetStbData', []);

        return parent::getResetStbData();
    }

    /**
     * {@inheritDoc}
     */
    public function setResellerBonusPackageInc($resellerBonusPackageInc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setResellerBonusPackageInc', [$resellerBonusPackageInc]);

        return parent::setResellerBonusPackageInc($resellerBonusPackageInc);
    }

    /**
     * {@inheritDoc}
     */
    public function getResellerBonusPackageInc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResellerBonusPackageInc', []);

        return parent::getResellerBonusPackageInc();
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowDownload($allowDownload)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAllowDownload', [$allowDownload]);

        return parent::setAllowDownload($allowDownload);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowDownload()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAllowDownload', []);

        return parent::getAllowDownload();
    }

    /**
     * {@inheritDoc}
     */
    public function addUser(\Dmcl\AppBundle\Entity\RegUsers $users)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUser', [$users]);

        return parent::addUser($users);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUser(\Dmcl\AppBundle\Entity\RegUsers $users)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUser', [$users]);

        return parent::removeUser($users);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsers', []);

        return parent::getUsers();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', []);

        return parent::__toString();
    }

}
