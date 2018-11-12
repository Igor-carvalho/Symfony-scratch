<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsSystemSettingsType extends AbstractType
{
    private $container;

    /**
     * SettingsType constructor.
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('notifyResellers')
            ->add('allowRegistration')
            ->add('allowResellersTranscoder')
            ->add('allowResellersAddChannels')
            ->add('allowResellersAddVod')
            ->add('allowResellersBlockIp')

            ->add('resellersLimit',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('maxConcurrentConnections',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('timeForUpdates',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
//            ->add('vodUploadDir',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
//            ->add('vodBaseUrl',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Settings'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_settings';
    }
}
