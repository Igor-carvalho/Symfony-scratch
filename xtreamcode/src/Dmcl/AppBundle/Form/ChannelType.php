<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\ChannelCategoriesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChannelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, array("attr"=>array("style"=>"color:#fff", "class"=>"form-control ")))
            ->add('category',"entity",array(
                'class' => 'AppBundle:ChannelCategories',
                'query_builder' => function (ChannelCategoriesRepository $cr) {
                    return $cr->createQueryBuilder('cc')
                        ->where("cc.enabled =true");
                },
                "required"=>true,
                'empty_value' => 'pages.channel.form.select_category',
                'empty_data' => null,
                'attr'=>array("class"=>"form-control")
            ))
            ->add('live',null,array(
                "attr"=>array("class"=>"form-control live_manage")
            ))
            ->add('enabled')
            ->add('file','file',array(
                'required'=>$options["method"]=="PUT"?false:true,
                "attr"=>array("class"=>"form-control")
            ))
           /* ->add('timeShitf', 'number', array('attr' => array('class' => 'form-control'), 'empty_data' => 0))
            ->add('audioMode', 'choice', array(
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => array(
                    '1' => 'Mono',
                    '2' => 'Stereo'
                ),
                'attr' => array('class' => 'form-control')
            ))
            ->add('transcoderLib', 'choice', array(
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => array(
                    'vlc' => 'Mode 1',
                    'ffmpeg' => 'Mode 2'
                ),
                'empty_data' => 'ffmpeg',
                'attr' => array('class' => 'form-control libs_manage')
            ))*/
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Channel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_channel';
    }
}
