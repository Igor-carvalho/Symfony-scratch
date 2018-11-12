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

class VodPackageType extends AbstractType
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
        if($options['is_series']){
            $builder->add('typeVodPackage', 'hidden', array(
                "data"=> 'series'
            ));
        }
        $builder
            ->add('name',null, array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('enabled')
            ->add('allowTranscoder')
            ->add('repeatTranscoderProcess')
            ->add('fps', 'integer', array(
                'required' => false,
                "attr" => array("class" => "form-control"),
                'empty_data' => 15
            ))
            ->add('width', 'integer', array(
                'required' => false,
                "attr"=>array("class"=>"form-control"),
                'empty_data' => 760
            ))
            ->add('bitrate', 'integer', array(
                'required' => false,
                "attr"=>array("class"=>"form-control"),
                'empty_data' => 600
            ))
            ->add('height', 'integer', array(
                'required' => false,
                "attr"=>array("class"=>"form-control"),
                'empty_data' => 570
            ))
            ->add('packageLogoFile', 'vich_image', array(
                'required' => false,
                'allow_delete' => false,
                'download_link' => false,
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('profile',"choice",array(
                'choices' => array(
                    'baseline' => 'Baseline',
                    'main' => 'Main',
                    'high' => 'High',
                    'high10' => 'High10',
                    'high422' => 'High422',
                    'high444' => 'High444',
                    'none' => 'None',
                ),
                "attr"=>array("class"=>"form-control profile_manage fps_manage")
            ))
            ->add('preset',"choice",array(
                'choices' => array(
                    'ultrafast' => 'Ultra Fast',
                    'superfast' => 'Super Fast',
                    'fast' => 'Fast',
                    'medium' => 'Medium',
                    'slow' => 'Slow',
                    'veryslow' => 'Very Slow',
                    'none' => 'None',
                ),
                "attr"=>array("class"=>"form-control preset_manage fps_manage")
            ))
            ->add('crf','integer', array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('allowVideoBitStream', 'checkbox', array(
                'required' => false,
                'label'  => 'BitStream Video Filter',
            ))
            ->add('allowAudioBitStream', 'checkbox', array(
                'required' => false,
                'label'  => 'BitStream Audio Filter',
            ));

            //$builder->addEventSubscriber(new VodsFieldsSubscriber($this->container->get("app.util.services"), $options['is_series'], $options['ip']));
            //$builder->addEventSubscriber(new GenreFieldsSubscriber($this->container->get("app.util.services")));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\VodPackage',
            'is_series' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_vodpackage';
    }
}
