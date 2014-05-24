<?php
// src/JFC/CoreBundle/Services/AuthorManager.php

namespace JFC\CoreBundle\Services;

use Doctrine\ORM\EntityManager;
use JFC\ModelBundle\Entity\Author;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AuthorManager
 */
class AuthorManager
{
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Find author by slug
     *
     * @param string $slug
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return Author
     */
    public function findBySlug($slug)
    {
        $author = $this->em->getRepository('JFCModelBundle:Author')
            ->findOneBy(array(
                'slug' => $slug
            ));

        if (null === $author) {
            throw new NotFoundHttpException('Author was not found');
        }

        return $author;
    }

    /**
     * Find all posts by Author
     *
     * @param Author $author
     *
     * @return array
     */
    public function findPosts(Author $author)
    {
        $posts = $this->em->getRepository('JFCModelBundle:Post')
            ->findBy(array(
                'author' => $author
            ));

        return $posts;
    }

}