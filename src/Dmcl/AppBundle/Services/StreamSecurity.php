<?php

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Entity\Vod;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of StreamSecurity
 *
 * @author dmanuelcl@gmail.com
 */
class StreamSecurity
{

    private $container;
    private $country;
    protected $router;

    function __construct(ContainerInterface $container, UrlGeneratorInterface $router)
    {
        $this->container = $container;
        $this->router = $router;
    }

    public function secureStream($source, $server = 0, $proxy = false, $owner = null, $customer = null, $mediaType, $mediaId, $expireAt, $playlist = null)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        if (strpos($source, "rtp://@") !== false) {
            $source = str_replace(array('rtp://'), array('rtp://@'), $source);
        }
        if (strpos($source, "udp://@") !== false) {
            $source = str_replace(array('udp://'), array('udp://@'), $source);
        }
        $securityEntity = new \Dmcl\AppBundle\Entity\StreamSecurity();
        $securityEntity->setCreatedAt(new \DateTime("now"));
        $securityEntity->setDisplayed(false);
        $securityEntity->setExpireAt($expireAt);
        $securityEntity->setMediaId($mediaId);
        $securityEntity->setMediaType($mediaType);
        $securityEntity->setOwner($owner);
        $securityEntity->setServerId($server);
        $securityEntity->setCustomer($customer);
        $securityEntity->setOriginalPath($source);
        $securityEntity->setPlaylist($playlist);

        $fake = $securityEntity->createFakePath($this->container->get("app.config.services")->getGeneralConfig()->getServerAddress(), $proxy);
        $em->persist($securityEntity);
        $em->flush();

