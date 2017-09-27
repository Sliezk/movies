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


    public function findByCategory($idGenre, $keyword)
    {

        $qb = $this->createQueryBuilder('m');
        $qb->join('m.genres', 'g')
           ->where('m.title like :keyword')
           ->orWhere('m.cast like :keyword')
           ->orWhere('m.directors like :keyword')
           ->orWhere('m.writers like :keyword')
           ->andWhere('g.id = :idGenre');
        $query = $qb->getQuery();

        $query->setParameters(["idGenre" => $idGenre, "keyword" => '%'.$keyword.'%']);

        $movies = $query->getResult();

        return $movies;

    }

}
