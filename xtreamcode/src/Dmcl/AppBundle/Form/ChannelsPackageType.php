<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\ChannelRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChannelsPackageType extends AbstractType
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
            ->add('enabled')
            ->add('channels',"entity",array(
                'class' => 'AppBundle:Channel',
                'query_builder' => function (ChannelRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->where("c.enabled=true");
                },
                "required"=>true,
                "multiple"=>true,
                "attr"=>array("class"=>"select2 form-control ")
            ))
            ->add('packageLogoFile', 'vich_image', array(
                'required' => false,
                'allow_delete' => false,
                'download_link' => false,
                'label' => false,
                'attr' => array('class' => 'form-control')
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\ChannelsPackage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_channelspackage';
    }
}
