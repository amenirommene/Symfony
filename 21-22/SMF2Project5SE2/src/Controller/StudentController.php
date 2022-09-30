<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/get", name="getStudent")
     */
    public function getStudents(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Student::class);
        $students = $repo->findAll();
        return $this->render('student/list.html.twig', [
            'list' => $students,
        ]);
    }

    /**
     * @Route("/student/add", name="addStudent")
     */
    public function addStudent(Request $request): Response
    {
        $st=new Student();
        /*
         * $email=$request->get('email');
         * $nsc=$request->get('nsc');
         * $classroom=$request->get('classroom');
         * $st->setEmail($email);
         * $st->setNsc($nsc);
         * $st->setClassroom($classroom);
         * est ce que le click sur le bouton est fait ou non???
         */
        $f=$this->createForm(StudentType::class,$st);
        $f->handleRequest($request);
        if ($f->isSubmitted()){
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($st);
            $manager->flush();
        }
        return $this->render('student/index.html.twig', [
            'myForm' => $f->createView(),
        ]);
    }
    /**
     * @Route("/student/delete/{id}", name="deleteStudent")
     */
    public function deleteStudent($id,Request $request): Response
    {
        $repo=$this->getDoctrine()->getRepository(Student::class);
        $st= $repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($st);
        $em->flush();
        return $this->redirectToRoute("getStudent");
    }

    /**
     * @Route("/student/update/{id}", name="updateStudent")
     */
    public function updateStudent($id,Request $request): Response
    {
        $st=$this->getDoctrine()->getRepository(Student::class)->find($id);
        $f=$this->createForm(StudentType::class,$st);
        $f->handleRequest($request);
        if ($f->isSubmitted()){
            $manager=$this->getDoctrine()->getManager();
           // $manager->persist($st);
            $manager->flush();
        }
        return $this->render('student/index.html.twig', [
            'myForm' => $f->createView(),
        ]);
    }
}
