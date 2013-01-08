<?php

namespace JVJ\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserFrontendType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username')
                ->add('email')
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'The two passwords must match',
                    'options' => array('label' => 'Password'),
                    'required' => true
                ))
                ->add('terms', 'checkbox', array('property_path' => 'termsAccepted'))
//            ->add('codeActivation')
//            ->add('isActive')
//            ->add('face')
//            ->add('role')
//            ->add('member')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'JVJ\UserBundle\Entity\User'
        ));
    }

    public function getName() {
        return 'jvj_userbundle_usertype';
    }

}
