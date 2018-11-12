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

class VodPackageTranscoderCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this->setName('besttranscoder:transcoder:vodpackage');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vodPackages = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:VodPackage')->findBy(array(
            'enabled' => true,
            'allowTranscoder' => true,
            //'startTime' => date_create_from_format('m/d/Y h:i A', date('m/d/Y h:i A'))
        ));

        foreach ($vodPackages as $vodPackage) {
            $this->getContainer()->get('app.transcoder.services')->startTranscoderVodPackage($vodPackage);
        }
    }

}