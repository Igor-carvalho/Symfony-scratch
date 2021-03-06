<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GatewaysType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shopIdPublicKey',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('secretKey',null,array(
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
            'data_class' => 'Dmcl\AppBundle\Entity\Gateways'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_gateways';
    }
}
