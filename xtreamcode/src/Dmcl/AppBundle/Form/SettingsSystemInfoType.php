<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsSystemInfoType extends AbstractType
{
    private $container;

    /**
     * SettingsType constructor.
     * @param $container
     */
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
            ->add('serverName',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('timeZone',"timezone", array(
                "attr" => array(
                    "class" => "selectpicker show-tick select2",
                    'data-live-search' => true,
                    'title' => $this->container->get('translator')->trans('pages.settings.attrs.time_zone_placeholder')
                )
            ))
            ->add('companyPhone',null,array(
                "attr"=>array("class"=>"form-control ",
                    "data-inputmask"=>'"mask": "(999) 999-9999"',
                    "data-mask"=>""
                )
            ))
            ->add('companyEmailSupport',"email",array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('companyAddress',null,array(
                "attr"=>array(
                    "class"=>"form-control ",
                    "style"=>"resize: none;min-height:75px",
                )
            ))
            ->add('aboutUs',null,array(
                "attr"=>array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"resize: none; min-height:250px"
                )
            ))
            ->add('servicesDescription',null,array(
                "attr"=>array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"resize: none;min-height:250px"
                )
            ))
            ->add('news', null, array(
                'required' => false,
                "attr" => array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"resize: none;min-height:250px"
                )
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Settings'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_settings';
    }
}
