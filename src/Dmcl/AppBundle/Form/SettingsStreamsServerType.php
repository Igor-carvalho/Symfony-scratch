<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsStreamsServerType extends AbstractType
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
            ->add('serverAddress',null,array(
                "attr"=>array(
                    "class"=>"form-control ",
                    "data-inputmask"=>"'alias': 'ip'",
                    "data-mask"=>""
                )
            ))
            ->add('refreshtime',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('broadcastRTMPPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('broadcastHTTPPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('rtspPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('trialPeriodoTime', 'integer', array(
                'empty_data' => 1,
                'attr' => array('class' => 'form-control', 'min' => 1)
            ))
            ->add('broadcastDASHPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('nodeJsPort', 'integer', array(
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
