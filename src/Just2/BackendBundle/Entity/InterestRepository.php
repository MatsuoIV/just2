<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class InterestRepository extends EntityRepository {

    public function getInterestsByMember($id) {

        $q = $this
                ->createQueryBuilder('i')
                ->leftJoin('i.member', 'm')
                ->where('m.id = :id')
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

