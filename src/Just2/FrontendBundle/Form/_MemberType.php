<?php

namespace Just2\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository; 
// use JVJ\UserBundle\Form\UserType;

class MemberType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('firstName')
                ->add('lastName')
                ->add('street')
                ->add('postCode')
                ->add('phone')
                ->add('mobile')
                ->add('dateOfBirth', 'date', array('years' => range(1920, date('Y'))))
                ->add('gender', 'choice', array(
                    'choices' => array('m' => 'Male', 'f' => 'Female'),
                    'required' => false,
                ))
                ->add('state')
                ->add('country')
                // ->add('user', new UserType())
                ->add('country', 'entity', array(
                    'class' => 'JVJUtilBundle:Country',
                ))
                ->add('state', 'entity', array(
                    'class' => 'JVJUtilBundle:Department',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->select()
                                ->where('u.country=1')
                                ->orderBy('u.name', 'ASC');
                    }
                ))
                // ->add('nationality', 'entity', array(
                //         'class' => 'JVJUtilBundle:Nationality',
                //     ))
                ->add('height')
                ->add('eyeColour', 'choice', array(
                    'choices' => array(
                        'black' => 'Black',
                        'brown' => 'Brown',
                        'blue' => 'Blue',
                        'green' => 'Green',
                    ),
                    'required' => true,
                ))
                ->add('hairColour', 'choice', array(
                    'choices' => array(
                        'black' => 'Black',
                        'brown' => 'Brown',
                        'blond' => 'Blond',
                        'red' => 'Red',
                    ),
                    'required' => true,
                ))
                ->add('datePreference')
                ->add('smoker', 'choice', array(
                    'choices' => array(
                        'yes' => 'Yes',
                        'no' => 'No',
                        'doubt' => "Don't specify"
                    ),
                    'required' => true,
                ))
                ->add('children', 'choice', array(
                    'choices' => array('yes' => 'Yes',
                        'no' => 'No',
                        'tba' => "To be announced"
                    ),
                    'required' => true,
                ))
                ->add('relationship', 'choice', array(
                    'choices' => array(
                        'single' => 'Single',
                        'engaged' => 'Engaged',
                        'married' => 'Married',
                        'divorced' => 'Divorced',
                        'widowed' => 'Widowed'
                    ),
                    'required' => true,
                ))
                ->add('profession', 'choice', array(
                    'choices' => array(
                        '-' => '-',
                        'tba' => "To be announced"
                    ),
                    'required' => true,
                ))
                ->add('personality', 'textarea')
                ->add('interest', 'entity', array(
                    'class' => 'Just2BackendBundle:Interest',
                    'multiple' => 'true'
                ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Just2\BackendBundle\Entity\Member'
        ));
    }

    public function getName() {
        return 'just2_backendbundle_membertype';
    }

}
