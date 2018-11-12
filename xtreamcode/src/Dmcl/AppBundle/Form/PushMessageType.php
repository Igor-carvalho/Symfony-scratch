<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Form\DataTransformer\VodPackageTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PushMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
//            ->add('date', 'datetime', array('widget' => 'single_text'))
            ->add(
                $builder->create('date', 'text', array('attr' => array('class' => 'form-control')))
                    ->addModelTransformer(new VodPackageTransformer())
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Dmcl\AppBundle\Entity\Message'));
    }

    public function getName()
    {
        return 'app_bundle_push_message';
    }
}
