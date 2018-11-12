<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VodEpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', 'text', array(
                "attr"=>array("class"=>"form-control")
            ))
            ->add('name', 'text',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('season', 'text',array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('date', 'text',array(
                "attr"=>array("class"=>"form-control ")
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\VodEpisode',
        ));
    }

    public function getName()
    {
        return 'app_bundle_vod_episode_type';
    }
}
