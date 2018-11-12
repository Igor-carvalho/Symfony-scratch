<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresetsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                "attr" => array("class" => "form-control ")
            ))
            ->add('fps', null, array(
                "attr" => array("class" => "form-control fps_manage")
            ))
            ->add('bitrate', null, array(
                "attr" => array(
                    "class" => "form-control fps_manage")
            ))
            ->add('width', null, array(
                "attr" => array("class" => "form-control fps_manage ")
            ))
            ->add('height', null, array(
                "attr" => array("class" => "form-control fps_manage")
            ))
            ->add('avcodec', "choice", array(
                'choices' => array(
                    'aac' => 'AAC',
                    'mp3' => 'MP3'
                ),
                "attr" => array("class" => "form-control profile_manage fps_manage")
            ))
            ->add('profile', "choice", array(
                'choices' => array(
                    'baseline' => 'Baseline',
                    'main' => 'Main',
                    'high' => 'High',
                    'high10' => 'High10',
                    'high422' => 'High422',
                    'high444' => 'High444',
                    'none' => 'None',
                ),
                "attr" => array("class" => "form-control profile_manage fps_manage")
            ))
            ->add('preset', "choice", array(
                'choices' => array(
                    'ultrafast' => 'Ultra Fast',
                    'superfast' => 'Super Fast',
                    'fast' => 'Fast',
                    'medium' => 'Medium',
                    'slow' => 'Slow',
                    'veryslow' => 'Very Slow',
                    'none' => 'None',
                ),
                "attr" => array("class" => "form-control preset_manage fps_manage")
            ))
            ->add('deinterlace')
            //->add('enabled')
            ->add('mode', "choice", array(
                'choices' => array(
                    '2' => 'Stereo',
                    '1' => 'Mono',
                ),
                "attr" => array("class" => "form-control fps_manage")
            ))
            ->add('samplerate', "choice", array(
                'choices' => array(
                    '44100' => '44100',
                    '8000' => '8000',
                    '11025' => '11025',
                    '22050' => '22050',
                    '48000' => '48000',
                ),
                "attr" => array("class" => "form-control audio_samplerate_manage fps_manage")
            ))
            ->add('crf',"choice",array(
                'choices' => $this->getValuesCrf(),
                "attr"=>array("class"=>"form-control")
            ))
            ->add('video', 'checkbox', array(
                'required' => false,
                'label'  => 'BitStream Filter Video',
            ))
            ->add('audio', 'checkbox', array(
                'required' => false,
                'label'  => 'BitStream Filter Audio',
            ));
    }

    private function getValuesCrf(){
        $result = array();
        for ($i = -1; $i <= 60; $i++){
            $result[$i] = $i;
        }
        return $result;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Presets'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dmcl_appbundle_presets';
    }

}
