<?php

namespace Just2\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use JVJ\UserBundle\Form\UserType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email','email')
            ->add('street')            
            // ->add('state')
            ->add('state','choice', array(
                'choices' => array(
                    'allsub' => '......All Suburbs......',
                    'opt1' => 'opt1',
                    'opt2' => 'opt2',
                    'opt3' => 'opt3',
                    'opt4' => 'opt4'
                    )
                ))
            ->add('postCode')
            ->add('country','choice', array(
                'choices' => array(                    
                    'co1' => 'Australia',
                    'co2' => 'New Zealand',
                    'co3' => 'Auckland',
                    'co4' => 'Sidney'
                    )
                ))
            ->add('phoneCode')
            ->add('phone')
            ->add('mobile')
            ->add('dateOfBirth', 'date', array('years' => range(1920, date('Y'))))

            ->add('gender')


            ->add('userId')
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The two passwords must coincide',
                'options' => array('label' => 'Password: ')
                ))


            /*->add('user', new UserType())*/
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Just2\BackendBundle\Entity\Member'
        ));
    }

    public function getName()
    {
        return 'just2_backendbundle_membertype';
    }
}
