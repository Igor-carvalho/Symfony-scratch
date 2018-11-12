<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PackagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array("attr"=>array("class"=>"form-control")))
            ->add('credits','integer', [
                "attr" => [
                    "class" => "form-control",
                    "min" => 0
                ]
            ])
            ->add('maxConnections','integer', [
                "attr" => [
                    "class" => "form-control",
                    "min" => 1
                ]
            ])
            ->add('duration','integer',array("attr"=>array("class"=>"form-control")))
            ->add('durationIn','choice', [
                'required' => true,
                'choices' => [
                    'hours' => 'Hours',
                    'days' => 'Days',
                    'months' => 'Months'
                ],
                'empty_data' => 'hours',
                "attr" => ["class"=>"form-control select2"]
            ])
            ->add('isTrial', null, [
                'attr' => [
                    'style' => 'cursor:pointer !important'
                ]
            ])
            ->add('status', null, [
                'attr' => [
                    'style' => 'cursor:pointer !important'
                ]
            ])
            ->add('canGenMag', null, [
                'attr' => [
                    'style' => 'cursor:pointer !important'
                ]
            ])
            ->add('canGenE2', null, [
                'attr' => [
                    'style' => 'cursor:pointer !important'
                ]
            ]);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Packages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_packages';
    }
}
