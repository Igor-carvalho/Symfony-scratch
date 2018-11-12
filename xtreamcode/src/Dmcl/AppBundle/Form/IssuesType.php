<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IssuesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('issue',null,array(
                "attr"=>array(
                    "class"=>"form-control",
                    "placeholder"=>"pages.technical_issues.attrs.issue",
                )
            ))
        
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Issues'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_technical_issues';
    }
}
