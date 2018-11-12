<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmcl\AppBundle\Form;

use Dmcl\AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('file', 'file', array('required' => false, 'label' => 'pages.profile.details.avatar', 'translation_domain' => 'messages'))
            ->add('name', null, array('label' => 'pages.profile.details.name', 'translation_domain' => 'messages'))
            ->add('country',"country",array(
                "required"=>true,
                'empty_value' => 'pages.user.form.select_a_country',
                'empty_data' => null,
                "attr"=>array("class"=>"form-control select2")
            ))
            ->add('address', "text", array('label' => 'pages.profile.details.address', 'translation_domain' => 'messages'))
            ->add('phone', null, array(
                    'label' => 'pages.profile.details.phone',
                    'translation_domain' => 'messages',
                    'attr' => array(
                        'data-inputmask' => '"mask": "(999) 999-9999"',
                        'data-mask' => null
                    ))
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\User',
            'intention'  => 'profile',
        ));
    }

    public function getName()
    {
        return 'app_user_profile';
    }

}
