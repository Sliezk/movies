<?php

namespace MoviesBundle\Controller;

use MoviesBundle\Form\MovieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminMovieController extends Controller
{
    public function manageAction()
    {
        $repo = $this->getDoctrine()->getRepository("MoviesBundle:Movie");
        $movies = $repo->findMovies(500, 'id', 'ASC');

        return $this->render('MoviesBundle:Admin:editMovies.html.twig', [
            "movies" => $movies
        ]);
    }

    /*
    public function editMovieAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $movie = $em->getRepository("MoviesBundle:Movie")->find($id);

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

//        if($this->getUser()) {
            if ($form->isSubmitted() && $form->isValid()) {
                if (!$movie) {
                    throw $this->createNotFoundException("Ce film n'existe pas ! ");
                }
//                if ($movie->getAuthor() == $this->getUser()) {

                    $em->persist($movie);

                    $em->flush();

//                    $message = (new \Swift_Message('Hello Email'))
//                        ->setFrom('send@example.com')
//                        ->setTo('Papercut@user.com')
//                        ->setBody($this->renderView(
//                        // app/Resources/views/Emails/registration.html.twig
//                            'NantesBundle:Emails:emailEventCreated.html.twig'
//                        ),
//                            'text/html'
//                        )
//                    ;
//
//                    $this->get('mailer')->send($message);

                    $this->addFlash("success", "Votre film a bien été mis à jour ! ");
                    return $this->redirectToRoute("movie_detail", ["id" => $id]);
//                } else {
//                    $this->addFlash("warning", "Vous ne pouvez pas modifier un événement dont vous n'êtes pas l'auteur ! ");
//                }
            }
//        } else {
//            $this->addFlash("warning", "Veuillez vous connecter pour modifier cet événement ! ");
//        }

        return $this->render('MoviesBundle:Movie:editMovies.html.twig', [
            "form" => $form->createView()
        ]);

    }

    public function deleteMovieAction($id)
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
*/
}
