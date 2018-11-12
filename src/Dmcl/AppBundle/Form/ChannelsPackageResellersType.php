<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\ChannelRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChannelsPackageResellersType extends AbstractType
{
    private $subscriptions=array();
    private $owner;
    function __construct($owner,$subscriptions)
    {
        $this->subscriptions = count($subscriptions) ==0 ? array(-1):$subscriptions;
        $this->owner =$owner;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriptions = $this->subscriptions;
        $owner = $this->owner;
        $builder
            ->add('name',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('enabled')
            /*->add('channels',"entity",array(
                'class' => 'AppBundle:Channel',
                'query_builder' => function (ChannelRepository $cr) use ($owner,$subscriptions){
                    return $cr->createQueryBuilder('c')
                        ->where("c.enabled = true AND ( c.owner = :owner OR c.id in (:subscriptions) )")
                        ->setParameter("owner",$owner)
                        ->setParameter("subscriptions",$subscriptions)
                        ;
                },
                "required"=>true,
                "multiple"=>true,
                "attr"=>array("class"=>"select2 form-control ")
            ))*/
//            ->add('description',null,array(
//                "required"=>false,
//                "attr"=>array(
//                    "class"=>"form-control",
//                    "style"=>"resize: none;min-height:100px",
//                )
//            ))
//            ->add('price',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
//            ->add('allowDiscount',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
//            ->add('discountCode',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
//            ->add('discountValue',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
//            ->add('discountMessage',"textarea",array(
//                "required"=>false,
//                "attr"=>array(
//                    "class"=>"form-control ",
//                    "style"=>"resize: none;min-height:100px",
//                )
//            ))
//            ->add('subscriptionPeriod',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
//            ->add('subscriptionInterval',"choice",array(
//                "choices"=>array(
//                    "hours" => "Hours",
//                    "days" => "Days",
//                    "months" => "Months",
//                    "years" => "Years",
//                ),
//                'empty_value' => 'pages.channel_package.form.select_interval',
//                'empty_data' => null,
//                "attr"=>array("class"=>"form-control ")
//            ))
//            ->add('forTest')
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
