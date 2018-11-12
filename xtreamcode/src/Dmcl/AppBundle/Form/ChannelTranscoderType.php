<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Form\EventListener\CodecFieldsSubscriber;
use Dmcl\AppBundle\Form\EventListener\CategoryFieldsSubscriber;
use Dmcl\AppBundle\Entity\Channel;
use Dmcl\AppBundle\Repository\ChannelCategoriesRepository;
use Dmcl\AppBundle\Repository\ServerRepository;
use Dmcl\AppBundle\Repository\StoragesRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChannelTranscoderType extends AbstractType
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
        if(!$options['removeFieldName']){
            $builder->add('name', null, array(
                "attr"=>array("class"=>"form-control ")
            ));
        }

        if(!$options['removeFieldSource']){//"url"
            $builder->add('source',null,array(
                "attr"=>array("class"=>"form-control source_manage")
            ));
        }

        if(!$options['removeFieldLogo']){
            $builder ->add('file','file',array(
                'required'=>false,
                "attr"=>array("class"=>"form-control")
            ));
        }

        if(!$options['removeFieldRtmp']){
            $builder ->add('rtmp', null, ['attr'=>['disabled'=>'disabled']]);
        }

        if(!$options['removeFieldHls']){
            $builder ->add('hls');
        }

        if(!$options['removeFieldDash']){
            $builder ->add('dash');
        }

        if(!$options['removeFieldHlsVariant']){
            $builder ->add('hlsVariant');
        }

        if(!$options['removeFieldProtocol']){
            $builder ->add('protocol',"choice",array(
                'choices' => array(
                    'rtsp' => 'RTSP',
                    'http' => 'HTTP'
                ),
                "attr"=>array("class"=>"form-control protocols_manage")
            ));
        }
      
        $builder->add('live',null,array(
            "attr"=>array("class"=>"form-control live_manage"),
            "read_only"=>false
        ))
        ->add('category',"entity",array(
            'class' => 'AppBundle:ChannelCategories',
            'query_builder' => function (ChannelCategoriesRepository $cr) {
                return $cr->createQueryBuilder('cc');
            },
            "required"=>true,
            'empty_value' => 'pages.channel.form.select_category',
            'empty_data' => null,
            'attr'=>array("class"=>"form-control")
        ))
        ->add('http')
        ->add('enabled')
        ->add('snaptshot')
        ->add('keepOriginalType',"choice",array(
            'choices' => array(
                'transcoder' => 'Transcoder',
                'both' => 'Audio/Video',
                'only_video' => 'Only Video',
                'only_audio' => 'Only Audio',
            ),
            "attr"=>array("class"=>"form-control")
        ))
        ->add('onlyAudio',null,array(
            "attr"=>array(
                "class"=>"only_audio_manager"
            )
        ))           
        ->add('fps',null,array(
            "attr"=>array("class"=>"form-control fps_manage")
        ))
        ->add('width',null,array(
            "attr"=>array("class"=>"form-control fps_manage ")
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
        ->add('pfmt',"choice",array(
            'choices' => array(
                'bgr24' => 'Bgr24',
                'gray8' => 'Gray8',
                'rgba' => 'Rgba',
                'yuv420p' => 'Yuv420p',
                'yuyv422' => 'Yuyv422'
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
        ->add('timeShitf', null, array('attr' => array('class' => 'form-control')))
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
        ->add('allowVideoBitStream', 'checkbox', array(
            'required' => false,
            'label'  => 'BitStream Filter',
        ))
        ->add('allowAudioBitStream', 'checkbox', array(
            'required' => false,
            'label'  => 'BitStream Filter',
        ))
        ->add('parental_lock', 'checkbox', array(
            'required' => false,
            'label'  => 'Parental Lock',
        ))
        ->add('url_proxy', 'url',array(
            'required' => false,
            "attr"=>array("class"=>"form-control")
        ))
        ->add('user_agent', 'text', array(
            'required' => false,
            "attr"=>array("class"=>"form-control")
        ))
        ->add('frame_drop', 'checkbox', array(
            'required' => false,
            'label'  => 'Frame dropping',
        ))
        ->add('reconnect', 'checkbox', array(
            'required' => false,
            'label'  => 'Reconnect',
        ))
        ->add('thread_queue', 'checkbox', array(
            'required' => false,
            'label'  => 'Thread Queue',
        ))
        ->add('crf',"choice",array(
            'choices' => $this->getValuesCrf(),
            "attr"=>array("class"=>"form-control")
        ));

        $codecs_audio = $this->container->getParameter('codecs.audio');
        $codecs_video = $this->container->getParameter('codecs.video');
        $builder->addEventSubscriber(new CodecFieldsSubscriber($codecs_audio, $codecs_video, $options['removeFieldProtocol']));
        $builder->addEventSubscriber(new CategoryFieldsSubscriber($this->container, $options['ip']));
    }

    private function getValuesCrf(){
        $result = array();
        for ($i = -1; $i <= 60; $i++){
            $result[$i] = $i;
        }
        return $result;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Channel',
            'removeFieldName' => false,
            'removeFieldSource' => false,
            'removeFieldLogo' => false,
            'removeFieldRtmp' => false,
            'removeFieldHls' => false,
            'removeFieldDash' => false,
            'removeFieldHlsVariant' => false,
            'removeFieldProtocol' => true,
            'ip' => '127.0.0.1'
        ));
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setRequired('container');
//    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_channel';
    }
}
