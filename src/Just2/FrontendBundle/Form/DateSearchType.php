<?php

namespace Just2\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //interesado
            ->add('interested','choice',array(
                    'choices'   =>  array(
                        'm' =>  'Male',
                        'f' =>  'Female',                        
                        ),
                    'required'  =>  true                    
                ))
            //fichado
            ->add('gender','choice',array(
                    'choices'   =>  array(
                        'm' =>  'Men',
                        'f' =>  'Women',                        
                        ),
                    'required'  =>  true,                    
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
        return 'just2_frontendbundle_datesearchtype';
    }
}
