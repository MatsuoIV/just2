<?php

namespace Just2\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;  
use Doctrine\ORM\EntityRepository;

class LocationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $factory = $builder->getFormFactory();
 
        $builder->add('province','entity',array(
                       'class' => 'Just2\BackendBundle\Entity\Province',
                       'property' => 'name'));
 
        $refreshLocality = function ($form, $province) use ($factory) {
            $form->add($factory->createNamed('entity','locality',null, array(
                'class'         => 'Just2\BackendBundle\Entity\Locality',
                'property'      => 'name',
                'label'         => 'Locality',
                'query_builder' => function (EntityRepository $repository) use ($province) {
                                       $qb = $repository->createQueryBuilder('locality')
                                                        ->innerJoin('locality.province', 'province');
 
                                       if($province instanceof Province) {
                                           $qb = $qb->where('locality.province = :province')
                                                    ->setParameter('province', $province);
                                       } elseif(is_numeric($province)) {
                                           $qb = $qb->where('province.id = :province_id')
                                                    ->setParameter('province_id', $province);
                                       } else {
                                           $qb = $qb->where('province.id = 1');
                                       }
 
                                       return $qb;
                                   }
                 )));
        };
 
        $builder->add('address','text',array(
                        'required' => false));
 
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (DataEvent $event) use ($refreshLocality) {
            $form = $event->getForm();
            $data = $event->getData();
 
            if($data == null)
               $refreshLocality($form, null); //As of beta2, when a form is created setData(null) is called first
 
            if($data instanceof Location) {
                $refreshLocality($form, $data->getLocality()->getProvince());
                }
        });
 
        $builder->addEventListener(FormEvents::PRE_BIND, function (DataEvent $event) use ($refreshLocality) {
            $form = $event->getForm();
            $data = $event->getData();
 
            if(array_key_exists('province', $data)) {
                $refreshLocality($form, $data['province']);
            }
        });
    }
 
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Just2\BackendBundle\Entity\Location'
        );
    }
 
    public function getName()
    {
        return 'location';
    }
}

?>