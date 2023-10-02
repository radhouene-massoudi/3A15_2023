<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    public function __construct(ManagerRegistry $mr)
    {
        
    }
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/show', name: 'show')]
    public function fetchStudent(AuthorRepository $repo,ManagerRegistry $mr ){
//$authors=$repo->findAll();
$authors=$mr->getRepository(Author::class);
return $this->render('author/show.html.twig',[
    'a'=>$authors->findAll()
]);
    }

    #[Route('/add', name: 'add')]
    public function AddStudent(ManagerRegistry $em ){
$auth=new Author();
$auth->setName('ali');
$auth->setEmail('test');
$auth->setNbbooks(300);
$manager=$em->getManager();
$manager->persist($auth);
$manager->flush();
return new Response('added');
    }
}
