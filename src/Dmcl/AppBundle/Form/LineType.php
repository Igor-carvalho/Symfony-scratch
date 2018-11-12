<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dmcl\AppBundle\Repository\ChannelsPackageRepository;

class LineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(!$options['trial']){
            $builder->add('package',"choice",array(
                'choices' => array(
                    '5' => '5 Month (50 credits)',
                    '10' => '10 Month (100 credits)',
                    '15' => '15 Month (150 credits)',
                    '20' => '20 Month (200 credits)',
                ),
                "attr"=>array("class"=>"form-control select2")
            ));
        }
            
        else{
            $builder->add('package',"choice",array(
                'choices' => array(
                    '0' => 'Free Trial (0 credits)'
                ),
                "attr"=>array("class"=>"form-control select2")
            ))
            ->add('email','text',["attr"=>["class"=>"form-control"]]); 
        }
              
        $builder
            ->add('note','textarea',[
                "attr"=>["class"=>"form-control"],
                "required"=>false
            ])
            ->add('username','text',["attr"=>["class"=>"form-control"]])
			->add('channels_package',"entity",array(
                'class' => 'AppBundle:ChannelsPackage',
                'query_builder' => function (ChannelsPackageRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->where("c.enabled = true");
                },
                "required"=>false,
                "multiple"=>true,
                "attr"=>array("class"=>"select2 form-control")
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Line',
            'trial' => 0
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_line';
    }
}
