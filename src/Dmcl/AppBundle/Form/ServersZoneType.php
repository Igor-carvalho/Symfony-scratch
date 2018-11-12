<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServersZoneType extends AbstractType
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
            ->add('countries',"country",array(
                "multiple"=>true,
                "attr"=>array("class"=>"form-control select2")
            ))
            ->add('hasDefault',null,array(
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
            'data_class' => 'Dmcl\AppBundle\Entity\ServersZone'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_serverszone';
    }
}
