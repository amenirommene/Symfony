<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{

    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        //return  new Response("Bonjour mes étudiants");
        return $this->render('student/index.html.twig',
            ['param1'=>'5SE1', 'param2'=>'Symfony']);
    }
    /**
     * @Route("/show/{name}", name="showstudent")
     */
    public function showstudent($name): Response
    {
        //return  new Response("Bonjour mes étudiants");
        return $this->render('student/student.html.twig',
            ["pathparam"=> $name]);
    }
    /**
     * @Route("/student/get", name="getStudents")
     */
    public function getStudents(Request $request): Response
    {
        $repo=$this->getDoctrine()->getRepository(Student::class);
        $students=$repo->findAll();
        return $this->render("student/list.html.twig", ["students"=>$students]);
    }

    /**
     * @Route("/student/add", name="addStudent")
     */
    public function addStudent(Request $request): Response
    {

        //instance de student dans lequel je vais stocker les données de mon formulaire
        $st=new Student();
        /*$email=$request->get('email');
         * $nsc=$request->get('nsc');
         * $classe=$request->get('classe');
         * $st->setEmail($email);
         */
        //créer le formulaire
        $form=$this->createForm(StudentType::class,$st);
        $form->handleRequest($request);
        if($form->isSubmitted()){
             $manager=$this->getDoctrine()->getManager();
             $manager->persist($st);
             $manager->flush();
            return $this->redirectToRoute("getStudents");
        }
        return $this->render('student/add.html.twig',
            ["myForm"=> $form->createView()]);
    }
}
