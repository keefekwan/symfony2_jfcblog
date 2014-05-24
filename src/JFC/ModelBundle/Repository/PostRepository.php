<?php

namespace JFC\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use JFC\ModelBundle\Entity\Post;

/**
 * Class PostRepository
 */
class PostRepository extends EntityRepository
{
    /**
     * Find latest
     *
     * @param int $num How many posts to get
     *
     * @return array
     */
    public function findLatest($num)
    {
        // Original query using getQueryBuilder() method
//        $qb = $this->getQueryBuilder()
//            ->orderBy('p.createdAt', 'DESC')
//            ->setMaxResults($num);
//
//        return $qb->getQuery()->getResult();

        // Better method from KnpUniversity
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($num)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find the first post
     *
     * @return Post
     */
    public function findFirst()
    {
        // Original query using getQueryBuilder() method
//        $qb = $this->getQueryBuilder()
//            ->getOrderBy('p.id', 'ASC')
//            ->setMaxResults(1);
//
//        return $qb->getQuery()->getSingleResult();

        // Better method from KnpUniversity
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }

//    private function getQueryBuilder()
//    {
//        $em = $this->getEntityManager();
//
//        $qb = $em->getRepository('JFCModelBundle:Post')
//            ->createQueryBuilder('p');
//
//        return $qb;
//    }
}
