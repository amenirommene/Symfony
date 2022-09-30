<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/listclassroom", name="listclassroom")
     */
    public function listC(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Classroom::class);
        $listclass=$repo->findAll();
        return $this->render('classroom/index.html.twig', [
            'listc' => $listclass,
        ]);
    }

    /**
     * @Route("/classroom/{id}", name="classroom")
     */
    public function getClassroom($id): Response
    {
        $repo=$this->getDoctrine()->getRepository(Classroom::class);
        $class=$repo->find($id);
        return $this->render('classroom/classe.html.twig', [
            'classe' => $class,
        ]);
    }

    /**
     * @Route("/addClassroom", name="addclassroom")
     */
    public function addC(Request $request): Response
    {
        $cl = new Classroom();
        $myForm = $this->createForm(ClassroomType::class, $cl);
        $myForm->handleRequest($request);
        if ($myForm->isSubmitted()) {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($cl); //insert into ....
        $manager->flush(); //exécuter les requetes précedentes
            return $this->redirectToRoute("listclassroom");
        }
        return $this->render("classroom/add.html.twig",["monFormulaire"=>$myForm->createView()]);

    }

}
