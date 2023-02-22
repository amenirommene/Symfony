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
    public function getAllClasses(ClassroomRepository $repo): Response
    {
//1-récupérer les classes
        $list=$repo->findAll();
        //2- retourner la vue
        return $this->render('classroom/list.html.twig',
            ["listecl"=>$list]
        );
    }


    #[Route('/classroom/addStatique2', name: 'app_addst2_classroom')]
    public function addClass2(ManagerRegistry $doctrine): Response
    {
        //1- préparer l'objet à ajouter
        $cl1=new Classroom();
        $cl1->setName("3A9");
        $cl1->setNbstudents(25);
        $cl2=new Classroom();
        $cl2->setName("3A13");
        $cl2->setNbstudents(25);
       //2-ajouter mon objet
        //2.1- récupérer le gestionnairede l'entité
        $em=$doctrine->getManager();
        $em->persist($cl1); //insert to
        $em->persist($cl2);
        $em->flush();
        //3- redirection vers la liste des classes
        return $this->redirectToRoute("app_list_classroom");
    }
    #[Route('/classroom/addStatique', name: 'app_addst_classroom')]
    public function addClass(ClassroomRepository $repo): Response
    {
        //1- préparer l'objet à ajouter
        $cl1=new Classroom();
        $cl1->setName("3A9");
        $cl1->setNbstudents(25);
        $cl2=new Classroom();
        $cl2->setName("3A13");
        $cl2->setNbstudents(25);
        //2-ajouter mon objet
        $repo->save($cl1);
        $repo->save($cl2,true);
        //3- redirection vers la liste des classes
        return $this->redirectToRoute("app_list_classroom");

    }

    #[Route('/classroom/delete/{id}', name: 'app_delete_classroom')]
    public function delete($id,ClassroomRepository $repo): Response
    {
        //- 1- récupérer
        $cl=$repo->find($id);
        //2- supprimer
       $repo->remove($cl,true);
        //3- redirection vers la liste des classes
        return $this->redirectToRoute("app_list_classroom");
    }

    #[Route('/classroom/delete2/{id}', name: 'app_delete_classroom')]
    public function delete2($id,ManagerRegistry $doctrine): Response
    {
        //- 1- récupérer
        $cl=$doctrine->getRepository(Classroom::class)
            ->find($id);
        //2- supprimer
        $em=$doctrine->getManager();
        $em->remove($cl);
        $em->flush();
        //3- redirection vers la liste des classes
        return $this->redirectToRoute("app_list_classroom");
    }
}
