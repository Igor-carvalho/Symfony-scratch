<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
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
                    "class" => "select2 form-control",
                    'data-live-search' => true,
                    'title' => $this->container->get('translator')->trans('pages.settings.attrs.time_zone_placeholder')
                )
            ))
            //->add('file')
            //->add('notifyResellers')
            //->add('allowRegistration')
            /*->add('allowResellersTranscoder')
            ->add('allowResellersAddChannels')
            ->add('allowResellersAddVod')
            ->add('allowResellersBlockIp')*/
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
            ->add('serverAddress',null,array(
                "attr"=>array(
                    "class"=>"form-control ",
                    "data-inputmask"=>"'alias': 'ip'",
                    "data-mask"=>""
                )
            ))
            ->add('broadcastRTMPPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('broadcastHTTPPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))/*
            ->add('hlsPath','text',array(
                "attr"=>array(
                    "class"=>"form-control ",
                )
            ))
            ->add('resellersLimit',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('maxConcurrentConnections',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('timeForUpdates',null,array(
                "attr"=>array("class"=>"form-control ")
            ))*/
            ->add('aboutUs',null,array(
                "attr"=>array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"resize: none;min-height:250px",
                )
            ))
            ->add('servicesDescription',null,array(
                "attr"=>array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"resize: none;min-height:250px",
                )
            ))
            ->add('emailServiceType',"choice",array(
                "choices"=>array(
                    "local"=>"Local",
                    "remote"=>"Remote",
                ),
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('emailSender',"email",array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('emailHost',null,array(
                "attr"=>array("class"=>"form-control email-config")
            ))
            ->add('emailPort',null,array(
                "attr"=>array("class"=>"form-control email-config")
            ))
            ->add('emailUsername',null,array(
                "attr"=>array("class"=>"form-control email-config")
            ))
            ->add('emailPassword',"password",array(
                "attr"=>array("class"=>"form-control email-config")
            ))
            ->add('emailAuthenticationMode',"choice",array(
                "choices"=>array(
                    "plain"=>"Plain",
                    "login"=>"Login",
                    "cram-md5"=>"Cram-md5",
                    "null"=>"None",
                ),
                'empty_value' => 'pages.settings.form.select_email_authentication',
                'empty_data' => null,
                "attr"=>array("class"=>"form-control  email-config")
            ))
            ->add('emailEncryptionMode',"choice",array(
                "choices"=>array(
                    "tls"=>"TLS",
                    "ssl"=>"SSL",
                    "null"=>"None"
                ),
                'empty_value' => 'pages.settings.form.select_email_encryption',
                'empty_data' => null,
                "attr"=>array("class"=>"form-control  email-config")
            ))
            ->add('vodUploadDir',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('vodBaseUrl',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('news', null, array(
                'required' => false,
                "attr" => array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"resize: none;min-height:250px",
                )
            ))
            ->add('trialPeriodoTime', 'integer', array(
                'empty_data' => 1,
                'attr' => array('class' => 'form-control', 'min' => 1)
            ))
            ->add('broadcastDASHPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('nodeJsPort', 'integer', array(
                "attr"=>array("class"=>"form-control ")
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
