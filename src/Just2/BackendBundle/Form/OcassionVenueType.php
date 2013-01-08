<?php

namespace Just2\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
// use JVJ\UserBundle\Form\UserType;
use Doctrine\ORM\EntityRepository; 

class OcassionVenueType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			// ->add('categoryOcassion','entity',array(
			// 	'class' =>	'Just2BackendBundle:CategoryOcassion',
			// 	))
			->add('ocassion','entity',array(
				'class'	=>	'Just2BackendBundle:OcassionVenue',
				))
			// ->add('zipcode')
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Just2\BackendBundle\Entity\OcassionVenue'
			));
	}

	public function getName() {
		return 'just2_backendbundle_ocassionvenuetype';
	}
}