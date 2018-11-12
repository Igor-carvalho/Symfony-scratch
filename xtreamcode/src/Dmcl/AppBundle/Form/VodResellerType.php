<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\VodGenresRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VodResellerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null, array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('genres',"entity",array(
                "multiple"=>true,
                'class' => 'Dmcl\AppBundle\Entity\VodGenres',
                'query_builder' =>function (VodGenresRepository $vgr) {
                    return $vgr->createQueryBuilder('vgr')
                        ->where("vgr.enabled = true");
                },
                'required'=>true,
                'empty_value' => 'pages.vod.form.select_genre',
                'empty_data' => null,
                "attr"=>array("class"=>"form-control select2")
            ))
            ->add('coverFile', 'vich_image', array(
                //'required' => $options["method"] == "PUT" ? false : true,
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
            ->add('enabled')

            ->add('price',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('description',"textarea", array(
                'required' => false,
                "attr"=>array(
                    "class"=>"form-control",
                    "style"=>"resize:none; min-height:100px"
                )
            ))
            ->add('trailer', 'url', array(
                'required' => false,
                "attr"=>array(
                    "class"=>"form-control",
                )
            ))
        ;
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
