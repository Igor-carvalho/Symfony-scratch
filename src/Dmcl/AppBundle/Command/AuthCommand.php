<?php

namespace Dmcl\AppBundle\Command;

use Dmcl\AppBundle\Entity\ActivationCode;
use Dmcl\AppBundle\Entity\ActiveCodeChannels;
use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Entity\ChannelsPackage;
use Dmcl\AppBundle\Entity\Playlists;
use Dmcl\AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AuthCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:auth')
            ->setDescription('Auth for a request to channel')
            ->addOption("live", null, InputOption::VALUE_OPTIONAL, "Channel requested")
            ->addOption("token", null, InputOption::VALUE_OPTIONAL, "Channel token");
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $live = $input->getOption("live");
        $hash = $input->getOption("token");

        $container = $this->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');

        $users = $em->getRepository("AppBundle:User")->findAll();

//        if ($ip) {
//            /**
//             * @var User $user
//             */
//            foreach ($users as $user) {
//                if ($user->hasRole(User::ROLE_SUPER_ADMIN) && $user->hasAdminIp($ip)) {
//                    $output->write("200 OK");
//                    return;
//                }
//            }
//        }

        if ($live && $hash) {
            //User authentication
            $userRepository = $em->getRepository('AppBundle:User');
            /**
             * @var User $user
             */
            $user = $userRepository->findOneBy(array("hash" => $hash));
            if ($user && $user->isSuperAdmin() || $userRepository->hasChannel($user->getId(), $live)) {
                $output->write("200 OK");
                return;
            } else {
                /**
                 * @var ActivationCode $activeCode
                 */
                $activeCode = $em->getRepository("AppBundle:ActivationCode")->findOneByHash($hash);
                if ($activeCode != null) {
                    // Activation Code Security
                    if ($activeCode->getEndDate() > new \DateTime()) {
                        /**
                         * @var ChannelsPackage $channelsPackage
                         */
                        if ($this->checkChannels($activeCode->getChannelsPackage(), $live)) {
                            $output->write("200 OK");
                            return;
                        }
                    }
                } else {
                    // Playlist Security
                    /**
                     * @var User $user
                     */
                    foreach ($users as $user) {
                        if ($user->getPlaylistHash() == $hash) {
                            if ($user->getPlaylistExpiration() > new \DateTime()) {
                                $playlistCollection = $user->getPlaylistAssigned();
                                /**
                                 * @var Playlists $playlist
                                 */
                                foreach ($playlistCollection as $playlist) {
                                    if ($this->checkChannels($playlist->getChannelsPackages(), $live)) {
                                        $output->write("200 OK");
                                        return;
                                    }
                                }
                                $output->write("403 Forbidden");
                                return;
                            }
                        }
                    }
                }
            }
        }
        $output->write("403 Forbidden");
    }

    private function checkChannels($packages, $live)
    {
        /**
         * @var ChannelsPackage $channelsPackage
         */
        foreach ($packages as $channelsPackage) {
            /**
             * @var Channel $channel
             */
            foreach ($channelsPackage->getChannels() as $channel) {
                if ($channel->getLive() == $live) {
                    return true;
                }
            }
        }
        return false;
    }
}