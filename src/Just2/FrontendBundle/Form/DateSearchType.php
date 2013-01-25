<?php

namespace Just2\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer;

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
            //edades
            ->add('age1','integer')
            ->add('age2','integer')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'age1' => 18,
            'age2' => 19,
        ));
    }

    public function getName()
    {
        return 'just2_frontendbundle_datesearchtype';
    }
}
