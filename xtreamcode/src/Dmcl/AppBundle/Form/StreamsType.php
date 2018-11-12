<?php

namespace Dmcl\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Dmcl\AppBundle\Repository\StreamCategoriesRepository;

class StreamsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streamDisplayName','text',array("attr"=>array("class"=>"form-control")))
            ->add('streamSource','text',array("attr"=>array("class"=>"form-control")))
            ->add('category',"entity",array(
                'class' => 'AppBundle:StreamCategories',
                'query_builder' => function (StreamCategoriesRepository $c) {
                    return $c->createQueryBuilder('c');
                        
                },
                "required" => true,
                'empty_value' => 'pages.streams.select_category',
                'empty_data' => null,
                'attr'=>array("class"=>"form-control select2")
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dmcl\AppBundle\Entity\Streams'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_streams';
    }
}
