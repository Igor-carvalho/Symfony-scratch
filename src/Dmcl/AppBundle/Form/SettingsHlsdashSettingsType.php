<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsHlsdashSettingsType extends AbstractType
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
            ->add('hlsSync',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsFragment',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsPlaylistLength',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsFragmentTimeshift',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsPlaylistLengthTimeshift',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('dashPlaylistLength',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('dashFragment',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('audioBitrate1',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('audioBitrate2',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('audioBitrate3',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('videoBitrate1',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('videoBitrate2',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('videoBitrate3',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
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
