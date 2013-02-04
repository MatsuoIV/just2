<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class MessageRepository extends EntityRepository {

    public function newMessages($idMember) {
        $q = $this
                ->createQueryBuilder('b')
                ->where('b.memberFor = :id and b.estate != 0')   //2 => in bet
                ->setParameter('id', $idMember)
                ->orderBy('b.createdAt', 'Desc')
                ->getQuery();

        return $q->getResult();
    }

    public function sendMessages($idMember) {
        $q = $this
                ->createQueryBuilder('b')
                ->where('b.memberOf = :id')   //2 => in bet
                ->setParameter('id', $idMember)
                ->orderBy('b.createdAt', 'Desc')
                ->getQuery();

        return $q->getResult();
    }

    public function newMessagesIndex($idMember) {
        $q = $this->createQueryBuilder('b')
                ->where('b.memberFor = :id and b.estate != 0')   //2 => in bet
                ->setParameter('id', $idMember)
                ->orderBy('b.createdAt', 'Desc')
                ->setMaxResults(5)
                ->getQuery();

        return $q->getResult();
    }

    public function sendMessagesIndex($idMember) {
        $q = $this
                ->createQueryBuilder('b')
                ->where('b.memberOf = :id')   //2 => in bet
                ->setParameter('id', $idMember)
                ->orderBy('b.createdAt', 'Desc')
                ->setMaxResults(5)
                ->getQuery();

        return $q->getResult();
    }   

}

