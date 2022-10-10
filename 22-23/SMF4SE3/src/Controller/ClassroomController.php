<?php

namespace App\Controller;

use App\Entity\Classroom;
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

    #[Route('/add', name: 'app_add_classroom')]
    public function add(ManagerRegistry $doctrine): Response
    {
        //création de l'objet à ajouter dans la table
        $cl1=new Classroom();
        $cl1->setName("3A58");
        //créer une instance de l'Entity Manager
        $em=$doctrine ->getManager();
        $em->persist($cl1);
        $em->flush();
        return new Response("Ajout effectué");
    }

    #[Route('/list', name: 'app_list_classroom')]
    public function getAll(ManagerRegistry $doctrine): Response
    {
        $repo=$doctrine->getRepository(Classroom::class);
        $list=$repo->findAll();
        return $this->render('classroom/list.html.twig', [
            'listOfClassroom' => $list,
        ]);
    }

    #[Route('/get/{id}', name: 'app_get_classroom')]
    public function getClassroom(ManagerRegistry $doctrine, $id): Response
    {
        $repo=$doctrine->getRepository(Classroom::class);
        $cl=$repo->find($id);
        return $this->render('classroom/classroom.html.twig', [
            'classroom' => $cl,
        ]);
    }

}
