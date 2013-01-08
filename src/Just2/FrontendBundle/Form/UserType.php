<?php

namespace Just2\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Just2\FrontendBundle\Form\MemberType;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('member', new MemberType())
                ->add('username')
                ->add('email', 'email')
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'The two passwords must match',
                    'options' => array('label' => 'Password'),
                    'required' => true
                ))
                ->add('terms', 'checkbox', array('property_path' => 'termsAccepted'))
        //->add('codeActivation')
        // ->add('isActive')
        // ->add('face', 'file')
        // ->add('role')

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'JVJ\UserBundle\Entity\User',
            'validation_groups' => array('registration')
        ));
    }

    public function getName() {
        return 'jvj_userbundle_usertype';
    }

}
