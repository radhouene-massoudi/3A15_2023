<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/addp', name: 'addp')]
    public function addProduct(ManagerRegistry $mr,CategoryRepository $repo): Response
    {
        $p=new Product();
        $category=$repo->find(1);
        $p->setRef(234);
        $p->setPrice('56');
        $p->setDescription('product1');
        $p->setCatgory($category);
$em=$mr->getManager();
$em->persist($p);
$em->flush();
        return new Response('added');
    }
}
