<?php

namespace MoviesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");
        $movies = $repo->findNewestMovies();

        return $this->render('MoviesBundle:Default:index.html.twig', [
            "movies" => $movies
        ]);
    }

    public function detailAction($id)
    {
        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");
        $movies = $repo->find($id);

        if ($movies === null) {
            throw $this->createNotFoundException("Ce film n'existe pas !");
        }

        return $this->render('MoviesBundle:Movie:movie_detail.html.twig', [
            "movies" => $movies
        ]);

    }

}
