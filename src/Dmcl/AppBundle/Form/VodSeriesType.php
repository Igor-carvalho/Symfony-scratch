<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\VodGenresRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dmcl\AppBundle\Form\EventListener\GenresFieldsSubscriber;
use Symfony\Component\DependencyInjection\ContainerInterface;

class VodSeriesType extends AbstractType
{
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('coverFile', 'vich_image', array(
                'required' => false,
                "attr" => array("class"=>"form-control"),
                'allow_delete' => false,
                'download_link' => false,
                'label' => false
            ))
            ->add('year','text',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('director',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('description',"textarea", array(
                'required' => false,
                "attr"=>array(
                    "class"=>"form-control",
                    "style"=>"resize:none; min-height:100px"
                )
            ))
            ->add('enabled');

            $builder->addEventSubscriber(new GenresFieldsSubscriber($this->container));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Vod',
        ));
    }

    public function getName()
    {
        return 'app_bundle_vod_series_type';
    }
}
