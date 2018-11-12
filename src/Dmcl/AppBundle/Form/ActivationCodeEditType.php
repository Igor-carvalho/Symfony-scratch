<?php

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Form\Model\ActivationCodeModel;
use Dmcl\AppBundle\Repository\ChannelsPackageRepository;
use Dmcl\AppBundle\Repository\VodPackageRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dmcl\AppBundle\Form\EventListener\VodsPackagesFieldsSubscriber;
use Dmcl\AppBundle\Form\EventListener\ChannelsPackagesFieldsSubscriber;
use Dmcl\AppBundle\Form\EventListener\CustomersFieldsSubscriber;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ActivationCodeEditType extends AbstractType
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
        $builder
            ->add('code', 'text', array(
                'read_only' => true,
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('period', 'integer', array(
                'attr' => array('class' => 'form-control', 'min' => 0),
                'empty_data' => 0,
            ))
			->add('channels_package',"entity",array(
                'class' => 'AppBundle:ChannelsPackage',
                'query_builder' => function (ChannelsPackageRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->where("c.enabled =true");
                        //->andWhere("c.owner = 'admin'");
                },
                "required"=>false,
                "multiple"=>true,
                "attr"=>array("class"=>"select2 form-control ")
            ))
			->add('vods_package',"entity",array(
                'class' => 'AppBundle:VodPackage',
                'query_builder' => function (VodPackageRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->where("c.enabled =true")
                        ->andWhere("c.typeVodPackage = 'video'");;
                        //->andWhere("c.owner = 'admin'");
                },
                "required"=>false,
                "multiple"=>true,
                "attr"=>array("class"=>"select2 form-control ")
            ))
			->add('series_package',"entity",array(
                'class' => 'AppBundle:VodPackage',
                'query_builder' => function (VodPackageRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->where("c.enabled =true")
                        ->andWhere("c.typeVodPackage = 'series'");;
                        //->andWhere("c.owner = 'admin'");
                },
                "required"=>false,
                "multiple"=>true,
                "attr"=>array("class"=>"select2 form-control ")
            ))

            ->add('customer', 'entity', array(
                'class' => 'Dmcl\AppBundle\Entity\Customers',
                'property' => 'name',
                "attr"=>array("class"=>"form-control")
            ));

            // $builder->addEventSubscriber(new VodsPackagesFieldsSubscriber($this->container->get("app.util.services"), $options['ip']));
            // $builder->addEventSubscriber(new ChannelsPackagesFieldsSubscriber($this->container->get("app.util.services"), $options['ip']));
            //$builder->addEventSubscriber(new CustomersFieldsSubscriber($this->container->get("app.util.services"), $options['ip']));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\ActivationCode',
            'ip' => '127.0.0.1'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dmcl_appbundle_activationcode';
    }
}
