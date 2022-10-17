<?php

namespace App\Controller;


use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', 
        [
            'name' => '4SE3', 'age' => '27', "id"=>5, "ref" => "14525"
        ]);
    }

    #[Route('/addstudent', name: 'app_add_student')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $student=new Student();
        $form=$this->createForm(StudentType::class,$student );
        return $this->renderForm("student/add.html.twig", ['f'=>$form]);

    }
}
