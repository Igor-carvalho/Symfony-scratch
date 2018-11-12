<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LicenseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', null, array(
                "attr"=>array("class"=>"form-control"),
                "required"=>true
            ))
            
            ->add('license', null, array(
                "attr"=>array("class"=>"form-control"),
                "required"=>true
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\License'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dmcl_appbundle_license';
    }
}
