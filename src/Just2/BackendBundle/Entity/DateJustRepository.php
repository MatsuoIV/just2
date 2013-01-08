<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class DateJustRepository extends EntityRepository {

    public function activeAppointment($appointment) {


//        $dates = date('d-m-Y');
//        
//        $date=date('Y/m/d H:m:s',strtotime("-1 day"));


        $q = $this
                ->createQueryBuilder('b')
                ->where('b.estate = 2 AND b.id = :id')   //2 => in bet
                ->setParameter('id', $appointment)
                ->getQuery();

        return $q->getSingleResult();
    }

    public function findMemberDate($id, $member) {

        $q = $this
                ->createQueryBuilder('b')
                ->where('b.member = :member AND b.id = :id')   //2 => in bet
                ->setParameter('id', $id)
                ->setParameter('member', $member)
                ->getQuery();

        try {
            $return = $q->getSingleResult();
        } catch (NoResultException $e) {
            $return = null;
        }

        return $return;
    }

}

