<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserPaypalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paypalId', 'entity', array(
                'class' => 'Dmcl\AppBundle\Entity\Paypal',
                'property' => 'paypal_name',
                "attr"=>array("class"=>"form-control select2")
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\UserPaypal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_user_paypal';
    }
}
