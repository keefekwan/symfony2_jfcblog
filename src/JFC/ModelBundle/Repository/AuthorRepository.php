<?php
// src/JFC/ModelBundle/Repository/AuthorRepository.php

namespace JFC\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use JFC\ModelBundle\Entity\Author;

/**
 * Class AuthorRepository
 */
class AuthorRepository extends EntityRepository
{
    /**
     * Find first Author
     *
     * @return Author
     */
    public function findFirst()
    {
        // Original query using getQueryBuilder() method
//        $qb = $this->getQueryBuilder()
//            ->OrderBy('a.id', 'ASC')
//            ->setMaxResults(1);
//
//        return $qb->getQuery()->getSingleResult();

        // Better method from KnpUniversity
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }


//    private function getQueryBuilder()
//    {
//        $em = $this->getEntityManager();
//
//        $qb = $em->getRepository('JFCModelBundle:Author')
//            ->createQueryBuilder('a');
//
//        return $qb;
//    }
}