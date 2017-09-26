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
}
