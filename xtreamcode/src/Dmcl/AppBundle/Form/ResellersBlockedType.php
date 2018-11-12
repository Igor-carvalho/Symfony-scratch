<?php

namespace Dmcl\AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResellersBlockedType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reseller',"entity",array(
                'empty_value' => 'pages.resellers_blocked.form.select_a_reseller',
                'empty_data' => null,
                'class' => 'AppBundle:User',
                'query_builder' => function (EntityRepository $ur) {
                    return $ur->createQueryBuilder('u')
                        ->where("u.enabled =true")
                        ->andWhere('u.roles LIKE CONCAT(\'%\', \'ROLE_RESELLER\', \'%\')');
                },
                "attr"=>array(
                    "class"=>"form-control select2",
                )
            ))
            ->add('reason',null,array(
                "attr"=>array(
                    "class"=>"form-control compose-textarea",
                    "style"=>"height: 300px",
                    "placeholder"=>"pages.tickets.attrs.message",
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
            'data_class' => 'Dmcl\AppBundle\Entity\ResellersBlocked'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_resellersblocked';
    }
}
