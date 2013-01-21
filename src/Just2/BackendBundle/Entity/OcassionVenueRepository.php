<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class OcassionVenueRepository extends EntityRepository {
    
    public function getVenueSuburbDistance($ocassion_id,$suburb_id,$distance) {

       $q = $this
            ->createQueryBuilder('b')
            ->innerJoin('b.venue', 'v')
            ->leftJoin('v.suburb', 's')
            // ->where('b.ocassion = :ocassion_id AND (v.suburb = :suburb_id AND sqrt((s.lat-v.lat)*(s.lat-v.lat)+(s.long-v.long)*(s.long-v.long)) <= :distance )')
            ->where('b.ocassion = :ocassion_id AND v.suburb = :suburb_id AND DEGREES(ACOS(SIN(RADIANS(v.lat)) * SIN(RADIANS(s.lat)) + COS(RADIANS(v.lat)) * COS(RADIANS(s.lat)) * COS(RADIANS(v.long-s.long)))*111.189576 < :distance')
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

    public function getVenueSuburb($ocassion_id,$suburb_id) {


        // echo $ocassion_id.gettype($ocassion_id).'<br />'.$suburb_id.gettype($suburb_id);
        // return;

        $q = $this
            ->createQueryBuilder('b')
            ->innerJoin('b.venue', 'i')
            ->where('b.ocassion = :ocassion_id AND i.suburb = :suburb_id')
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

    public function getVenueNoSuburb($ocassion_id) {

        $q = $this
            ->createQueryBuilder('b')
            ->leftJoin('b.venue', 'i')
            ->where('b.ocassion = :ocassion_id')
            ->setParameter('ocassion_id', $ocassion_id)                 
            ->getQuery();

        try {            
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }
        
        return $return;        
    }
}
