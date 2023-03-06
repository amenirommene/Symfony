<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/student/list', name: 'app_list_student')]
    public function getAll(StudentRepository $repo): Response
    {
        $list=$repo->findAll();
        return $this->render('student/list.html.twig', [
            'students' => $list,
        ]);
    }

    #[Route('/student/add', name: 'app_add_student')]
    public function addStudent(Request $request,ManagerRegistry $doctrine): Response
    {
        $student=new Student();
        $form=$this->createForm(StudentType::class,$student);
        /*
         * $student->setName($request->get('name');
         * $student->setEmail($request->get('email');
         * récuparation de la clé étrangère
         * détécter le click sur le bouton submit
         */
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$doctrine->getManager();
            $em->persist($student);
            $em->flush();
        }
        return $this->renderForm('student/add.html.twig',[
            'myForm' => $form]);
    }

    #[Route('/student/update/{id}', name: 'app_update_student')]
    public function updateStudent(Request $request,ManagerRegistry $doctrine): Response
    {
        $nsc=$request->get('id');
        $repo=$doctrine->getRepository(Student::class);

        $student=$repo->find($nsc);
        $form=$this->createForm(StudentType::class,$student);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$doctrine->getManager();
          //  $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("app_list_student");
        }
        return $this->renderForm('student/add.html.twig',[
            'myForm' => $form]);
    }
}
