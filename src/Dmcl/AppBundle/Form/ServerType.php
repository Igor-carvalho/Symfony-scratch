<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ServerType extends AbstractType
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
            ->add('domain',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('ipAddress',null,array(
                "attr"=>array(
                    "class"=>"form-control ",
                    "data-inputmask"=>"'alias': 'ip'",
                    "data-mask"=>""
                )
            ))
            ->add('maxConnections',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('port',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('proxyAgent',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
//            ->add('serverZone',null,array(
//                "required"=>true,
//                'empty_value' => 'pages.servers.form.select_zone',
//                'empty_data' => null,
//                "attr"=>array("class"=>"form-control ")
//            ))
            ->add('sshPort',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('sshUsername',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
            ->add('sshPassword',null,array(
                "attr"=>array("class"=>"form-control ")
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Server'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_server';
    }
}
