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


    public function genre()
    {
        $dql = "SELECT g
                FROM MoviesBundle:Genre g
                ORDER BY g.name";

        $query = $this->getEntityManager()->createQuery($dql);

        $genres = $query->getResult();

        return $genres;
    }


    public function findByCategory($idGenre)
    {

        $qb = $this->createQueryBuilder('m');
        $qb->addSelect('g')
            ->join('MoviesBundle:Genre', 'g')
            ->where('g.id = :idGenre');
        $query = $qb->getQuery();

        $query->setParameters(["idGenre" => $idGenre]);

        $movies = $query->getResult();

        return $movies;

    }

}
