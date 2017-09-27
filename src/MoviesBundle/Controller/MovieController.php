<?php

namespace MoviesBundle\Controller;

use MoviesBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends Controller
{
    public function indexAction($page = 1)
    {

        $nbMoviesParPage = 50;
        $offset = ($page - 1) * $nbMoviesParPage;
        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");

        $total = $repo->nbMovies();

        $movies = $repo->findMovies($nbMoviesParPage, $offset);

        $genres = $repo->genre();

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil($total / $nbMoviesParPage),
            'nomRoute' => 'homepage',
            'paramsRoute' => array(),
            'offset' => $offset,
            'totalFilms' => $total
        );


        return $this->render('MoviesBundle:Default:index.html.twig', [
            "movies" => $movies,
            "pagination" => $pagination,
            "genres" => $genres
        ]);

    }




    public function searchAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");

        $idGenre = $request->query->get('idGenre');

        $movies = $repo->findByCategory($idGenre);

        return $this->render('MoviesBundle:Default:search.html.twig', [
            "movies" => $movies
        ]);

    }




    public function detailAction($id)
    {
        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");
        $movies = $repo->find($id);

        if (isset($_POST['title']) &&
            isset($_POST['review']) &&
            isset ($_POST['rating']) &&
            isset ($_POST['username']))
        {
            $review = new Review();
            $review->setMovies($movies);
            $review->setTitle($_POST['title']);
            $review->setReview($_POST['review']);
            $review->setRating($_POST['rating']);
            $review->setUsername($_POST['username']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            $this->addFlash("success", "Votre critique a été ajoutée ! ");

            $movies->addReview($review);
        }

        $reviews = $movies->getReviews();

        if ($movies === null) {
            throw $this->createNotFoundException("Ce film n'existe pas !");
        }

        return $this->render('MoviesBundle:Movie:movie_detail.html.twig', [
            "movies" => $movies,
            "reviews" => $reviews
        ]);

    }

}
