<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class MemberRepository extends EntityRepository {

    public function getMembersByInterest($memberId, $interestId) {
        $q = $this
                ->createQueryBuilder('m')
                ->leftJoin('m.interest', 'i')
                ->where('m.id != :memberId AND i.id = :interestId')
                ->setParameter('memberId', $memberId)
                ->setParameter('interestId', $interestId)
                ->setMaxResults(2)               
                ->getQuery();
        try {
            $return = $q->getResult();
        } catch (NoResultException $e) {
            $return = null;
        }
        return $return;
    }
}

