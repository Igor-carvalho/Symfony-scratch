<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TechnicalIssuesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if($options["attr"]["allowTo"]){
            $builder
                ->add('toEmail',"email",array(
                    "required"=>true,
                    "attr"=>array(
                        "class"=>"form-control",
                        "placeholder"=>"pages.technical_issues.attrs.to_email",
                    )
                ));
        }
        $builder
            ->add('subject',null,array(
                "attr"=>array(
                    "class"=>"form-control",
                    "placeholder"=>"pages.technical_issues.attrs.subject",
                )
            ))
            ->add('message',null,array(
                "attr"=>array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"height: 300px",
                    "placeholder"=>"pages.technical_issues.attrs.message",
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
            'data_class' => 'Dmcl\AppBundle\Entity\TechnicalIssues'
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
