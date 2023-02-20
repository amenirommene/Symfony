<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    #[Route('/classroom/list', name: 'app_list_classroom')]
    public function getAllClass(ClassroomRepository $repo): Response
    {
        //récupérer la liste des classes
        $cls=$repo->findAll();
        //retourner view list et envoyer la liste des classes
        return $this->render('classroom/list.html.twig', [
            'classrooms' => $cls
        ]);
    }

    #[Route('/classroom/addStatique', name: 'app_addStatique_classroom')]
    public function addClassStatique(ClassroomRepository $repo): Response
    {
        //1- préparer mon objet
        $classroom1=new Classroom();
        $classroom1->setName("Classe 3A7");
        $classroom1->setNbstudents(32);
        $classroom2=new Classroom();
        $classroom2->setName("Classe 3A8");
        $classroom2->setNbstudents(35);
        //2- ajout des objets

        $repo->save($classroom1);
        $repo->save($classroom2,true);

        //3- redirection vers la liste des classrooms
        return $this->redirectToRoute("app_list_classroom");
    }
    #[Route('/classroom/addStatique2', name: 'app_addStatique2_classroom')]
    public function addClassStatique2(ManagerRegistry $doctrine): Response
    {
        //1- préparer mon objet
        $classroom1=new Classroom();
        $classroom1->setName("Classe 3A11");
        $classroom1->setNbstudents(32);
        $classroom2=new Classroom();
        $classroom2->setName("Classe 3A12");
        $classroom2->setNbstudents(35);
        //2- ajout des objets
         $em=$doctrine->getManager();
         $em->persist($classroom1);
         $em->persist($classroom2);
         $em->flush();

        //3- redirection vers la liste des classrooms
        return $this->redirectToRoute("app_list_classroom");
    }

    #[Route('/classroom/deleteStatique/{id}', name: 'app_deleteStatique_classroom')]
    public function deleteStatique($id,ClassroomRepository $repo,ManagerRegistry $doctrine): Response
    {
        $classroom=$repo->find($id);
        $em=$doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("app_list_classroom");
    }

}
