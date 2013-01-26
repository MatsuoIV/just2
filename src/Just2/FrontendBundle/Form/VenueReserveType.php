<?php

namespace Just2\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VenueReserveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //fecha de cita
            ->add('venuedate')
            //hora de cita
            ->add('venuetime')
            //fecha de comienzo de subasta
            ->add('venuestart')
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
        return 'just2_frontendbundle_venuereservetype';
    }
}
