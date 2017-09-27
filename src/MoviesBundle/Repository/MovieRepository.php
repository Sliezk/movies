<?php

namespace MoviesBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

class MovieRepository extends \Doctrine\ORM\EntityRepository
{

    public function findMovies($resultNumber = 50, $offset) {

        // Version DQL
        $dql = "SELECT m
                FROM MoviesBundle:Movie m
                ORDER BY m.year DESC";

        $query = $this->getEntityManager()->createQuery($dql);

        $query->setMaxResults($resultNumber);
        $query->setFirstResult($offset);
        $movies = $query->getResult();

        return $movies;

    }


    public function nbMovies()
    {
        $qb = $this->createQueryBuilder('m');
        $qb->select('count(m)');

        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

}
