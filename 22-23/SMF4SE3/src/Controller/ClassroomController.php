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
        $cl2=new Classroom();
        $cl2->setName("3A54");
        $cl3=new Classroom();
        $cl3->setName("4SE3");
        //créer une instance de l'Entity Manager
        $repo=$doctrine ->getRepository();
       $repo->save($cl1);
        $repo->save($cl2);
        $repo->save($cl3,true);
        return new Response("Ajout effectué");
    }
    #[Route('/add2', name: 'app_add2_classroom')]
    public function add2(ManagerRegistry $doctrine): Response
    {
        //création de l'objet à ajouter dans la table
        $cl1=new Classroom();
        $cl1->setName("3A58");
        $cl2=new Classroom();
        $cl2->setName("3A54");
        $cl3=new Classroom();
        $cl3->setName("4SE3");
        //créer une instance de l'Entity Manager
        $em=$doctrine ->getManager();
        $em->persist($cl1);
        $em->persist($cl2);
        $em->persist($cl3);
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
    #[Route('/delete/{id}', name: 'app_delete_classroom')]
    public function deleteClassroom(ManagerRegistry $doctrine, $id): Response
    {
        $repo=$doctrine->getRepository(Classroom::class);
        $cl=$repo->find($id);
        $em=$doctrine->getManager();
        $em->remove($cl);
        $em->flush();

        return new Response("deleted");

    }
    #[Route('/delete2/{id}', name: 'app_delete2_classroom')]
    public function delete2Classroom(ManagerRegistry $doctrine, Classroom $cl=null): Response
    {
        $em=$doctrine->getManager();
        $em->remove($cl);
        $em->flush();

        return $this->redirectToRoute("app_list_classroom");

    }
}
