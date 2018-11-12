<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\ChannelCategoriesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChannelResellerTranscoderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
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
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('allowTranscoder')
            ->add('keepOriginal',null,array(
                "attr"=>array(
                    "class"=>"keep_original_manager"
                )
            ))
            ->add('onlyAudio',null,array(
                "attr"=>array(
                    "class"=>"only_audio_manager"
                )
            ))
            ->add('source',"url",array(
                "attr"=>array("class"=>"form-control source_manage")
            ))
            /*->add('protocol',"choice",array(
                'choices' => array(
                    'rtmp' => 'RTMP',
                    'hls' => 'HLS',
                    'http' => 'HTTP',
                    'rtsp' => 'RTSP',
                    'udp' => 'UDP',
                ),
                "attr"=>array("class"=>"form-control protocols_manage")
            ))*/
            ->add('fps',null,array(
                "attr"=>array("class"=>"form-control fps_manage")
            ))
            ->add('width',null,array(
                "attr"=>array("class"=>"form-control fps_manage")
            ))
            ->add('height',null,array(
                "attr"=>array("class"=>"form-control fps_manage")
            ))
            ->add('bitRate',null,array(
                "attr"=>array("class"=>"form-control fps_manage")
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
            ->add('deinterlace')
            ->add('allowSnapShot')
            ->add('videoPids',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('audioMode',"choice",array(
                'choices' => array(
                    '2' => 'Stereo',
                    '1' => 'Mono',
                ),
                "attr"=>array("class"=>"form-control fps_manage")
            ))
            ->add('audioSamplerate',"choice",array(
                'choices' => array(
                    '8000' => '8000',
                    '11025' => '11025',
                    '22050' => '22050',
                    '44100' => '44100',
                    '48000' => '48000',
                ),
                "attr"=>array("class"=>"form-control audio_samplerate_manage fps_manage")
            ))
            ->add('audioPids',null,array(
                "attr"=>array("class"=>"form-control fps_manage")
            ))
            ->add('allowWaterMark',null,array(
                "attr"=>array(
                    "class"=>"water_manager"
                )
            ))
            ->add('waterPosition',"choice",array(
                'choices' => array(
                    '10:10' => 'Top Left Corner',
                    'main_w-overlay_w-10:10' => 'Top Right Corner',
                    '10:main_h-overlay_h-10' => 'Bottom Left Corner',
                    '(main_w-overlay_w-10):(main_h-overlay_h-10)' => 'Bottom Right Corner',
                ),
                "attr"=>array("class"=>"form-control water-control")
            ))
            ->add('fileWater','file',array(
                "required"=>false,
                "attr"=>array("class"=>"form-control water-control")
            ))
            ->add('allowTextOverlay',null,array(
                "attr"=>array(
                    "class"=>"text_overlay_manager"
                )
            ))
            ->add('textOverlaySource',null,array(
                "attr"=>array("class"=>"form-control text-overlay-control")
            ))
            ->add('textOverlaySize',null,array(
                "attr"=>array("class"=>"form-control text-overlay-control")
            ))
            ->add('textOverlayTop',null,array(
                "attr"=>array("class"=>"form-control text-overlay-control")
            ))
            ->add('textOverlayLeft',null,array(
                "attr"=>array("class"=>"form-control text-overlay-control")
            ))
            ->add('textOverlayColor',null,array(
                "attr"=>array("class"=>"form-control colorpicker colorpicker-element text-overlay-control")
            ))
            ->add('timeShitf', 'number', array('attr' => array('class' => 'form-control'), 'empty_data' => 0))
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
            ))
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
