<?php

namespace Just2\FrontendBundle\Form;

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
            ->add('street')
            ->add('postCode')
            ->add('phone')
            ->add('mobile')
            ->add('dateOfBirth', 'date', array('years' => range(1920, date('Y'))))
            ->add('gender')
            ->add('user')
            ->add('state')
            ->add('country')
            ->add('user', new UserType())
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
