<?php
namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class OcassionVenueRepository extends EntityRepository  {
    
    public function getVenueList($id){
        
        
//        $dates = date('d-m-Y');
//        
//        $date=date('Y/m/d H:m:s',strtotime("-1 day"));
        
        
                $q = $this
                ->createQueryBuilder('b')
                ->where('b.id = :id')   //2 => in bet
                ->setParameter('id', $id)
                ->getQuery();
                
                return $q->getSingleResult();
        
    }
}

