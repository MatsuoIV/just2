<?php

namespace Just2\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateJustType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('detailDate')
            ->add('minPrice')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('estate')
            ->add('member')
            ->add('ocassion')
            ->add('venue')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Just2\BackendBundle\Entity\DateJust'
        ));
    }

    public function getName()
    {
        return 'just2_backendbundle_datejusttype';
    }
}
