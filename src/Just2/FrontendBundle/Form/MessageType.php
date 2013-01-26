<?php

namespace Just2\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('bodyMessage')
         //   ->add('imessage')
         //   ->add('estate')
         //   ->add('createdAt')
         //   ->add('memberOf')
            ->add('memberFor')
            ->add('dateJust')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Just2\BackendBundle\Entity\Message'
        ));
    }

    public function getName()
    {
        return 'just2_backendbundle_messagetype';
    }
}
