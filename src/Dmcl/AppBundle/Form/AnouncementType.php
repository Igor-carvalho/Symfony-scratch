<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnouncementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('anouncement', null, array(
                "attr" => array(
                    "class" => "form-control compose-textarea",
                    "style" => "height: 300px"
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Anouncement'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'dmcl_appbundle_anouncement';
    }
}
