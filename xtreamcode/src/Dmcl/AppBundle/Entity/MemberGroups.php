<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MemberGroups
 *
 * @ORM\Table(name="member_groups", indexes={@ORM\Index(name="is_admin", columns={"is_admin"}), @ORM\Index(name="is_banned", columns={"is_banned"}), @ORM\Index(name="is_reseller", columns={"is_reseller"}), @ORM\Index(name="can_delete", columns={"can_delete"})})
 * @ORM\Entity
 */
class MemberGroups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="group_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $groupId;

    /**
     * @var string
     *
     * @ORM\Column(name="group_name", type="text", length=16777215, nullable=false)
     */
    private $groupName;

    /**
     * @var string
     *
     * @ORM\Column(name="group_color", type="string", length=7, nullable=false)
     */
    private $groupColor = '#000000';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_banned", type="boolean", nullable=false)
     */
    private $isBanned = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_admin", type="boolean", nullable=false)
     */
    private $isAdmin = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_reseller", type="boolean", nullable=false)
     */
    private $isReseller;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_allowed_gen_trials", type="integer", nullable=false)
     */
    private $totalAllowedGenTrials = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="total_allowed_gen_in", type="string", length=255, nullable=false)
     */
    private $totalAllowedGenIn;

    /**
     * @var boolean
     *
     * @ORM\Column(name="delete_users", type="boolean", nullable=false)
     */
    private $deleteUsers = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="allowed_pages", type="text", length=65535, nullable=false)
     */
    private $allowedPages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="can_delete", type="boolean", nullable=false)
     */
    private $canDelete = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reseller_force_server", type="boolean", nullable=false)
     */
    private $resellerForceServer = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="create_sub_resellers_price", type="float", precision=10, scale=0, nullable=false)
     */
    private $createSubResellersPrice = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="create_sub_resellers", type="boolean", nullable=false)
     */
    private $createSubResellers = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="alter_packages_ids", type="boolean", nullable=false)
     */
    private $alterPackagesIds = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="alter_packages_prices", type="boolean", nullable=false)
     */
    private $alterPackagesPrices = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reseller_client_connection_logs", type="boolean", nullable=false)
     */
    private $resellerClientConnectionLogs = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reseller_assign_pass", type="boolean", nullable=false)
     */
    private $resellerAssignPass = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_change_pass", type="boolean", nullable=false)
     */
    private $allowChangePass = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_import", type="boolean", nullable=false)
     */
    private $allowImport = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_export", type="boolean", nullable=false)
     */
    private $allowExport = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="reseller_trial_credit_allow", type="integer", nullable=false)
     */
    private $resellerTrialCreditAllow = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="edit_mac", type="boolean", nullable=false)
     */
    private $editMac = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="edit_isplock", type="boolean", nullable=false)
     */
    private $editIsplock = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reset_stb_data", type="boolean", nullable=false)
     */
    private $resetStbData = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="reseller_bonus_package_inc", type="boolean", nullable=false)
     */
    private $resellerBonusPackageInc = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_download", type="boolean", nullable=false)
     */
    private $allowDownload = '1';

    /**
     *
     * @ORM\OneToMany(targetEntity="RegUsers", mappedBy="memberGroupId",cascade={"remove"})
     */
    private $users;


    /**
     * Get groupId
     *
     * @return integer
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Set groupName
     *
     * @param string $groupName
     *
     * @return MemberGroups
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * Get groupName
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * Set groupColor
     *
     * @param string $groupColor
     *
     * @return MemberGroups
     */
    public function setGroupColor($groupColor)
    {
        $this->groupColor = $groupColor;

        return $this;
    }

    /**
     * Get groupColor
     *
     * @return string
     */
    public function getGroupColor()
    {
        return $this->groupColor;
    }

    /**
     * Set isBanned
     *
     * @param boolean $isBanned
     *
     * @return MemberGroups
     */
    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    /**
     * Get isBanned
     *
     * @return boolean
     */
    public function getIsBanned()
    {
        return $this->isBanned;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     *
     * @return MemberGroups
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set isReseller
     *
     * @param boolean $isReseller
     *
     * @return MemberGroups
     */
    public function setIsReseller($isReseller)
    {
        $this->isReseller = $isReseller;

        return $this;
    }

    /**
     * Get isReseller
     *
     * @return boolean
     */
    public function getIsReseller()
    {
        return $this->isReseller;
    }

    /**
     * Set totalAllowedGenTrials
     *
     * @param integer $totalAllowedGenTrials
     *
     * @return MemberGroups
     */
    public function setTotalAllowedGenTrials($totalAllowedGenTrials)
    {
        $this->totalAllowedGenTrials = $totalAllowedGenTrials;

        return $this;
    }

    /**
     * Get totalAllowedGenTrials
     *
     * @return integer
     */
    public function getTotalAllowedGenTrials()
    {
        return $this->totalAllowedGenTrials;
    }

    /**
     * Set totalAllowedGenIn
     *
     * @param string $totalAllowedGenIn
     *
     * @return MemberGroups
     */
    public function setTotalAllowedGenIn($totalAllowedGenIn)
    {
        $this->totalAllowedGenIn = $totalAllowedGenIn;

        return $this;
    }

    /**
     * Get totalAllowedGenIn
     *
     * @return string
     */
    public function getTotalAllowedGenIn()
    {
        return $this->totalAllowedGenIn;
    }

    /**
     * Set deleteUsers
     *
     * @param boolean $deleteUsers
     *
     * @return MemberGroups
     */
    public function setDeleteUsers($deleteUsers)
    {
        $this->deleteUsers = $deleteUsers;

        return $this;
    }

    /**
     * Get deleteUsers
     *
     * @return boolean
     */
    public function getDeleteUsers()
    {
        return $this->deleteUsers;
    }

    /**
     * Set allowedPages
     *
     * @param string $allowedPages
     *
     * @return MemberGroups
     */
    public function setAllowedPages($allowedPages)
    {
        $this->allowedPages = $allowedPages;

        return $this;
    }

    /**
     * Get allowedPages
     *
     * @return string
     */
    public function getAllowedPages()
    {
        return $this->allowedPages;
    }

    /**
     * Set canDelete
     *
     * @param boolean $canDelete
     *
     * @return MemberGroups
     */
    public function setCanDelete($canDelete)
    {
        $this->canDelete = $canDelete;

        return $this;
    }

    /**
     * Get canDelete
     *
     * @return boolean
     */
    public function getCanDelete()
    {
        return $this->canDelete;
    }

    /**
     * Set resellerForceServer
     *
     * @param boolean $resellerForceServer
     *
     * @return MemberGroups
     */
    public function setResellerForceServer($resellerForceServer)
    {
        $this->resellerForceServer = $resellerForceServer;

        return $this;
    }

    /**
     * Get resellerForceServer
     *
     * @return boolean
     */
    public function getResellerForceServer()
    {
        return $this->resellerForceServer;
    }

    /**
     * Set createSubResellersPrice
     *
     * @param float $createSubResellersPrice
     *
     * @return MemberGroups
     */
    public function setCreateSubResellersPrice($createSubResellersPrice)
    {
        $this->createSubResellersPrice = $createSubResellersPrice;

        return $this;
    }

    /**
     * Get createSubResellersPrice
     *
     * @return float
     */
    public function getCreateSubResellersPrice()
    {
        return $this->createSubResellersPrice;
    }

    /**
     * Set createSubResellers
     *
     * @param boolean $createSubResellers
     *
     * @return MemberGroups
     */
    public function setCreateSubResellers($createSubResellers)
    {
        $this->createSubResellers = $createSubResellers;

        return $this;
    }

    /**
     * Get createSubResellers
     *
     * @return boolean
     */
    public function getCreateSubResellers()
    {
        return $this->createSubResellers;
    }

    /**
     * Set alterPackagesIds
     *
     * @param boolean $alterPackagesIds
     *
     * @return MemberGroups
     */
    public function setAlterPackagesIds($alterPackagesIds)
    {
        $this->alterPackagesIds = $alterPackagesIds;

        return $this;
    }

    /**
     * Get alterPackagesIds
     *
     * @return boolean
     */
    public function getAlterPackagesIds()
    {
        return $this->alterPackagesIds;
    }

    /**
     * Set alterPackagesPrices
     *
     * @param boolean $alterPackagesPrices
     *
     * @return MemberGroups
     */
    public function setAlterPackagesPrices($alterPackagesPrices)
    {
        $this->alterPackagesPrices = $alterPackagesPrices;

        return $this;
    }

    /**
     * Get alterPackagesPrices
     *
     * @return boolean
     */
    public function getAlterPackagesPrices()
    {
        return $this->alterPackagesPrices;
    }

    /**
     * Set resellerClientConnectionLogs
     *
     * @param boolean $resellerClientConnectionLogs
     *
     * @return MemberGroups
     */
    public function setResellerClientConnectionLogs($resellerClientConnectionLogs)
    {
        $this->resellerClientConnectionLogs = $resellerClientConnectionLogs;

        return $this;
    }

    /**
     * Get resellerClientConnectionLogs
     *
     * @return boolean
     */
    public function getResellerClientConnectionLogs()
    {
        return $this->resellerClientConnectionLogs;
    }

    /**
     * Set resellerAssignPass
     *
     * @param boolean $resellerAssignPass
     *
     * @return MemberGroups
     */
    public function setResellerAssignPass($resellerAssignPass)
    {
        $this->resellerAssignPass = $resellerAssignPass;

        return $this;
    }

    /**
     * Get resellerAssignPass
     *
     * @return boolean
     */
    public function getResellerAssignPass()
    {
        return $this->resellerAssignPass;
    }

    /**
     * Set allowChangePass
     *
     * @param boolean $allowChangePass
     *
     * @return MemberGroups
     */
    public function setAllowChangePass($allowChangePass)
    {
        $this->allowChangePass = $allowChangePass;

        return $this;
    }

    /**
     * Get allowChangePass
     *
     * @return boolean
     */
    public function getAllowChangePass()
    {
        return $this->allowChangePass;
    }

    /**
     * Set allowImport
     *
     * @param boolean $allowImport
     *
     * @return MemberGroups
     */
    public function setAllowImport($allowImport)
    {
        $this->allowImport = $allowImport;

        return $this;
    }

    /**
     * Get allowImport
     *
     * @return boolean
     */
    public function getAllowImport()
    {
        return $this->allowImport;
    }

    /**
     * Set allowExport
     *
     * @param boolean $allowExport
     *
     * @return MemberGroups
     */
    public function setAllowExport($allowExport)
    {
        $this->allowExport = $allowExport;

        return $this;
    }

    /**
     * Get allowExport
     *
     * @return boolean
     */
    public function getAllowExport()
    {
        return $this->allowExport;
    }

    /**
     * Set resellerTrialCreditAllow
     *
     * @param integer $resellerTrialCreditAllow
     *
     * @return MemberGroups
     */
    public function setResellerTrialCreditAllow($resellerTrialCreditAllow)
    {
        $this->resellerTrialCreditAllow = $resellerTrialCreditAllow;

        return $this;
    }

    /**
     * Get resellerTrialCreditAllow
     *
     * @return integer
     */
    public function getResellerTrialCreditAllow()
    {
        return $this->resellerTrialCreditAllow;
    }

    /**
     * Set editMac
     *
     * @param boolean $editMac
     *
     * @return MemberGroups
     */
    public function setEditMac($editMac)
    {
        $this->editMac = $editMac;

        return $this;
    }

    /**
     * Get editMac
     *
     * @return boolean
     */
    public function getEditMac()
    {
        return $this->editMac;
    }

    /**
     * Set editIsplock
     *
     * @param boolean $editIsplock
     *
     * @return MemberGroups
     */
    public function setEditIsplock($editIsplock)
    {
        $this->editIsplock = $editIsplock;

        return $this;
    }

    /**
     * Get editIsplock
     *
     * @return boolean
     */
    public function getEditIsplock()
    {
        return $this->editIsplock;
    }

    /**
     * Set resetStbData
     *
     * @param boolean $resetStbData
     *
     * @return MemberGroups
     */
    public function setResetStbData($resetStbData)
    {
        $this->resetStbData = $resetStbData;

        return $this;
    }

    /**
     * Get resetStbData
     *
     * @return boolean
     */
    public function getResetStbData()
    {
        return $this->resetStbData;
    }

    /**
     * Set resellerBonusPackageInc
     *
     * @param boolean $resellerBonusPackageInc
     *
     * @return MemberGroups
     */
    public function setResellerBonusPackageInc($resellerBonusPackageInc)
    {
        $this->resellerBonusPackageInc = $resellerBonusPackageInc;

        return $this;
    }

    /**
     * Get resellerBonusPackageInc
     *
     * @return boolean
     */
    public function getResellerBonusPackageInc()
    {
        return $this->resellerBonusPackageInc;
    }

    /**
     * Set allowDownload
     *
     * @param boolean $allowDownload
     *
     * @return MemberGroups
     */
    public function setAllowDownload($allowDownload)
    {
        $this->allowDownload = $allowDownload;

        return $this;
    }

    /**
     * Get allowDownload
     *
     * @return boolean
     */
    public function getAllowDownload()
    {
        return $this->allowDownload;
    }

    /**
     * Add users
     *
     * @param RegUsers $users
     * @return MemberGroups
     */
    public function addUser(RegUsers $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param RegUsers $users
     */
    public function removeUser(RegUsers $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    function __toString()
    {
        return $this->name;
    }
}
