<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class VenueRepository extends EntityRepository {

    public function getVenueByOcassion($id) {

        $q = $this
                ->createQueryBuilder('v')                
                ->leftJoin('v.ocassion', 'o')
                ->where('o.id = :id')
                ->setParameter('id', $id)                
                ->getQuery();

        try {
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }

    public function getVenueSuburbDistance($ocassion_id,$suburb_id,$distance) {

       $q = $this            
            ->createQueryBuilder('v')
            ->leftJoin('v.ocassion', 'o')
            ->leftJoin('v.suburb', 's')                      
            // ->where('b.ocassion = :ocassion_id 
            //     AND v.suburb = :suburb_id 
            //     AND DEGREES( ACOS( SIN(RADIANS(v.lat)) * SIN(RADIANS(s.lat)) + COS(RADIANS(v.lat)) * COS(RADIANS(s.lat)) * COS(RADIANS(v.long-s.long)) ) )*111.189576 <= :distance - 1')
            ->where('o.id = :ocassion_id 
                AND s.id = :suburb_id 
                AND DEGREES( ACOS( SIN(RADIANS(v.lat)) * SIN(RADIANS(s.lat)) + COS(RADIANS(v.lat)) * COS(RADIANS(s.lat)) * COS(RADIANS(v.long-s.long)) ) )*111.189576 < :distance')
            ->setParameter('ocassion_id', $ocassion_id)
            ->setParameter('suburb_id', $suburb_id)
            ->setParameter('distance', $distance)
            ->getQuery();  
        try {            
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }
        
        return $return;        
    }

    // public function getVenueSuburbDistance2() {
    //     $stmt = $this->getEntityManager()
    //     ->getConnection()
    //     ->prepare('select * from product where 1');
    //     $stmt->execute();
    //     $result = $stmt->fetchAll();
    // }

    public function getVenueSuburb($ocassion_id,$suburb_id) {


        // echo $ocassion_id.gettype($ocassion_id).'<br />'.$suburb_id.gettype($suburb_id);
        // return;

        $q = $this
            ->createQueryBuilder('v')
            ->leftJoin('v.ocassion', 'o')
            ->leftJoin('v.suburb', 's')
            ->where('o.id = :ocassion_id AND s.id = :suburb_id')
            ->setParameter('ocassion_id', $ocassion_id)
            ->setParameter('suburb_id', $suburb_id)          
            ->getQuery();

        try {            
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }
        
        return $return;        
    }

    public function getVenueNoSuburb($id) {

        $q = $this
                ->createQueryBuilder('v')                
                ->leftJoin('v.ocassion', 'o')
                ->where('o.id = :id')
                ->setParameter('id', $id)                
                ->getQuery();

        try {
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }
}

