<?php

namespace Dmcl\AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Description of Ads
 *
 * @author dmanuelcl@gmail.com
 */
class Ads
{

    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    //proxy para solicitar los servicios como si de un controlador se tratara para evitar el ->container->get(...)

    public function createAds($category = "any", $mediaType = "any", $position = "any")
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $request = $this->get("request");
        if ($category == "any") {
            $category = $em->getRepository('AppBundle:Categories')->getRandomCategory();
        } else {
            $category = $em->getRepository('AppBundle:Categories')->findOneByName($category);
        }
        $response = array();
        if ($category) {
            //$adsCookies = json_decode(base64_decode($request->cookies->get("iptv-ads")));
            $adsCookies = json_decode($request->cookies->get("livestream-ads"));
            $d = new \DateTime("now + 1 year");

            $adsEntity = null;
            $adsTmp = $category->getAds();
            foreach ($adsTmp as $adsTmpVal) {
                if (!in_array($adsTmpVal->getId(), $adsCookies->{$category->getName()})) {
                    if (in_array($mediaType, $adsTmpVal->getMediaType()) && $mediaType != "any") {
                        if ($adsTmpVal->getPostion() == $position && $position != "any") {
                            $adsEntity = $adsTmpVal;
                            break;
                        }
                    }
                }
            }

            if ($adsCookies) {
                if (isset($adsCookies->{$category->getName()})) {

                    $adsEntity = $em->getRepository('AppBundle:Ads')->findOneForAds($adsCookies->{$category->getName()}, $position);
                    if (is_array($adsEntity) && count($adsEntity) > 0) {
                        $adsEntity = $adsEntity[0];
                        $adsCookies->{$category->getName()}[] = $adsEntity->getId();
                        setcookie("livestream-ads", json_encode($adsCookies), $d->getTimestamp(), "/");
                    } else {
                        if ($adsEntity) {
                            $adsCookies->{$category->getName()} = array($adsEntity->getId());
                            setcookie("livestream-ads", json_encode($adsCookies), $d->getTimestamp(), "/");
                        }
                    }
                } else {
                    if ($adsEntity) {
                        $adsCookies->{$category->getName()} = array($adsEntity->getId());
                        setcookie("livestream-ads", json_encode($adsCookies), $d->getTimestamp(), "/");
                    }
                }

            } else {

                if ($adsEntity) {
                    $ads = array(
                        $category->getName() => array($adsEntity->getId())
                    );
                    setcookie("livestream-ads", json_encode($ads), $d->getTimestamp(), "/");
//                setcookie("livestream-ads", base64_encode(json_encode($ads)), $d->getTimestamp(), "/");
                }
            }
            if ($adsEntity) {
                $response = array(
                    "id" => $adsEntity->getId(),
                    "mediaType" => $mediaType,
                    "source" => $adsEntity->getSource(),
                    "category" => $category->getName(),
                    "duration" => $adsEntity->getDuration(),
                    "position" => $adsEntity->getPosition(),
                    "width" => $adsEntity->getWidth(),
                    "height" => $adsEntity->getHeight(),
                );
            }
        }

        return json_encode($response);
    }

    private function get($service)
    {
        return $this->container->get($service);
    }

}
