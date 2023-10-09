<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CatType;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/add', name: 'addp')]
    public function addProduct(ManagerRegistry $mr,CategoryRepository $repo,Request $req): Response
    {
        $p=new Product();
        $form=$this->createForm(ProductType::class,$p);
        $form->handleRequest($req);
                if ($form->isSubmitted() ) { 
                    $em=$mr->getManager();
                    $em->persist($p);
                    $em->flush();
        }
        /*$category=$repo->find(1);
        $p->setRef(234);
        $p->setPrice('56');
        $p->setDescription('product1');
        $p->setCatgory($category);*/

        return $this->renderForm('product/add.html.twig',[
            'f'=>$form,
        ]);
    }
}
