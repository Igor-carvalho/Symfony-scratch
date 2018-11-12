<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TranscoderConfigType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('httpBase',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
//            ->add('hlsBase',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
            ->add('rtmpBase',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('rtspBase',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('udpBase',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\TranscoderConfig'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_transcoderconfig';
    }
}
