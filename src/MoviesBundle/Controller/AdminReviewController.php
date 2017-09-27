<?php

namespace MoviesBundle\Controller;

use MoviesBundle\Entity\Movie;
use MoviesBundle\Form\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminReviewController extends Controller
{


// manageAction

//    public function manageReviewsAction()
//    {
//        // TODO
//        // Voir les reviews
//        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");
//        $movies = $repo->findMovies(500, 'id');
//
//        return $this->render('MoviesBundle:Admin:editMovies.html.twig', [
//            "movies" => $movies
//        ]);
//    }



// createReviewAction

//    public function createReviewAction(Request $request)
//    {
//        // TODO
//        // Créer une review
//
//        $movie = new Movie();
//        $movie->setDateCreated(new \DateTime());
//        $movie->setDateModified(new \DateTime());
//        $form = $this->createForm(MovieType::class, $movie);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($movie);
//            $em->flush();
//
//            $this->addFlash("success", "La fiche du film a bien été ajoutée ! ");
//            return $this->redirectToRoute("movie_detail", ["id" => $movie->getId()]);
//        }
//
//        return $this->render('MoviesBundle:Admin:formCreateMovies.html.twig', [
//            "form" => $form->createView()
//        ]);
//
//    }



// editReviewAction

//    public function editReviewAction(Request $request, $id)
//    {
//        // TODO
//        // Modifier les reviews
//        $em = $this->getDoctrine()->getManager();
//        $review = $em->getRepository("MoviesBundle:Review")->find($id);
//
////        $form = $this->createForm(MovieType::class, $review);
////        $form->handleRequest($request);
//
//        //if ($form->isSubmitted() && $form->isValid()) {
//            if (!$review) {
//                throw $this->createNotFoundException("Ce film n'existe pas ! ");
//            }
//
//            $em->persist($review);
//
//            $em->flush();
//
//            $this->addFlash("success", "La critique a bien été mise à jour ! ");
//            return $this->redirectToRoute("movie_detail", ["id" => $id]);
//        //}
//
//        /*return $this->render('MoviesBundle:Admin:formEditMovies.html.twig', [
//            "form" => $form->createView()
//        ]);*/
//
//    }



// deleteReviewAction

//    public function deleteReviewAction($id)
//    {
//        // TODO
//        // Ajouter le bouton supprimer pour les reviews


//        $em = $this->getDoctrine()->getManager();
//        $review = $em->getRepository("MoviesBundle:Review")->find($id);
//
//        $em->remove($review);
//        $em->flush();
//
//        $this->addFlash("success", "La critique a bien été supprimée ! ");
//        return $this->redirectToRoute("movie_detail");
//    }

}