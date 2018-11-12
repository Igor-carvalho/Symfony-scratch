<?php

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Entity\Vod;
use Dmcl\AppBundle\Entity\VodSource;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Description of M3U
 *
 * @author dmanuelcl@gmail.com
 */
class M3U
{

    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function generateM3U($playlist, $owner, $customer, $byAdmin = false)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        if (!$playlist) {
            throw $this->createNotFoundException('Unable to find Playlists entity.');
        }
        $m3u_data = "#EXTM3U\n";
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $index = 1;
        foreach ($playlist->getChannels() as $channel) {
            if ($channel->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $channel->getId(),
                    "expired" => false,
                    "productType" => "channel",
                ));
                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }
                    $live = $this->container->get("app.stream.security.services")->secureChannel($channel, $customer, $owner, $expireAt, $playlist->getId());
                    if ($live) {
                        $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $channel->getName() . "\n";
                        $m3u_data .= $live . "\n";
                    }
                }
            }
        }

        foreach ($playlist->getChannelsPackages() as $channelPackage) {
            if ($channelPackage->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $channelPackage->getId(),
                    "expired" => false,
                    "productType" => "channels_package",
                ));

                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }
                    foreach ($channelPackage->getChannels() as $channel) {
                        if ($channel->getEnabled()) {
                            $live = $this->container->get("app.stream.security.services")->secureChannel($channel, $customer, $owner, $expireAt, $playlist->getId());
                            if ($live) {
                                $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $channel->getName() . "\n";
                                $m3u_data .= $live . "\n";
                            }
                        }
                    }
                }
            }
        }

        foreach ($playlist->getVods() as $vod) {
            if ($vod->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $vod->getId(),
                    "expired" => false,
                    "productType" => "vod",
                ));

                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }

                    $source = $this->container->get("app.stream.security.services")->secureVod($vod, $customer, $owner, $expireAt, $playlist->getId());
                    if ($source) {
                        $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $vod->getTitle() . "\n";
                        $m3u_data .= $source . "\n";
                    }
                }
            }
        }

        foreach ($playlist->getVodPackages() as $vodPackage) {
            if ($vodPackage->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $vodPackage->getId(),
                    "expired" => false,
                    "productType" => "vod_package",
                ));
                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }
                    foreach ($vodPackage->getVods() as $vod) {
                        if ($vod->getEnabled()) {
                            $source = $this->container->get("app.stream.security.services")->secureVod($vod, $customer, $owner, $expireAt, $playlist->getId());
                            if ($source) {
                                $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $vod->getTitle() . "\n";
                                $m3u_data .= $source . "\n";
                            }
                        }
                    }
                }
            }
        }

        return $m3u_data;
    }

    public function generateM3U_V2($playlist, $hash = "")
    {
        $m3u_data = "#EXTM3U\n";
        $index = 1;
        /**
         * @var Channel $channel
         */
        foreach ($playlist->getChannels() as $channel) {
            if ($channel->getEnabled()) {
                $live = $channel->getLive();
                if ($live) {
                    $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $channel->getName() . "\n";
                    $m3u_data .= $live . '?t=' . $hash . "\n";
                }
            }
        }

        foreach ($playlist->getChannelsPackages() as $channelPackage) {
            if ($channelPackage->getEnabled()) {
                foreach ($channelPackage->getChannels() as $channel) {
                    if ($channel->getEnabled()) {
                        $live = $channel->getLive();
                        if ($live) {
                            $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $channel->getName() . "\n";
                            $m3u_data .= $live .  '?t=' . $hash . "\n";
                        }
                    }
                }
            }
        }

        $setting = $this->container->get("doctrine.orm.default_entity_manager")
            ->getRepository("AppBundle:Settings")
            ->find(1);

        /**
         * @var Vod $vod
         */
        foreach ($playlist->getVods() as $vod) {
            if ($vod->getEnabled()) {
                /**
                 * @var VodSource $source
                 */
                $source = $vod->getSources()[0];
                if ($source) {
                    $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $vod->getTitle() . "\n";
                    $m3u_data .= 'http://' . $setting->getServerAddress() . ':' . $setting->getBroadcastHTTPPort()
                        . '/vod-files/' . $source->getVideo() . '/index.m3u8' . '?t=' . $hash . "\n";
                }
            }
        }

        foreach ($playlist->getVodPackages() as $vodPackage) {
            if ($vodPackage->getEnabled()) {
                foreach ($vodPackage->getVods() as $vod) {
                    if ($vod->getEnabled()) {
                        /**
                         * @var VodSource $source
                         */
                        $source = $vod->getSources()[0];
                        if ($source) {
                            $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $vod->getTitle() . "\n";
                            $m3u_data .= 'http://' . $setting->getServerAddress() . ':' . $setting->getBroadcastHTTPPort()
                                . '/vod-files/' . $source->getVideo() . '/index.m3u8' . '?t=' . $hash . "\n";
                        }
                    }
                }
            }
        }

        return $m3u_data;
    }

    public function generateM3U2($playlist, $owner, $customer, $byAdmin = false)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        if (!$playlist) {
            throw $this->createNotFoundException('Unable to find Playlists entity.');
        }
        $m3u_data = "#EXTM3U\n";
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $index = 1;
        foreach ($playlist->getChannels() as $channel) {
            if ($channel->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $channel->getId(),
                    "expired" => false,
                    "productType" => "channel",
                ));
                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }
                    $live = $this->container->get("app.stream.security.services")->secureChannel($channel, $customer, $owner, $expireAt, $playlist->getId());
                    if ($live) {
                        $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $channel->getName() . "\n";
                        $m3u_data .= $live . "\n";
                    }
                }
            }
        }

        foreach ($playlist->getChannelsPackages() as $channelPackage) {
            if ($channelPackage->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $channelPackage->getId(),
                    "expired" => false,
                    "productType" => "channels_package",
                ));

                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }
                    foreach ($channelPackage->getChannels() as $channel) {
                        if ($channel->getEnabled()) {
                            $live = $this->container->get("app.stream.security.services")->secureChannel($channel, $customer, $owner, $expireAt, $playlist->getId());
                            if ($live) {
                                $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $channel->getName() . "\n";
                                $m3u_data .= $live . "\n";
                            }
                        }
                    }
                }
            }
        }

        foreach ($playlist->getVods() as $vod) {
            if ($vod->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $vod->getId(),
                    "expired" => false,
                    "productType" => "vod",
                ));

                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }

                    $source = $this->container->get("app.stream.security.services")->secureVod($vod, $customer, $owner, $expireAt, $playlist->getId());
                    if ($source) {
                        $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $vod->getTitle() . "\n";
                        $m3u_data .= $source . "\n";
                    }
                }
            }
        }

        foreach ($playlist->getVodPackages() as $vodPackage) {
            if ($vodPackage->getEnabled()) {
                $expireAt = new \DateTime($playlist->getExpireAt());
                $subscription = $em->getRepository('AppBundle:Subscriptions')->findOneBy(array(
                    "user" => $currentUser,
                    "productId" => $vodPackage->getId(),
                    "expired" => false,
                    "productType" => "vod_package",
                ));
                if ($subscription || $byAdmin) {
                    if ($subscription && $subscription->getExpireAt() < $expireAt) {
                        $expireAt = $subscription->getExpireAt();
                    }
                    foreach ($vodPackage->getVods() as $vod) {
                        if ($vod->getEnabled()) {
                            $source = $this->container->get("app.stream.security.services")->secureVod($vod, $customer, $owner, $expireAt, $playlist->getId());
                            if ($source) {
                                $m3u_data .= "#EXTINF:0," . $index++ . '. ' . $vod->getTitle() . "\n";
                                $m3u_data .= $source . "\n";
                            }
                        }
                    }
                }
            }
        }

        return $m3u_data;
    }
}
