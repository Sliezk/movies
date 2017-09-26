<?php

namespace MoviesBundle\Controller;

use MoviesBundle\Entity\Movie;
use MoviesBundle\Form\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminMovieController extends Controller
{


// manageAction

    public function manageAction()
    {
        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");
        $movies = $repo->findMovies(500, 'id');

        return $this->render('MoviesBundle:Admin:editMovies.html.twig', [
            "movies" => $movies
        ]);
    }



// createMovieAction

    public function createMovieAction(Request $request)
    {
        $movie = new Movie();
        $movie->setDateCreated(new \DateTime());
        $movie->setDateModified(new \DateTime());
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            $this->addFlash("success", "La fiche du film a bien été ajoutée ! ");
            return $this->redirectToRoute("movie_detail", ["id" => $movie->getId()]);
        }

        return $this->render('MoviesBundle:Admin:formCreateMovies.html.twig', [
            "form" => $form->createView()
        ]);

    }



// editMovieAction

    public function editMovieAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $movie = $em->getRepository("MoviesBundle:Movie")->find($id);
        $movie->setDateModified(new \DateTime());

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$movie) {
                throw $this->createNotFoundException("Ce film n'existe pas ! ");
            }

            $em->persist($movie);

            $em->flush();

            $this->addFlash("success", "La fiche du film a bien été mise à jour ! ");
            return $this->redirectToRoute("movie_detail", ["id" => $id]);
        }

        return $this->render('MoviesBundle:Admin:formEditMovies.html.twig', [
            "form" => $form->createView()
        ]);

    }



// deleteMovieAction

    public function deleteMovieAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $movie = $em->getRepository("MoviesBundle:Movie")->find($id);

        $em->remove($movie);
        $em->flush();

        $this->addFlash("success", "La fiche du film a bien été supprimée ! ");
        return $this->redirectToRoute("movie_admin");
    }

}
