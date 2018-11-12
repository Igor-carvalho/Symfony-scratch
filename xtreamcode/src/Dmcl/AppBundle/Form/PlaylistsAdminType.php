<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Controller\Admin\VodPackageResellersController;
use Dmcl\AppBundle\Repository\ChannelRepository;
use Dmcl\AppBundle\Repository\ChannelsPackageRepository;
use Dmcl\AppBundle\Repository\VodPackageRepository;
use Dmcl\AppBundle\Repository\VodRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlaylistsAdminType extends AbstractType
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
//            ->add('expireAt',"text",array(
//                "attr"=>array("class"=>"form-control datepicker")
//            ))
            ->add('channels',"entity",array(
                'class' => 'AppBundle:Channel',
                'query_builder' => function (ChannelRepository $cr){
                    return $cr->createQueryBuilder('cr')
                        ->where("cr.enabled = true AND cr.owner = :owner")
                        ->setParameter("owner","admin");
                },
                "multiple"=>true,
                "required"=>false,
                "attr"=>array("class"=>"form-control select2 ")
            ))
            ->add('vods',"entity",array(
                'class' => 'AppBundle:Vod',
                'query_builder' => function (VodRepository $vr){
                    return $vr->createQueryBuilder('vr')
                        ->where("vr.enabled = true AND vr.owner = :owner")
                        ->setParameter("owner","admin");
                },
                "multiple"=>true,
                "required"=>false,
                "attr"=>array("class"=>"form-control select2 ")
            ))
            ->add('channelsPackages',"entity",array(
                'class' => 'AppBundle:ChannelsPackage',
                'query_builder' => function (ChannelsPackageRepository $cpr){
                    return $cpr->createQueryBuilder('cpr')
                        ->where("cpr.enabled = true AND cpr.owner = :owner")
                        ->setParameter("owner","admin");
                },
                "multiple"=>true,
                "required"=>false,
                "attr"=>array("class"=>"form-control select2 ")
            ))
            ->add('vodPackages',"entity",array(
                'class' => 'AppBundle:VodPackage',
                'query_builder' => function (VodPackageRepository $vpr){
                    return $vpr->createQueryBuilder('vpr')
                        ->where("vpr.enabled = true AND vpr.owner = :owner")
                        ->setParameter("owner","admin");
                },
                "multiple"=>true,
                "required"=>false,
                "attr"=>array("class"=>"form-control select2")
            ))
    ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Playlists'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_playlists';
    }
}
