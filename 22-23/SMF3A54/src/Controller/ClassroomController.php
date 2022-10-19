<?php

namespace App\Controller;

use App\Entity\Classroom;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/classroom', name: 'app_controller_classroom')]
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
    public function addClassroom(ManagerRegistry $doctrine): Response
    {
        //créer un objet $cl
        $cl = new Classroom();
        //remplir l'objet $cl
        $cl->setName("3A54");
        $cl->setSalle("I06");
        $cl->setClasse("3A");
        $cl2 = new Classroom();
        //remplir l'objet $cl
        $cl2->setName("3A54");
        $cl2->setSalle("I06");
        $cl2->setClasse("3A");
        $cl3 = new Classroom();
        //remplir l'objet $cl
        $cl3->setName("3A54");
        $cl3->setSalle("I06");
        $cl3->setClasse("3A");
        //créer une instance de l'entity manager
        $em = $doctrine->getManager();
        //préparation de la requête
        $em->persist($cl);
        $em->persist($cl2);
        $em->persist($cl3);
        //exécution de la requête
        $em->flush();
        return new Response("Ajout effectué");
        /* return $this->render('classroom/index.html.twig', [
             'controller_name' => 'ClassroomController',
         ]);*/
    }

    #[Route('/list', name: 'app_get_classroom')]
    public function getAllClassroom(ManagerRegistry $doctrine): Response
    {
      $repo=$doctrine->getRepository(Classroom::class);
      $list=$repo->findAll();
      return $this->render("classroom/index.html.twig", ['listCl'=>$list]);
    }

    #[Route('/find/{id}', name: 'app_get_one_classroom')]
    public function getClassroom(ManagerRegistry $doctrine, $id): Response
    {
        $repo=$doctrine->getRepository(Classroom::class);
        $cl=$repo->find($id);
        return $this->render("classroom/classroom.html.twig", ['cl'=>$cl]);
    }

    #[Route('/remove/{id}', name: 'app_remove_classroom')]
    public function removeClassroom(ManagerRegistry $doctrine, $id): Response
    {
        $repo=$doctrine->getRepository(Classroom::class);
        $cl=$repo->find($id);
    $em=$doctrine->getManager();
    $em->remove($cl);
    $em->flush();
    return new Response("deleted");
    }
    #[Route('/remove2/{id}', name: 'app_remove2_classroom')]
    public function remove2Classroom
    (ManagerRegistry $doctrine, Classroom $cl): Response
    {

        $em=$doctrine->getManager();
        $em->remove($cl);
        $em->flush();
        return new Response("deleted");
    }

    #[Route('/remove3/{id}', name: 'app_remove3_classroom')]
    public function remove3Classroom(ManagerRegistry $doctrine, Classroom $cl): Response
    {
        $repo=$doctrine->getRepository(Classroom::class);
        $repo->remove($cl,true);

        return new Response("deleted");
    }
}
