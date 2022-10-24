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

    #[Route('/getliststudent', name: 'app_list_student')]
    public function list(StudentRepository $repo): Response
    {
        $students=$repo->findAll();
        return $this->render("student/list.html.twig", ['students'=>$students]);
    }

    #[Route('/addstudent', name: 'app_add_student')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {
        $student=new Student();
        $form=$this->createForm(StudentType::class,$student );
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $em=$doctrine->getManager();
            $em->persist($student);
            $em->flush();
        }
        return $this->renderForm("student/add.html.twig", ['f'=>$form]);

    }

    #[Route('/updatestudent/{num}', name: 'app_update_student')]
    public function update(StudentRepository $repo, ManagerRegistry $doctrine, Request $request): Response
    {
        $num_inscrit=$request->get('num');
      //  $nb=$request->get('nb');
        $student=$repo->find($num_inscrit);
        $form=$this->createForm(StudentType::class,$student );
        //handleRequest : rempli l'objet student à partir du formulaire
        //+ détecte si le formulaire isSubmitted et valid
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("app_list_student");
        }
        return $this->renderForm("student/add.html.twig", ['f'=>$form]);

    }

}
