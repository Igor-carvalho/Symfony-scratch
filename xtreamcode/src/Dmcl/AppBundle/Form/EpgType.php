<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EpgType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('source',"url",array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('serverRecorder',null,array(
                "attr"=>array(
                    "class"=>"form-control ",
                    "data-inputmask"=>"'alias': 'ip'",
                    "data-mask"=>""
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Epg'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_epg';
    }
}
