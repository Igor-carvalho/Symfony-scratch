<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BillingConfigurationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currency',"currency",array(
                "attr"=>array("class"=>"form-control select2")
            ))
            ->add('ordersTtl',null,array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('ordersTtlInterval',"choice",array(
                "choices"=>array(
                    "hours" => "Hours",
                    "days" => "Days",
                    "months" => "Months",
                    "years" => "Years",
                ),
                "attr"=>array("class"=>"form-control select2"
                )))
            ->add('salesAddress',null,array(
                "attr"=>array(
                    "class"=>"form-control ",
                    "style"=>"resize: none;min-height:75px",
                )
            ))
            ->add('salesEmail',null,array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('salesPhone',null,array(
                "attr"=>array(
                    "class"=>"form-control ",
                    "data-inputmask"=>'"mask": "(999) 999-9999"',
                    "data-mask"=>""
                )
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\BillingConfiguration'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_billingconfiguration';
    }
}