        return $fake;
    }

    public function valiateStream(Request $request)
    {
        $this->container->get("logger")->alert("dmcl: validate stream " . json_encode($request->query->all()));
        $this->container->get("logger")->alert("dmcl: validate stream " . json_encode($request->request->all()));
        $owner = "admin";
        $productsSupported = $this->container->getParameter("medias_support");
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $security = $em->getRepository('AppBundle:StreamSecurity')->findOneBy(
            array("token" => $request->get("t"))
        );
        $this->container->get("logger")->alert("dmcl-validate-stream: token " . $request->get("t"));
        if (!$security) {
            return false;
        }
        $now = new \DateTime("now");
        if ($security->getExpireAt() < $now) {
            $this->container->get("logger")->alert("dmcl-validate-stream: expired " . $request->get("t"));
            return false;
        }
        if ($security->getOwner()) {
            $this->container->get("logger")->alert("dmcl-validate-stream: owner");
            if ($request->get("o") == $security->getOwner()) {
                $this->container->get("logger")->alert("dmcl-validate-stream: owner == " . $request->get("o"));
                $owner = $security->getOwner();
                $blocked = $em->getRepository('AppBundle:ResellersBlocked')->findOneByReseller($security->getOwner());
                if ($blocked) {
                    $this->container->get("logger")->alert("dmcl-validate-stream: owner blocked ");
                    return false;
                }
            } else {
                $this->container->get("logger")->alert("dmcl-validate-stream: owner != " . $request->get("o") . ' - ' . $security->getOwner());
                return false;
            }
        }
        if ($security->getCustomer()) {
            $this->container->get("logger")->alert("dmcl-validate-stream: customer ");
            if ($request->get("c") == $security->getCustomer()) {
                $this->container->get("logger")->alert("dmcl-validate-stream: customer == " . $request->get("c"));
                $customer = $em->getRepository('AppBundle:Customers')->find($security->getCustomer());
                if (!$customer) {
                    $this->container->get("logger")->alert("dmcl-validate-stream: customer 404 ");
                    return false;
                }
                if (!$customer->getEnabled()) {
                    $this->container->get("logger")->alert("dmcl-validate-stream: customer disabled ");
                    return false;
                }
                if ($customer->getReseller()->isLocked()) {
                    $this->container->get("logger")->alert("dmcl-validate-stream: customer reseller blocked ");
                    return false;
                }

                $sessions = $em->getRepository('AppBundle:ServersSessions')->findBy(array(
                    'active' => true,
                    'playerId' => $customer->getId()
                ));
                $count = count($sessions);
                if ($customer->getConcurrentConnections() <= $count && $customer->getConcurrentConnections() != 0) {
                    $this->container->get("logger")->alert("dmcl-validate-stream: customer max sessions $count of " . $customer->getConcurrentConnections());
                    return false;
                }
            } else {
                $this->container->get("logger")->alert("dmcl-validate-stream: customer != " . $request->get("c") . ' - ' . $security->getCustomer());
                return false;
            }
        }

        if ($security->getPlaylist()) {
            $this->container->get("logger")->alert("dmcl-validate-stream: playlist ");
            $playlist = $em->getRepository('AppBundle:Playlists')->find($security->getPlaylist());
            if (!$playlist) {
                $this->container->get("logger")->alert("dmcl-validate-stream: playlist 404");
                return false;
            }
            if (!$playlist->getEnabled()) {
                $this->container->get("logger")->alert("dmcl-validate-stream: playlist disabled ");
                return false;
            }
        }
        $media = $em->getRepository('AppBundle:' . $security->getMediaType())->find($security->getMediaId());
        if (!$media) {
            $this->container->get("logger")->alert("dmcl-validate-stream: media 404 ");
            return false;
        }
        if (!$media->getEnabled()) {
            $this->container->get("logger")->alert("dmcl-validate-stream: media disabled ");
            return false;
        }

        if (!$this->isIpCountryAllowed($request->get("addr"), $owner)) {
            $this->container->get("logger")->alert("dmcl: check ip-country");
            $this->container->get("logger")->alert("dmcl-validate-stream: addr 403 " . $request->get("addr"));
            return false;
        }

        return $security;
    }


    public function isIpCountryAllowed($ip, $owner)
    {
        $this->container->get("logger")->alert("dmcl: client ip " . $ip);
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $opts = array('http' =>
            array(
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',
            )
        );
        $context = stream_context_create($opts);

        $data = @file_get_contents("http://127.0.0.1:3333/geo-ip/$ip", false, $context);
        if ($data) {
            $data = json_decode($data);
            $this->country = strtolower($data->{'country'});
            $security = $em->getRepository('AppBundle:BlockIpCountry')->findOneBy(array("country" => $data->{'country'}, "owner" => $owner));
            if ($security) {
                return false;
            }
            if ($owner != "admin") {
                $security = $em->getRepository('AppBundle:BlockIpCountry')->findOneBy(array("country" => $data->{'country'}, "owner" => "admin"));
                if ($security) {
                    return false;
                }
            }
        }

        $securities = $em->getRepository('AppBundle:BlockIpCountry')->findByEnabled(true);

        $ipTmp = $ip;
        foreach ($securities as $security) {
            $this->container->get("logger")->alert("dmcl: checking ip " . $ipTmp);
            if ($security->getIp() != "" && $security->getIp() == $ipTmp) {
                $this->container->get("logger")->alert("dmcl: ip locked " . $ipTmp);
                return false;
            }
            if ($security->getIpRange() != "") {
                $this->container->get("logger")->alert("dmcl: checking ip rande " . $security->getIpRange());
                $ip = preg_split("/\./", $ipTmp);
                if (strpos($security->getIpRange(), "-") !== false) {
                    $range = preg_split("/-/", $security->getIpRange());
                    $rangeFirst = trim($range[0]);
                    $rangeLast = trim($range[1]);
                    $rangeFirst = preg_split("/\./", $rangeFirst);
                    $rangeLast = preg_split("/\./", $rangeLast);
                    if (
                        (($rangeFirst[0] <= $ip[0] || $rangeFirst[0] == "*") && ($rangeLast[0] >= $ip[0] || $rangeLast[0] == "*")) &&
                        (($rangeFirst[1] <= $ip[1] || $rangeFirst[1] == "*") && ($rangeLast[1] >= $ip[1] || $rangeLast[1] == "*")) &&
                        (($rangeFirst[2] <= $ip[2] || $rangeFirst[2] == "*") && ($rangeLast[2] >= $ip[2] || $rangeLast[2] == "*")) &&
                        (($rangeFirst[3] <= $ip[3] || $rangeFirst[3] == "*") && ($rangeLast[3] >= $ip[3] || $rangeLast[3] == "*"))
                    ) {
                        $this->container->get("logger")->alert("dmcl: ip locked y range " . $ip . ' ' . $security->getIpRange());
                        return false;
                    }
                } else {
                    $rangeIp = preg_split("/\./", $security->getIpRange());
                    if (
                    (($rangeIp[0] == $ip[0] || $rangeIp[0] == "*") &&
                        ($rangeIp[1] == $ip[1] || $rangeIp[1] == "*") &&
                        ($rangeIp[2] == $ip[2] || $rangeIp[2] == "*") &&
                        ($rangeIp[3] <= $ip[3] || $rangeIp[3] == "*"))
                    ) {
                        $this->container->get("logger")->alert("dmcl: ip locked y range " . $ip . ' ' . $security->getIpRange());
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function country()
    {
        return $this->country;
    }

    public function secureChannel(Channel $channel, $customer, $owner = null, $expire = null, $playlist = null)
    {
        $expire = $expire ? $expire : new \DateTime("now + 5 minutes");
        $id = $channel->getId();
        $em = $this->container->get('doctrine.orm.entity_manager');
        if ($channel->getAllowLoadBalancing()) {
            $server = $this->container->get('app.util.services')->bestServer($channel->getServerForBalancing(), "Channel");
            if (!$server) {
                return null;
            }

            $server = $em->getRepository('AppBundle:Server')->find($server['id']);
            if (!$server) {
                return null;
            }
            if ($server->isProxyAgent()) {
                $proxy = $em->getRepository("AppBundle:ProxyChannels")->findOneBy(array(
                    'channel' => $channel->getToken(),
                    'server' => $server->getId()
                ));
                if ($proxy) {
                    $source = $this->container->get("app.stream.security.services")->secureStream($proxy->getBasePath(), $server->getId(), true, $owner, $customer, 'Channel', $id, $expire, $playlist);
                } else {
                    $source = $this->container->get("app.stream.security.services")->secureStream($channel->getLive(), -1, false, $owner, $customer, 'Channel', $id, $expire, $playlist);
                }
            } else {
                $originalPath = $this->container->get("app.util.services")->splitPath($channel->getLive());
                $source = $originalPath["protocol"] . "://" . $server->getIpAddress() . ":" . $originalPath["port"] . $originalPath["path"];
            }
        } else {
            $proxy = $em->getRepository("AppBundle:ProxyChannels")->findOneBy(array(
                'channel' => $channel->getToken(),
                'server' => 0
            ));
            if ($proxy) {
                $source = $this->secureStream($proxy->getBasePath(), 0, true, $owner, $customer, 'Channel', $id, $expire, $playlist);
            } else {
                $source = $this->secureStream($channel->getLive(), -1, false, $owner, $customer, 'Channel', $id, $expire, $playlist);
            }
        }
        return $source;
    }

    public function secureVod(Vod $vod, $customer, $owner = null, $expire = null, $playlist = null)
    {
        $expire = $expire ? $expire : new \DateTime("now + 5 minutes");
        $id = $vod->getId();
        $em = $this->container->get('doctrine.orm.entity_manager');

        $sources = array();
        $upload = $this->router->generate('_home', array(), true) . '/uploads';
        foreach ($vod->getSources() as $source) {
            array_push($sources, $upload . '/vod/' . $vod->getFolder() . '/' . $source->getVideo());
        }

        if ($vod->getAllowLoadBalancing()) {

            $server = $this->container->get('app.util.services')->bestServer($vod->getStoragesForBalancing(), "Vod");
            if (!$server) {
                return null;
            }

            $server = $em->getRepository('AppBundle:Storages')->find($server['id']);
            if (!$server) {
                return null;
            }

            if ($server->isProxyAgent()) {
                $proxy = $em->getRepository("AppBundle:ProxyChannels")->findOneBy(array(
                    'channel' => $vod->getToken(),
                    'server' => $server->getId()
                ));

                if ($proxy) {
                    $source = $this->secureStream($proxy->getBasePath(), $server->getId(), true, $owner, $customer, 'Vod', $id, $expire, $playlist);
                } else {
                    $source = $this->secureStream($sources[0], -1, false, $owner, $customer, 'Vod', $id, $expire, $playlist);
                }
            } else {

                $originalPath = $this->container->get("app.util.services")->splitPath($sources[0]);
                $source = $originalPath["protocol"] . "://" . $server->getIpAddress() . ":" . $server->getPort() . $server->getBaseUrl() . $originalPath["path"];
            }
        } else {

            $proxy = $em->getRepository("AppBundle:ProxyChannels")->findOneBy(array(
                'channel' => $vod->getToken(),
                'server' => 0
            ));

            if ($proxy) {

                $source = $this->secureStream($proxy->getBasePath(), 0, true, $owner, $customer, 'Vod', $id, $expire, $playlist);
            } else {
                $source = $this->secureStream($sources[0], -1, false, $owner, $customer, 'Vod', $id, $expire, $playlist);
            }
        }
        return $source;
    }
}
