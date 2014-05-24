<?php
// src/JFC/ModelBundle/DataFixtures/ORM/20-Comments.php

namespace JFC\ModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JFC\ModelBundle\Entity\Comment;

/**
 * Fixtures for Comment Entity
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('JFCModelBundle:Post')
            ->findAll();

        $comments = array(
            0 => 'Mauris posuere adipiscing sapien eu ultricies. Nunc a dignissim dolor. Duis porttitor faucibus nulla, eu
            faucibus nibh venenatis eu. Donec nec nibh a nibh convallis fringilla eget sed leo. Sed tempor lobortis enim,
            porta posuere lacus semper in.',
            1 => 'Cras elementum condimentum ligula ac ullamcorper. Duis fringilla at nibh et vulputate. Quisque euismod
            vehicula ante, a ornare dolor volutpat ac. Duis felis odio, mollis vitae convallis interdum, accumsan vitae tellus.',
            2 => 'Nunc et tortor a magna faucibus tempor. In eros sem, tristique dignissim ultricies et, facilisis a massa.
            Vivamus vitae mauris id neque semper adipiscing. Vivamus nibh ipsum, consectetur a nisi et, congue accumsan
            mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        );

        $i = 0;

        foreach ($posts as $post) {
            $comment = new Comment();
            $comment->setAuthorName('John Doe');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);

            $manager->persist($comment);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function  getOrder()
    {
        return 20;
    }
}
