<?php
// src/JFC/ModelBundle/DataFixtures/ORM/10-Author.php

namespace JFC\ModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JFC\ModelBundle\Entity\Author;

/**
 * Fixtures for Author Entity
 */
class Authors extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $author1 = new Author();
        $author1->setName('Foo1');
        $manager->persist($author1);

        $author2 = new Author();
        $author2->setName('Foo2');
        $manager->persist($author2);

        $author3 = new Author();
        $author3->setName('Foo3');
        $manager->persist($author3);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function  getOrder()
    {
        return 10;
    }
}
