<?php
/**
 * Created by PhpStorm.
 * User: Lazaro Garcia Martinez
 * Email: lazaro3487@gmail.com
 * Date: 06/05/2016
 * Time: 12:23
 */

namespace Dmcl\AppBundle\Command;

use Dmcl\AppBundle\Entity\VodPackage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VodPackageTranscoderCheckCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this->setName('besttranscoder:transcoder:vodpackagecheck');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vodPackages = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:VodPackage')->findBy(array(
            'transcoderRunning' => true
        ));

        foreach ($vodPackages as $vodPackage) {

            $pid = $vodPackage->getTranscoderPid();

            /**
             * Si no existe este proceso significa que el transcoder se detuvo,
             * por tal motivo tengo que actualizar el sistema
             */
            if ($pid && !file_exists("/proc/$pid")) {
                $this->getContainer()->get('app.transcoder.services')->stopTranscoderVodPackage($vodPackage);
            }
        }
    }

}