<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    #[Route('/msg', name: 'msg')]
   
    public function html()
    {
        return new Response('<h1>bonjour</h1>'); 
    }
  
    #[Route('/t', name: 't')]
   
    public function msg()
    {
        return new Response('bonjour msg'); 
    }

    #[Route('/json', name: 'json')]
   
    public function formatJson()
    {
        return new JsonResponse('bonjour msg'); 
    }
}
