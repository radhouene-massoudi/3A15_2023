<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CatType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
class CatController extends AbstractController
{
    #[Route('/cat', name: 'app_cat')]
    public function index(): Response
    {
        return $this->render('cat/index.html.twig', [
            'controller_name' => 'CatController',
        ]);
    }
    #[Route('/add', name: 'add')]
    public function add(ManagerRegistry $mr,Request $req): Response
    {
        $cat = new Category();
        $form = $this->createForm(CatType::class, $cat);
$form->handleRequest($req);
        if ($form->isSubmitted()) {
         //   dd($req);
            $em = $mr->getManager();
            $em->persist($cat);
            $em->flush();
        }
        return $this->render('cat/add.html.twig', [
            'f' => $form->createView(),
        ]);
    }
    #[Route('/fetch', name: 'fetchcat')]
    public function fetch(CategoryRepository $repo): Response
    { 
        return $this->render('cat/list.html.twig',[
       'list'=>$repo->findAll()
        ]);
    }
}
