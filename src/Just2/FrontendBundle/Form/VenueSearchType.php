<?php

namespace Just2\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VenueSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //ocassion
            ->add('ocassion','entity',array(
                    'class' => 'Just2BackendBundle:Ocassion'                    
                ))
            //suburb
            ->add('suburb','entity',array(
                    'class' => 'JVJUtilBundle:Suburb',
                    'empty_value' => 'Choose an option',
                    'required' => false                    
                ))
            ->add('distance','choice',array(
                    'choices' => array(
                        5  => '5',
                        10 => '10',
                        20 => '20',
                        30 => '30'),
                    'empty_value' => 'Choose a distance',
                    'required' => false
                ))
        ;
    }

    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => ''
    //     ));
    // }

    public function getName()
    {
        return 'just2_frontendbundle_venuesearchtype';
    }
}
