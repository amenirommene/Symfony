<?php

namespace App\Controller;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(Request $request): Response
    {
        $st=new Student();
        $f=$this->createForm(StudentType::class,$st);
        $f->handleRequest($request);
        if ($f->isSubmitted()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($st);
            $manager->flush();
        }
        return $this->render('student/add.html.twig', [
            'myForm' => $f->createView(),
        ]);
    }

    /**
     * @Route("/lists", name="lists")
     */
    public function listS(): Response
    {
        $repo=$this->getDoctrine()
            ->getRepository(\App\Entity\Student::class);

        $list=$repo->findAll();
        return $this->render('student/index.html.twig', [
            'listc' => $list,
        ]);
    }
}
