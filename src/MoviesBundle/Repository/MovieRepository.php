<?php

namespace MoviesBundle\Repository;

class MovieRepository extends \Doctrine\ORM\EntityRepository
{

    public function findMovies($resultNumber = 50, $tri = 'year') {

        // Version DQL
        $dql = "SELECT m
                FROM MoviesBundle:Movie m
                ORDER BY m.year DESC";

        $query = $this->getEntityManager()->createQuery($dql);

        // équivalent du limit (ou top)
        $query->setMaxResults($resultNumber); // équivalent du limit (ou top)
        $query->setFirstResult(0); // équivalent de l'offset
        $movies = $query->getResult();
        return $movies;

    }

//    public function findMovies($resultNumber = 50) {
//
//        // Version DQL
//        $dql = "SELECT m
//                FROM MoviesBundle:Movie m
//                ORDER BY m.year DESC";
//
//        $query = $this->getEntityManager()->createQuery($dql);
//
//        // équivalent du limit (ou top)
//        $query->setMaxResults($resultNumber); // équivalent du limit (ou top)
//        $query->setFirstResult(0); // équivalent de l'offset
//        $movies = $query->getResult();
//        return $movies;
//
//    }

}
