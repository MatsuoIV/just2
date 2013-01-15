<?php
namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class MemberRepository extends EntityRepository  {
    
    public function getInterestsByMember($id) {
        $q = $this
                ->createQueryBuilder('m')                
                ->select('m', 'i')
                // ->from('Just2BackendBundle:Member', 'm')
                ->leftJoin('m.interest', 'i')
                ->where('m.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
        ;
        return $q->getSingleResult();
        
    }
}
