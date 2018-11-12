<?php

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\EpgChannels;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class Xmltv
 *
 * @package Dmcl\AppBundle\Services
 * @author dmanuelcl@gmail.com
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class Xmltv
{

    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process($epg)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $egpUrl = $epg->getSource();
        $tmpfname = tempnam("/tmp", "xmltv");
        if (preg_match("/\.gz$/", $egpUrl)) {
            $handle = gzopen($egpUrl, 'r');
            $fp = fopen($tmpfname, "w");
            umask(0000);
            while (!gzeof($handle)) {
                $contents = gzread($handle, 1000000);
                fwrite($fp, $contents);
            }
            gzclose($handle);
            $xml = simplexml_load_file($tmpfname);
//                unlink($tmpfname);
        } else {
            file_put_contents($tmpfname, file_get_contents($egpUrl));
            $xml = simplexml_load_file($egpUrl);
        }

        $channels = array();
        $channelsID = array();

        foreach ($xml->channel as $channel) {
            $epgChannel = new EpgChannels();
            $epgChannel->setName(strval($channel->{'display-name'}));
            $epgChannel->setEpg($epg);
            $epgChannel->setXmlChannel(strval($channel->attributes()->id));

            $channelsID[] = strval($channel->attributes()->id);
            $channels[strval($channel->attributes()->id)] = $epgChannel;
        }

        if (count($channelsID) == 0) {
            $channelsID = array("-1");
        }
        $epgChannels = $em->getRepository('AppBundle:EpgChannels')->findByXmlChannel($channelsID);

        foreach ($epgChannels as $epgChannel) {
            if (isset($channels[$epgChannel->getXmlChannel()])) {
                unset($channels[$epgChannel->getXmlChannel()]);
            }
        }
        $count = 0;
        foreach ($channels as $channel) {
            $count++;
            $em->persist($channel);
            $epg->addChannel($channel);
            if ($count >= 1000) {
                $em->flush();
                $count = 0;
            }
        }
        $em->flush();

        $opts = array('http' =>
            array(
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',
            )
        );

        $context = stream_context_create($opts);

//        $host = $this->container->get("request")->getHost();
        $port = $this->container->get("app.twig.extension.utils")->nodeJsPort();

        @file_get_contents("http://127.0.0.1:$port/epg/new/" . $epg->getId() . "?path=$tmpfname", false, $context);
    }


}
