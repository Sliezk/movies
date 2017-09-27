<?php

namespace MoviesBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

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


    /**
     * Get the paginated list of published articles
     *
     * @param int $page
     * @param int $maxperpage
     * @param string $sortby
     * @return Paginator
     */
    public function getListMovies($page=1, $maxperpage=10)
    {
        $q = $this->_em->createQueryBuilder()
            ->select('article')
            ->from('MoviesBundle:Movie')
        ;

        $q->setFirstResult(($page-1) * $maxperpage)
            ->setMaxResults($maxperpage);

        return new Paginator($q);
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
