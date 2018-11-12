<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Form\DataTransformer\VodPackageTransformer;
use Dmcl\AppBundle\Repository\VodRepository;
use Dmcl\AppBundle\Form\EventListener\VodsFieldsSubscriber;
use Dmcl\AppBundle\Form\EventListener\GenreFieldsSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TimeshiftType extends AbstractType
{
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('preset',"choice",array(
            //     'choices' => array(
            //         'ultrafast' => 'Ultra Fast',
            //         'superfast' => 'Super Fast',
            //         'fast' => 'Fast',
            //         'medium' => 'Medium',
            //         'slow' => 'Slow',
            //         'veryslow' => 'Very Slow',
            //         'none' => 'None',
            //     ),
            //     "attr"=>array("class"=>"form-control preset_manage fps_manage")
            // ))
            ->add(
                $builder->create('startdate', 'text', array('attr' => array('class' => 'form-control')))                  
            )
            ->add(
                $builder->create('enddate', 'text', array('attr' => array('class' => 'form-control')))                  
            );

            // $builder->addEventSubscriber(new GenreFieldsSubscriber($this->container->get("app.util.services")));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Form\Model\TimeshiftModel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_timeshift';
    }
}
