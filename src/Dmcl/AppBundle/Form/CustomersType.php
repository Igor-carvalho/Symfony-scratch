<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Repository\PlaylistsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomersType extends AbstractType
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
            ->add('username',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('concurrentConnections',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('password',"password",array(
                "required"=>false,
                "attr"=>array("class"=>"form-control ")
            ))
//            ->add('code',null,array(
//                "attr"=>array("class"=>"form-control ")
//            ))
            ->add('email',"email",array(
                "attr"=>array("class"=>"form-control ")
            ))
//            ->add('macs',"choice",array(
//                "required"=>false,
//                "multiple"=>true,
//                "attr"=>array("class"=>"form-control select2-tag")
//            ))
            ->add('enabled')
            ->add('country',"country",array(
                'empty_value' => 'pages.customers.form.select_a_country',
                'empty_data' => null,
                "attr"=>array("class"=>"select2 form-control")
            ))
//            ->add('playlists',"entity",array(
//                "required"=>false,
//                'class' => 'AppBundle:Playlists',
//                'query_builder' => function (PlaylistsRepository $cr) {
//                    return $cr->createQueryBuilder('pl')
//                        ->where("pl.enabled =true");
//                },
//                "multiple"=>true,
//                "attr"=>array("class"=>"form-control select2")
//            ))
//			if($options['block_name'] != 'reseller') {
//			$builder->add('paypalId', 'entity', array(
//					'class' => 'Dmcl\AppBundle\Entity\Paypal',
//					'property' => 'paypal_name',
//					"attr"=>array("class"=>"form-control select2")
//				));
//			}
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Customers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_customers';
    }
}
