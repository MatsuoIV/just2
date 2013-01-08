<?php

namespace JVJ\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JVJ\UserBundle\Entity\Role;

class Roles implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $roles = array(
            array('name' => 'Administrador', 'role' => 'ROLE_ADMIN'),
            array('name' => 'User', 'role' => 'ROLE_USER'),
// ...
        );
        foreach ($roles as $role) {
            $entidad = new Role();
            $entidad->setName($role['name']);
            $entidad->setRole($role['role']);
            $manager->persist($entidad);
        }
        $manager->flush();
    }
}