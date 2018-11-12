<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VodGenresType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array("attr"=>array("class"=>"form-control")))
            ->add('categorieLogoFile', 'vich_image', array(
                'required' => false,
                'allow_delete' => false,
                'download_link' => false,
                'label' => false,
                'attr' => array('class' => 'form-control')
            ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\VodGenres'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_vodgenres';
    }
}
