<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\GradeRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('student/index.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }

    #[Route('/new/{idofgrade}', name: 'app_student_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,$idofgrade,GradeRepository $repo): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($student->getName())
            $grade=$repo->find($idofgrade);
         
        if($grade==null){
            return new Response("id n'existe pas");
        }
        else{
            
            $student->setGrades($grade);

            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        }

        return $this->renderForm('student/new.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }
    #[Route('/dql', name: 'dql')]
    public function fecthStudentsDql(StudentRepository $repo,Request $request)
    {
        $result=$repo->findAll();
        if($request->isMethod('post')){
            $value=$request->get('searchby');
            //$result=$repo->findStudentByClass($value);
            $result=$repo->findStudentByClasspostion($value);
return $this->renderForm('student/searchByclass.html.twig', [
    'st'=>$result,
]);
        }
   
   return $this->renderForm('student/searchByclass.html.twig', [
    'st'=>$result,
   ]);
    }

    #[Route('/qb', name: 'qb')]
    public function fecthStudentsqb(StudentRepository $repo,Request $request)
    {
        $repo->findAllQB();
        $result=$repo->findAllQB();
        
   
   return $this->renderForm('student/searchByclass.html.twig', [
    'st'=>$result,
   ]);
    }
  
    #[Route('/qbtwo', name: 'qbtwo')]
    public function fecthStudentsByClassQB(StudentRepository $repo)
    {
        $result=$repo->findStudentByClassQB('3A15');
        dd($result);
    }


}
