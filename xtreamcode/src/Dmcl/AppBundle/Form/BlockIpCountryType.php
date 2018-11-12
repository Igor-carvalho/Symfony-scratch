<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlockIpCountryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ip',null,array(
                "attr"=>array(
                    "class"=>"form-control",
                    "data-inputmask"=>"'alias': 'ip'",
                    "data-mask"=>""
                )
            ))
            ->add('country',"country",array(
                "required"=>false,
                'empty_value' => 'pages.block_ip_country.form.select_a_country',
                'empty_data' => null,
                "attr"=>array("class"=>"form-control select2")
            ))
            ->add('ipRange',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('enabled')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\BlockIpCountry'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_blockipcountry';
    }
}
