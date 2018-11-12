<?php

namespace Dmcl\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamingServers
 *
 * @ORM\Table(name="streaming_servers", uniqueConstraints={@ORM\UniqueConstraint(name="server_ip", columns={"server_ip", "http_broadcast_port"}), @ORM\UniqueConstraint(name="server_ip_2", columns={"server_ip", "http_broadcast_port"})}, indexes={@ORM\Index(name="total_clients", columns={"total_clients"}), @ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class StreamingServers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="server_name", type="string", length=255, nullable=false)
     */
    private $serverName;

    /**
     * @var string
     *
     * @ORM\Column(name="domain_name", type="string", length=255, nullable=false)
     */
    private $domainName;

    /**
     * @var string
     *
     * @ORM\Column(name="server_ip", type="string", length=255, nullable=true)
     */
    private $serverIp;

    /**
     * @var string
     *
     * @ORM\Column(name="vpn_ip", type="string", length=255, nullable=true)
     */
    private $vpnIp;

    /**
     * @var string
     *
     * @ORM\Column(name="ssh_password", type="text", length=16777215, nullable=true)
     */
    private $sshPassword;

    /**
     * @var integer
     *
     * @ORM\Column(name="ssh_port", type="integer", nullable=true)
     */
    private $sshPort;

    /**
     * @var integer
     *
     * @ORM\Column(name="diff_time_main", type="integer", nullable=false)
     */
    private $diffTimeMain = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="http_broadcast_port", type="integer", nullable=false)
     */
    private $httpBroadcastPort;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_clients", type="integer", nullable=false)
     */
    private $totalClients = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="system_os", type="string", length=255, nullable=true)
     */
    private $systemOs;

    /**
     * @var string
     *
     * @ORM\Column(name="network_interface", type="string", length=255, nullable=false)
     */
    private $networkInterface;

    /**
     * @var float
     *
     * @ORM\Column(name="latency", type="float", precision=10, scale=0, nullable=false)
     */
    private $latency = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '-1';

    /**
     * @var integer
     *
     * @ORM\Column(name="enable_geoip", type="integer", nullable=false)
     */
    private $enableGeoip = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="geoip_countries", type="text", length=16777215, nullable=false)
     */
    private $geoipCountries;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_check_ago", type="integer", nullable=false)
     */
    private $lastCheckAgo = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="can_delete", type="boolean", nullable=false)
     */
    private $canDelete = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="server_hardware", type="text", length=65535, nullable=false)
     */
    private $serverHardware;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_services", type="integer", nullable=false)
     */
    private $totalServices = '5';

    /**
     * @var boolean
     *
     * @ORM\Column(name="persistent_connections", type="boolean", nullable=false)
     */
    private $persistentConnections = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="rtmp_port", type="integer", nullable=false)
     */
    private $rtmpPort = '8001';

    /**
     * @var string
     *
     * @ORM\Column(name="geoip_type", type="string", length=13, nullable=false)
     */
    private $geoipType = 'low_priority';

    /**
     * @var string
     *
     * @ORM\Column(name="isp_names", type="text", length=16777215, nullable=false)
     */
    private $ispNames;

    /**
     * @var string
     *
     * @ORM\Column(name="isp_type", type="string", length=13, nullable=false)
     */
    private $ispType = 'low_priority';

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable_isp", type="boolean", nullable=false)
     */
    private $enableIsp = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="boost_fpm", type="boolean", nullable=false)
     */
    private $boostFpm = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="http_ports_add", type="text", length=65535, nullable=false)
     */
    private $httpPortsAdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="network_guaranteed_speed", type="integer", nullable=false)
     */
    private $networkGuaranteedSpeed = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="https_broadcast_port", type="integer", nullable=false)
     */
    private $httpsBroadcastPort = '25463';

    /**
     * @var string
     *
     * @ORM\Column(name="https_ports_add", type="text", length=65535, nullable=false)
     */
    private $httpsPortsAdd;

    /**
     * @var string
     *
     * @ORM\Column(name="whitelist_ips", type="text", length=65535, nullable=false)
     */
    private $whitelistIps;

    /**
     * @var string
     *
     * @ORM\Column(name="watchdog_data", type="text", length=16777215, nullable=false)
     */
    private $watchdogData;

    /**
     * @var boolean
     *
     * @ORM\Column(name="timeshift_only", type="boolean", nullable=false)
     */
    private $timeshiftOnly = '0';



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serverName
     *
     * @param string $serverName
     *
     * @return StreamingServers
     */
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;

        return $this;
    }

    /**
     * Get serverName
     *
     * @return string
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * Set domainName
     *
     * @param string $domainName
     *
     * @return StreamingServers
     */
    public function setDomainName($domainName)
    {
        $this->domainName = $domainName;

        return $this;
    }

    /**
     * Get domainName
     *
     * @return string
     */
    public function getDomainName()
    {
        return $this->domainName;
    }

    /**
     * Set serverIp
     *
     * @param string $serverIp
     *
     * @return StreamingServers
     */
    public function setServerIp($serverIp)
    {
        $this->serverIp = $serverIp;

        return $this;
    }

    /**
     * Get serverIp
     *
     * @return string
     */
    public function getServerIp()
    {
        return $this->serverIp;
    }

    /**
     * Set vpnIp
     *
     * @param string $vpnIp
     *
     * @return StreamingServers
     */
    public function setVpnIp($vpnIp)
    {
        $this->vpnIp = $vpnIp;

        return $this;
    }

    /**
     * Get vpnIp
     *
     * @return string
     */
    public function getVpnIp()
    {
        return $this->vpnIp;
    }

    /**
     * Set sshPassword
     *
     * @param string $sshPassword
     *
     * @return StreamingServers
     */
    public function setSshPassword($sshPassword)
    {
        $this->sshPassword = $sshPassword;

        return $this;
    }

    /**
     * Get sshPassword
     *
     * @return string
     */
    public function getSshPassword()
    {
        return $this->sshPassword;
    }

    /**
     * Set sshPort
     *
     * @param integer $sshPort
     *
     * @return StreamingServers
     */
    public function setSshPort($sshPort)
    {
        $this->sshPort = $sshPort;

        return $this;
    }

    /**
     * Get sshPort
     *
     * @return integer
     */
    public function getSshPort()
    {
        return $this->sshPort;
    }

    /**
     * Set diffTimeMain
     *
     * @param integer $diffTimeMain
     *
     * @return StreamingServers
     */
    public function setDiffTimeMain($diffTimeMain)
    {
        $this->diffTimeMain = $diffTimeMain;

        return $this;
    }

    /**
     * Get diffTimeMain
     *
     * @return integer
     */
    public function getDiffTimeMain()
    {
        return $this->diffTimeMain;
    }

    /**
     * Set httpBroadcastPort
     *
     * @param integer $httpBroadcastPort
     *
     * @return StreamingServers
     */
    public function setHttpBroadcastPort($httpBroadcastPort)
    {
        $this->httpBroadcastPort = $httpBroadcastPort;

        return $this;
    }

    /**
     * Get httpBroadcastPort
     *
     * @return integer
     */
    public function getHttpBroadcastPort()
    {
        return $this->httpBroadcastPort;
    }

    /**
     * Set totalClients
     *
     * @param integer $totalClients
     *
     * @return StreamingServers
     */
    public function setTotalClients($totalClients)
    {
        $this->totalClients = $totalClients;

        return $this;
    }

    /**
     * Get totalClients
     *
     * @return integer
     */
    public function getTotalClients()
    {
        return $this->totalClients;
    }

    /**
     * Set systemOs
     *
     * @param string $systemOs
     *
     * @return StreamingServers
     */
    public function setSystemOs($systemOs)
    {
        $this->systemOs = $systemOs;

        return $this;
    }

    /**
     * Get systemOs
     *
     * @return string
     */
    public function getSystemOs()
    {
        return $this->systemOs;
    }

    /**
     * Set networkInterface
     *
     * @param string $networkInterface
     *
     * @return StreamingServers
     */
    public function setNetworkInterface($networkInterface)
    {
        $this->networkInterface = $networkInterface;

        return $this;
    }

    /**
     * Get networkInterface
     *
     * @return string
     */
    public function getNetworkInterface()
    {
        return $this->networkInterface;
    }

    /**
     * Set latency
     *
     * @param float $latency
     *
     * @return StreamingServers
     */
    public function setLatency($latency)
    {
        $this->latency = $latency;

        return $this;
    }

    /**
     * Get latency
     *
     * @return float
     */
    public function getLatency()
    {
        return $this->latency;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return StreamingServers
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set enableGeoip
     *
     * @param integer $enableGeoip
     *
     * @return StreamingServers
     */
    public function setEnableGeoip($enableGeoip)
    {
        $this->enableGeoip = $enableGeoip;

        return $this;
    }

    /**
     * Get enableGeoip
     *
     * @return integer
     */
    public function getEnableGeoip()
    {
        return $this->enableGeoip;
    }

    /**
     * Set geoipCountries
     *
     * @param string $geoipCountries
     *
     * @return StreamingServers
     */
    public function setGeoipCountries($geoipCountries)
    {
        $this->geoipCountries = $geoipCountries;

        return $this;
    }

    /**
     * Get geoipCountries
     *
     * @return string
     */
    public function getGeoipCountries()
    {
        return $this->geoipCountries;
    }

    /**
     * Set lastCheckAgo
     *
     * @param integer $lastCheckAgo
     *
     * @return StreamingServers
     */
    public function setLastCheckAgo($lastCheckAgo)
    {
        $this->lastCheckAgo = $lastCheckAgo;

        return $this;
    }

    /**
     * Get lastCheckAgo
     *
     * @return integer
     */
    public function getLastCheckAgo()
    {
        return $this->lastCheckAgo;
    }

    /**
     * Set canDelete
     *
     * @param boolean $canDelete
     *
     * @return StreamingServers
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
     * Set serverHardware
     *
     * @param string $serverHardware
     *
     * @return StreamingServers
     */
    public function setServerHardware($serverHardware)
    {
        $this->serverHardware = $serverHardware;

        return $this;
    }

    /**
     * Get serverHardware
     *
     * @return string
     */
    public function getServerHardware()
    {
        return $this->serverHardware;
    }

    /**
     * Set totalServices
     *
     * @param integer $totalServices
     *
     * @return StreamingServers
     */
    public function setTotalServices($totalServices)
    {
        $this->totalServices = $totalServices;

        return $this;
    }

    /**
     * Get totalServices
     *
     * @return integer
     */
    public function getTotalServices()
    {
        return $this->totalServices;
    }

    /**
     * Set persistentConnections
     *
     * @param boolean $persistentConnections
     *
     * @return StreamingServers
     */
    public function setPersistentConnections($persistentConnections)
    {
        $this->persistentConnections = $persistentConnections;

        return $this;
    }

    /**
     * Get persistentConnections
     *
     * @return boolean
     */
    public function getPersistentConnections()
    {
        return $this->persistentConnections;
    }

    /**
     * Set rtmpPort
     *
     * @param integer $rtmpPort
     *
     * @return StreamingServers
     */
    public function setRtmpPort($rtmpPort)
    {
        $this->rtmpPort = $rtmpPort;

        return $this;
    }

    /**
     * Get rtmpPort
     *
     * @return integer
     */
    public function getRtmpPort()
    {
        return $this->rtmpPort;
    }

    /**
     * Set geoipType
     *
     * @param string $geoipType
     *
     * @return StreamingServers
     */
    public function setGeoipType($geoipType)
    {
        $this->geoipType = $geoipType;

        return $this;
    }

    /**
     * Get geoipType
     *
     * @return string
     */
    public function getGeoipType()
    {
        return $this->geoipType;
    }

    /**
     * Set ispNames
     *
     * @param string $ispNames
     *
     * @return StreamingServers
     */
    public function setIspNames($ispNames)
    {
        $this->ispNames = $ispNames;

        return $this;
    }

    /**
     * Get ispNames
     *
     * @return string
     */
    public function getIspNames()
    {
        return $this->ispNames;
    }

    /**
     * Set ispType
     *
     * @param string $ispType
     *
     * @return StreamingServers
     */
    public function setIspType($ispType)
    {
        $this->ispType = $ispType;

        return $this;
    }

    /**
     * Get ispType
     *
     * @return string
     */
    public function getIspType()
    {
        return $this->ispType;
    }

    /**
     * Set enableIsp
     *
     * @param boolean $enableIsp
     *
     * @return StreamingServers
     */
    public function setEnableIsp($enableIsp)
    {
        $this->enableIsp = $enableIsp;

        return $this;
    }

    /**
     * Get enableIsp
     *
     * @return boolean
     */
    public function getEnableIsp()
    {
        return $this->enableIsp;
    }

    /**
     * Set boostFpm
     *
     * @param boolean $boostFpm
     *
     * @return StreamingServers
     */
    public function setBoostFpm($boostFpm)
    {
        $this->boostFpm = $boostFpm;

        return $this;
    }

    /**
     * Get boostFpm
     *
     * @return boolean
     */
    public function getBoostFpm()
    {
        return $this->boostFpm;
    }

    /**
     * Set httpPortsAdd
     *
     * @param string $httpPortsAdd
     *
     * @return StreamingServers
     */
    public function setHttpPortsAdd($httpPortsAdd)
    {
        $this->httpPortsAdd = $httpPortsAdd;

        return $this;
    }

    /**
     * Get httpPortsAdd
     *
     * @return string
     */
    public function getHttpPortsAdd()
    {
        return $this->httpPortsAdd;
    }

    /**
     * Set networkGuaranteedSpeed
     *
     * @param integer $networkGuaranteedSpeed
     *
     * @return StreamingServers
     */
    public function setNetworkGuaranteedSpeed($networkGuaranteedSpeed)
    {
        $this->networkGuaranteedSpeed = $networkGuaranteedSpeed;

        return $this;
    }

    /**
     * Get networkGuaranteedSpeed
     *
     * @return integer
     */
    public function getNetworkGuaranteedSpeed()
    {
        return $this->networkGuaranteedSpeed;
    }

    /**
     * Set httpsBroadcastPort
     *
     * @param integer $httpsBroadcastPort
     *
     * @return StreamingServers
     */
    public function setHttpsBroadcastPort($httpsBroadcastPort)
    {
        $this->httpsBroadcastPort = $httpsBroadcastPort;

        return $this;
    }

    /**
     * Get httpsBroadcastPort
     *
     * @return integer
     */
    public function getHttpsBroadcastPort()
    {
        return $this->httpsBroadcastPort;
    }

    /**
     * Set httpsPortsAdd
     *
     * @param string $httpsPortsAdd
     *
     * @return StreamingServers
     */
    public function setHttpsPortsAdd($httpsPortsAdd)
    {
        $this->httpsPortsAdd = $httpsPortsAdd;

        return $this;
    }

    /**
     * Get httpsPortsAdd
     *
     * @return string
     */
    public function getHttpsPortsAdd()
    {
        return $this->httpsPortsAdd;
    }

    /**
     * Set whitelistIps
     *
     * @param string $whitelistIps
     *
     * @return StreamingServers
     */
    public function setWhitelistIps($whitelistIps)
    {
        $this->whitelistIps = $whitelistIps;

        return $this;
    }

    /**
     * Get whitelistIps
     *
     * @return string
     */
    public function getWhitelistIps()
    {
        return $this->whitelistIps;
    }

    /**
     * Set watchdogData
     *
     * @param string $watchdogData
     *
     * @return StreamingServers
     */
    public function setWatchdogData($watchdogData)
    {
        $this->watchdogData = $watchdogData;

        return $this;
    }

    /**
     * Get watchdogData
     *
     * @return string
     */
    public function getWatchdogData()
    {
        return $this->watchdogData;
    }

    /**
     * Set timeshiftOnly
     *
     * @param boolean $timeshiftOnly
     *
     * @return StreamingServers
     */
    public function setTimeshiftOnly($timeshiftOnly)
    {
        $this->timeshiftOnly = $timeshiftOnly;

        return $this;
    }

    /**
     * Get timeshiftOnly
     *
     * @return boolean
     */
    public function getTimeshiftOnly()
    {
        return $this->timeshiftOnly;
    }
}
