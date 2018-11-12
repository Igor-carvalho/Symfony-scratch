<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dmcl\AppBundle\Repository\BouquetRepository;

class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['showPassword'])
            $builder->add('password','text',["attr"=>["class"=>"form-control"]]);
        
        $builder
            ->add('username','text',["attr"=>["class"=>"form-control"]])
            ->add('resellerNotes', 'textarea', [
                "attr"=>["class"=>"form-control"],
                "required"=>false
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Users',
            'trial' => 0,
            'showPassword' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dmcl_appbundle_users';
    }
}
