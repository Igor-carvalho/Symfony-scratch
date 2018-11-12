<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('genres',null,array(
                "required"=>true,
                'empty_value' => '',
                'empty_data' => null,
            ))
            ->add('categories',null,array(
                "required"=>true,
                'empty_value' => '',
                'empty_data' => null,
            ))
            ->add('duration')
            ->add('source')
            ->add('enabled')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Ads'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_ads';
    }
}
