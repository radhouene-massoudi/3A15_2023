<?php

namespace App\Controller;

use App\Entity\Grade;
use App\Form\GradeType;
use App\Repository\GradeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/grade')]
class GradeController extends AbstractController
{
   

    #[Route('/new', name: 'app_grade_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $grade = new Grade();
        $form = $this->createForm(GradeType::class, $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $grade->setCreatedAt(new \DateTimeImmutable('now'));
            $entityManager->persist($grade);

            $entityManager->flush();

            return new Response('added');
        }

        return $this->renderForm('grade/new.html.twig', [
            'grade' => $grade,
            'form' => $form,
        ]);
    }

    
}
