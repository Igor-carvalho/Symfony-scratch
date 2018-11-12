<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegUsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('username', null, array(
                "required"=>true,
                "attr"=>array("class"=>"form-control")
            ))
            ->add('email', 'email', array(
                "required"=>true,
                "attr"=>array("class"=>"form-control")
            ))
            ->add('credits', 'integer', array(
                "required"=>true,
                "attr"=>array("class"=>"form-control", "min"=>0)
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\RegUsers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dmcl_appbundle_user';
    }
}
