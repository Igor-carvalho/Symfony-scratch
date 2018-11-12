<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsEmailSupportSettingsType extends AbstractType
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

            ->add('emailServiceType',"choice",array(
                "choices"=>array(
                    "local"=>"Local",
                    "remote"=>"Remote",
                ),
                "attr"=>array("class"=>"form-control select2")
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
                "attr"=>array("class"=>"form-control select2 email-config")
            ))
            ->add('emailEncryptionMode',"choice",array(
                "choices"=>array(
                    "tls"=>"TLS",
                    "ssl"=>"SSL",
                    "null"=>"None"
                ),
                'empty_value' => 'pages.settings.form.select_email_encryption',
                'empty_data' => null,
                "attr"=>array("class"=>"form-control select2 email-config")
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
