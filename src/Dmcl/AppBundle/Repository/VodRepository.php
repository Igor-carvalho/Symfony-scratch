<?php

namespace Dmcl\AppBundle\Repository;

use Dmcl\AppBundle\Entity\Settings;
use Dmcl\AppBundle\Entity\VodEpisode;
use Dmcl\AppBundle\Entity\VodSource;
use Dmcl\AppBundle\Utils\Util;
use Doctrine\ORM\EntityRepository;

/**
 * VodRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VodRepository extends EntityRepository
{
    public function findChannelsAvailableForAdd($id)
    {
        return $this->createQueryBuilder("v")
            ->where("v.enabled =true")
            ->andWhere("v.id not in (:id) and v.owner=:owner")
            ->setParameter("id", $id)
            ->setParameter("owner", "admin")
            ->getQuery()
            ->getResult();
    }

    /**
     * This function is used for listing all videos in array format
     */
    public function listVodAsArray($upload)
    {
        $qb = $this->getEntityManager()->createQueryBuilder('c');
        $qb
            ->select('v', 's', 'g')
            ->from('AppBundle:Vod', 'v')
            ->leftjoin('v.sources', 's')
            ->leftjoin('v.genres', 'g')
            ->where("v.typeVod = :type")
            ->setParameter("type", "video");

        $result = $qb->getQuery()->getArrayResult();

        $setting = $this->getEntityManager()->getRepository('AppBundle:Settings')->findOneById(1);
        $address = $setting->getServerAddress();
        $HTTPPort = $setting->getBroadcastHTTPPort();
        $RTMPPort = $setting->getBroadcastRTMPPort();
        $DASHPort = $setting->getBroadcastDASHPort();


        foreach ($result as $key => $data) {
            if (filter_var($data['cover'], FILTER_VALIDATE_URL)) {
                $result[$key]['cover'] = $data['cover'];
            } else {
                $result[$key]['cover'] = $upload . '/vod_cover/' . $data['cover'];
            }
            foreach ($data['sources'] as $key1 => $source) {
                if(!parse_url($source['video'], PHP_URL_SCHEME)) {
                    $result[$key]['sources'][$key1]['httpurl'] = 'http://' . $address . ':' . $HTTPPort . '/' . $source['video'];
                    $result[$key]['sources'][$key1]['rtmpurl'] = 'rtmp://' . $address . ':' . $RTMPPort . '/vod/' . $source['video'];
                    $result[$key]['sources'][$key1]['hlsurl'] = 'http://' . $address . ':' . $HTTPPort . '/vod-files/' . $source['video'] . '/index.m3u8';
                    $result[$key]['sources'][$key1]['dashurl'] = 'http://' . $address . ':' . $DASHPort . '/vod-files/' . $source['video'] . '/manifest.mpd';
                } else {
                    $result[$key]['sources'][$key1]['httpurl'] = $source['video'];
                    $result[$key]['sources'][$key1]['rtmpurl'] = $source['video'];
                    $result[$key]['sources'][$key1]['hlsurl'] = $source['video'];
                    $result[$key]['sources'][$key1]['dashurl'] = $source['video'];
                }
                unset($result[$key]['sources'][$key1]['trailer'], $result[$key]['sources'][$key1]['trailerDuration'], $result[$key]['sources'][$key1]['trailerSize']);
            }
            unset($result[$key]['token'], $result[$key]['allowLoadBalancing'], $result[$key]['enabled'], $result[$key]['createdAt'], $result[$key]['updatedAt'], $result[$key]['price'], $result[$key]['allowDiscount'], $result[$key]['discountCode'], $result[$key]['discountValue'], $result[$key]['discountMessage'], $result[$key]['owner'], $result[$key]['folder']);
        }
        return $result;
    }

    public function getVodAsArray($id, $upload, $type = 'video')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('v', 's', 'g')
            ->from('AppBundle:Vod', 'v')
            ->leftjoin('v.sources', 's')
            ->leftjoin('v.genres', 'g')
            ->where("v.id = :id")
            ->andWhere("v.typeVod = :type")
            ->setParameter("id", $id)
            ->setParameter("type", $type);

        $result = $qb->getQuery()->getArrayResult();

        $setting = $this->getEntityManager()->getRepository('AppBundle:Settings')->findOneById(1);
        $address = $setting->getServerAddress();
        $HTTPPort = $setting->getBroadcastHTTPPort();
        $RTMPPort = $setting->getBroadcastRTMPPort();
        $DASHPort = $setting->getBroadcastDASHPort();

        foreach ($result as $key => $data) {
            if (filter_var($data['cover'], FILTER_VALIDATE_URL)) {
                $result[$key]['cover'] = $data['cover'];
            } else {
                $result[$key]['cover'] = $upload . '/vod_cover/' . $data['cover'];
            }
            foreach ($data['sources'] as $key1 => $source) {
                $result[$key]['sources'][$key1]['httpurl'] = 'http://' . $address . ':' . $HTTPPort . '/' . $source['video'];
                $result[$key]['sources'][$key1]['rtmpurl'] = 'rtmp://' . $address . ':' . $RTMPPort . '/vod/' . $source['video'];
                $result[$key]['sources'][$key1]['hlsurl'] = 'http://' . $address . ':' . $HTTPPort . '/vod-files/' . $source['video'] . '/index.m3u8';
                $result[$key]['sources'][$key1]['dashurl'] = 'http://' . $address . ':' . $DASHPort . '/vod-files/' . $source['video'] . '/manifest.mpd';

                unset(
                    $result[$key]['sources'][$key1]['id'],
                    $result[$key]['sources'][$key1]['enabled'],
                    $result[$key]['sources'][$key1]['trailer'],
                    $result[$key]['sources'][$key1]['trailerDuration'],
                    $result[$key]['sources'][$key1]['trailerSize']
                );
            }

            foreach ($data['genres'] as $key1 => $genre) {
                unset(
                    $result[$key]['genres'][$key1]['enabled'],
                    $result[$key]['genres'][$key1]['createdAt'],
                    $result[$key]['genres'][$key1]['updatedAt']
                );
            }

            unset(
                $result[$key]['typeVod'],
                $result[$key]['token'],
                $result[$key]['ageRestriction'],
                $result[$key]['ageRating'],
                $result[$key]['allowLoadBalancing'],
                $result[$key]['enabled'],
                $result[$key]['createdAt'],
                $result[$key]['updatedAt'],
                $result[$key]['price'],
                $result[$key]['allowDiscount'],
                $result[$key]['discountCode'],
                $result[$key]['discountValue'],
                $result[$key]['discountMessage'],
                $result[$key]['subscriptionPeriod'],
                $result[$key]['subscriptionInterval'],
                $result[$key]['owner'],
                $result[$key]['folder']
            );
        }
        if(!empty($result[0]['sources'])){
            $result[0]['video'] = $result[0]['sources'][0];
        }
        unset($result[0]['sources']);

        return empty($result[0]) ? array() : $result[0];
    }

    /**
     * This function is used for listing all series in array format
     */
    public function listSeriesAsArray()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('v', 'g')
            ->from('AppBundle:Vod', 'v')
            ->leftjoin('v.genres', 'g')
            ->where("v.typeVod = :type")
            ->setParameter("type", "series");

        $result = $qb->getQuery()->getArrayResult();

        $setting = $this->getEntityManager()->getRepository('AppBundle:Settings')->findOneById(1);
        $address = $setting->getServerAddress();
        $port = $setting->getBroadcastHTTPPort();
        foreach ($result as $key => $data) {

            $episodes = $this->getEntityManager()->getRepository("AppBundle:VodEpisode")->findByVod($data['id']);
            /**
             * @var VodEpisode $episode
             */
            foreach ($episodes as $key1 => $episode) {
                $result[$key]['episodes'][$key1]['id'] = $episode->getId();
                $result[$key]['episodes'][$key1]['name'] = $episode->getName();
                $result[$key]['episodes'][$key1]['number'] = $episode->getNumber();
                $result[$key]['episodes'][$key1]['season'] = $episode->getSeason();
                $result[$key]['episodes'][$key1]['date'] = $episode->getDate();
                $result[$key]['episodes'][$key1]['path'] =
                    !parse_url($episode->getPath(), PHP_URL_SCHEME) ?
                        'http://' . $address . ':' . $port . '/' . $episode->getPath() :
                        $episode->getPath();
            }
            unset($result[$key]['token'], $result[$key]['allowLoadBalancing'], $result[$key]['enabled'], $result[$key]['createdAt'], $result[$key]['updatedAt'], $result[$key]['price'], $result[$key]['allowDiscount'], $result[$key]['discountCode'], $result[$key]['discountValue'], $result[$key]['discountMessage'], $result[$key]['owner'], $result[$key]['folder']);
        }
        return $result;
    }

    /**
     * This function is used for listing one series in array format
     */
    public function listSelectedSeriesAsArray($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('v', 'g')
            ->from('AppBundle:Vod', 'v')
            ->leftjoin('v.genres', 'g')
            ->where("v.id = :id and v.typeVod = :type")
            ->setParameter("id", $id)
            ->setParameter("type", "series");

        $result = $qb->getQuery()->getArrayResult();

        // Actual setting.
        $setting = $this->getEntityManager()->getRepository('AppBundle:Settings')->findOneById(1);
        $address = $setting->getServerAddress();
        $port = $setting->getBroadcastHTTPPort();

        foreach ($result as $key => $data) {
            $episodes = $this->getEntityManager()->getRepository("AppBundle:VodEpisode")->findByVod($data['id']);
            foreach ($episodes as $key1 => $episode) {
                $result[$key]['episodes'][$key1]['id'] = $episode->getId();
                $result[$key]['episodes'][$key1]['name'] = $episode->getName();
                $result[$key]['episodes'][$key1]['number'] = $episode->getNumber();
                $result[$key]['episodes'][$key1]['season'] = $episode->getSeason();
                $result[$key]['episodes'][$key1]['date'] = $episode->getDate();
                if(Util::isUrl($episode->getPath())) {
                    $result[$key]['episodes'][$key1]['path'] = $episode->getPath();
                }
                else {
                    $result[$key]['episodes'][$key1]['path'] = 'http://' . $address . ':' . $port . '/' . $episode->getPath();
                }
            }
            unset(/*$result[$key]['description'],*/
                $result[$key]['sources'], $result[$key]['token'], $result[$key]['allowLoadBalancing'], $result[$key]['enabled'], $result[$key]['createdAt'], $result[$key]['updatedAt'], $result[$key]['price'], $result[$key]['allowDiscount'], $result[$key]['discountCode'], $result[$key]['discountValue'], $result[$key]['discountMessage'], $result[$key]['owner'], $result[$key]['folder']);
        }
        return $result;
    }
}