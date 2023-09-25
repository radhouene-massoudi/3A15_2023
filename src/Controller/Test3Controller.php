<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Test3Controller extends AbstractController
{
    #[Route('/test3', name: 'app_test3')]
    public function index(): Response
    {
        return $this->render('test3/index.html.twig', [
            'controller_name' => 'Test3Controller',
        ]);
    }

    #[Route('/ttt/{name}')]
    public function msgesprit($name)
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 0),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );

        return $this->render('test3/msg.html.twig',[
            'n'=>$name,
            'a'=>$authors
        ]);
    }

    #[Route('/details/{id}', name: 'd')]
    public function detailsAuthors($id): Response
    {
        return new Response('authors'.$id);
    }
}
