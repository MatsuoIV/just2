<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class BidRepository extends EntityRepository {

    public function highestBid($id) {   //oferta mas alta de la subasta
        $q = $this
                ->createQueryBuilder('b')
                ->where('b.estate = 1 AND b.dateJust= :id')
                ->setParameter('id', $id)
                ->orderBy('b.createdAt', 'Desc')
                ->setMaxResults(1)
                ->getQuery();


        try {
            $return = $q->getSingleResult();
        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }

    public function memberBidsForDate($dateId, $memberId) {
        $q = $this
                ->createQueryBuilder('b')
                ->where('b.dateJust= :date AND b.member= :member')
                ->setParameter('date', $dateId)
                ->setParameter('member', $memberId)
                ->orderBy('b.createdAt', 'Desc')
                ->setMaxResults(1)
                ->getQuery();


        try {
            $return = $q->getSingleResult();
        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }

    public function bidsForDate($dateId) {
        $q = $this
                ->createQueryBuilder('b')
                ->where('b.dateJust= :dateId')
                ->setParameter('dateId', $dateId)
                ->orderBy('b.createdAt', 'Desc')
                ->getQuery();
        try {
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }

    public function countBidsForDate($date) {
        $bids = $this->bidsForDate($date);
        return count($bids);
    }

    public function rejectered($memberId, $dateId) {
        $q = $this
                ->createQueryBuilder('z')
                ->where('(z.dateJust= :date AND z.member=:member) AND z.estate=3')
                ->setParameter('date', $dateId)
                ->setParameter('member', $memberId)
                ->getQuery()
;
        
        
        try {
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }
        
        

        return count($return);
    }

}

