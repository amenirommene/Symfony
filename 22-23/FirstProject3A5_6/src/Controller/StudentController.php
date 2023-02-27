<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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


    #[Route('/student/getAll', name: 'app_list_student')]
    public function getAllStudents(StudentRepository $repo): Response
    {
       $list=$repo->findAll();
        return $this->render('student/list.html.twig', [
            'lists' => $list,
        ]);
    }
    #[Route('/student/add', name: 'app_add_student')]
    public function addStudent(Request $request,ManagerRegistry $doctrine): Response
    {
        $student=new Student();
        //creation de formulaire
        $form=$this->createForm(StudentType::class,$student);
        $form->add('Add',SubmitType::class);
       $form->handleRequest($request);
        if($form->isSubmitted()){
            //gestionnaire
            $em=$doctrine->getManager();
            //ajout
            $em->persist($student);
            $em->flush();
        }
        //envoyer mon formulaire vers view
        return $this->renderForm('student/add.html.twig', [
            'myform' => $form,
        ]);
    }

    #[Route('/student/update/{id}', name: 'app_update_student')]
    public function updateStudent(StudentRepository $repo,Request $request,ManagerRegistry $doctrine): Response
    {
        $ids=$request->get('id');
        $student=$repo->find($ids);
        //creation de formulaire: si $student est vide alors form vide sinon formumaire rempli
        $form=$this->createForm(StudentType::class,$student);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            //gestionnaire
            $em=$doctrine->getManager();
            //update
            $em->flush();
            return $this->redirectToRoute("app_list_student");
        }
        //envoyer mon formulaire vers view
        return $this->renderForm('student/add.html.twig', [
            'myform' => $form,
        ]);
    }
}
