<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamsServerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('serverAddress',null,array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('pass','text',array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('port','integer',array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('broadcastRTMPPort','integer',array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('broadcastHTTPPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('rtspPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('broadcastDASHPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('trialPeriodoTime', 'integer', array(
                'empty_data' => 1,
                'attr' => array('class' => 'form-control')
            ))
            ->add('nodeJsPort', 'integer', array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('dashPlaylistLength', 'integer', array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('dashFragment', 'integer', array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsSync', 'integer', array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsFragment', 'integer', array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsPlaylistLength', 'integer', array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('audioBitrate1','integer',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('audioBitrate2','integer',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('audioBitrate3','integer',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('videoBitrate1','integer',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('videoBitrate2','integer',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('videoBitrate3','integer',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsPlaylistLengthTimeshift','integer',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('hlsFragmentTimeshift','integer',array(
                "attr"=>array("class"=>"form-control ")
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\StreamsServer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_streams_server';
    }
}
