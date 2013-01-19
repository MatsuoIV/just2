<?php
namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class OcassionRepository extends EntityRepository  {
    
    // public function getInterestsByMember($id) {
    //     $q = $this
    //             ->createQueryBuilder('m')                
    //             ->select('m', 'i')
    //             // ->from('Just2BackendBundle:Member', 'm')
    //             ->leftJoin('m.interest', 'i')
    //             ->where('m.id = :id')
    //             ->setParameter('id', $id)
    //             ->getQuery()
    //     ;
    //     return $q->getSingleResult();
        
    // }

    public function getVenueDetails($ocassion) {

        $q = $this
                ->createQueryBuilder('b')
                ->leftJoin('b.member', 'i')
                ->where('i.gender = :gender AND i.datePreference = :interested')   //2 => in bet
                ->setParameter('interested', $interested)
                ->setParameter('gender', $gender)
                ->getQuery();

        try {
            // $return = $q->getSingleResult();
            $return = $q->getResult();

        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }

    // public function getVenues($ocassion) {

    //     $q = $this
    //         ->createQueryBuilder('b')
    //         ->leftJoin('b.venue', 'i')
    //         ->where('b.ocassion = :ocassion AND i.')
    //         ->setParameter('ocassion', $ocassion)            
    //         ->getQuery();

    //     try {            
    //         $return = $q->getResult();
    //     } catch (NoResultException $e) {
    //         $return = null;
    //     }
        
    //     return $return;        
    // }
}
