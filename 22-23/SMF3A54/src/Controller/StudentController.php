<?php

namespace App\Controller;

use App\Entity\Student;

use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/student', name: 'app_controller_student')]
class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return new Response("Bonjour mes étudiants");
    }

    #[Route('/list', name: 'app_list_student')]
    public function getStudents(ManagerRegistry $doctrine): Response
    {
        $repo=$doctrine->getRepository(Student::class);
        $list=$repo->findAll();
        return $this->render("student/list.html.twig",["students"=>$list]);
    }
    #[Route('/list2', name: 'app_list2_student')]
    public function getStudents2(StudentRepository $repo): Response
    {
        //$repo=$doctrine->getRepository(Student::class);
        $list=$repo->findAll();
        return $this->render("student/list.html.twig",["students"=>$list]);
    }
    #[Route('/add', name: 'app_add_student')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {
        $st=new Student();
        $f=$this->createForm(StudentType::class,$st );
        $f->handleRequest($request);
        if($f->isSubmitted() && $f->isValid() ){
            $em=$doctrine->getManager();
        $em->persist($st);
        $em->flush();
       // return $this->redirectToRoute("app_list2_student");
        }

        return $this->renderForm("student/add.html.twig",["myForm"=>$f]);
    }


}
