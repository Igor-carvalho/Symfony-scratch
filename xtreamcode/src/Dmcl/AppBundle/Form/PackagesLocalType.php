<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PackagesLocalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array("attr"=>array("class"=>"form-control")))
            ->add('credits','integer',array("attr"=>array("class"=>"form-control")))
            ->add('period','integer',array("attr"=>array("class"=>"form-control")))
            ->add('price','integer',array("attr"=>array("class"=>"form-control")))
            ->add('superReseller', null, [
                'attr' => [
                    'style' => 'cursor:pointer !important'
                ]
            ])
            ->add('logoFile', 'vich_image', array(
                'required' => false,
                'allow_delete' => false,
                'download_link' => false,
                'label' => false,
                'attr' => array('class' => 'btn-upload__input-file')
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\PackagesLocal'
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
