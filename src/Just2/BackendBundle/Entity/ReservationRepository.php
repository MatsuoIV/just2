<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class ReservationRepository extends EntityRepository {

    public function dateJustReservation($dateJust) {

        $q = $this
                ->createQueryBuilder('b')
                ->where('b.dateJust = :date')   //2 => in bet
                ->setParameter('date', $dateJust)
                ->getQuery();
        

        try {
            $return = $q->getSingleResult();
        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }

}

