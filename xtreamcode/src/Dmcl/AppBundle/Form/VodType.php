<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\StoragesRepository;
use Dmcl\AppBundle\Repository\VodGenresRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dmcl\AppBundle\Form\EventListener\GenresFieldsSubscriber;

class VodType extends AbstractType
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
            ->add('year', 'text', array(
                "attr"=>array("class"=>"form-control")
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
            ->add('enabled')
            ->add('trailer', 'url', array(
                'required' => false,
                "attr"=>array(
                    "class"=>"form-control"
                )
            ));

        $builder->addEventSubscriber(new GenresFieldsSubscriber($this->container));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Vod'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_vod';
    }
}
