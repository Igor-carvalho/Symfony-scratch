<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //new FOS\UserBundle\FOSUserBundle(),
            // new JMS\SerializerBundle\JMSSerializerBundle(),
            // new JMS\TranslationBundle\JMSTranslationBundle(),
            new Widop\PhpBBBundle\WidopPhpBBBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Ideup\SimplePaginatorBundle\IdeupSimplePaginatorBundle(),
            new TFox\MpdfPortBundle\TFoxMpdfPortBundle(),
            new Dmcl\AppBundle\AppBundle(),
            new Dmcl\StbBundle\StbBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new \Liip\ImagineBundle\LiipImagineBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');

    }

    public function initializeContainer(){
        parent::initializeContainer();
        // $config = $this->container->get("app.config.services")->getGeneralConfig();
        $timezone= "America/Havana";
        // if($config){
        //     $timezone = $config->getTimeZone();
        // }
        
        date_default_timezone_set($timezone);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/sf/cache/'.$this->environment;
        }

        return parent::getCacheDir();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/sf/logs';
        }

        return parent::getLogDir();
    }

    /**
     * @return bool
     */
    protected function isVagrantEnvironment()
    {
        return (getenv('HOME') === '/home/vagrant' || getenv('VAGRANT') === 'VAGRANT') && is_dir('/dev/shm');
    }

}
