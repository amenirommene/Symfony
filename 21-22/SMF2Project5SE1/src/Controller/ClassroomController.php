<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/listclassroom", name="listclassroom")
     */
    public function index(): Response
    {

        $repo= $this->getDoctrine()->getRepository(Classroom::class);
        $listc=$repo->findAll();
        return $this->render('classroom/index.html.twig', [
            'list' => $listc
        ]);
    }
    /**
     * @Route("/listclassroom2", name="listclassroom2")
     */
    public function index2(ClassroomRepository $repo): Response
    {
        $listc=$repo->findAll();
        return $this->render('classroom/index.html.twig', [
            'list' => $listc
        ]);
    }
    /**
     * @Route("/addC", name="addC")
     */
    public function addC(): Response
    {

        $cl=new Classroom();
        $cl->setName('4SE1');
        $cl1=new Classroom();
        $cl1->setName('4SE2');
        $manager=$this->getDoctrine()->getManager();
        $manager->persist($cl);
        $manager->persist($cl1);
        $manager->flush();
        return $this->redirectToRoute("listclassroom2");
        /* return $this->render('classroom/index.html.twig', [
            'list' => $listc
        ]);*/

    }

    /**
     * @Route("/addClassroom", name="addClassroom")
     */
    public function addClassroom(Request $request): Response
    {

        $cl=new Classroom();
        $myForm=$this->createForm(ClassroomType::class,$cl);
        $myForm=$myForm->handleRequest($request);
        $myForm->add('Ajouter', SubmitType::class);
        if ($myForm->isSubmitted()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cl);
            $manager->flush();
            return $this->redirectToRoute("listclassroom2");
        }
        return $this->render('classroom/add.html.twig',['monF'=>$myForm->createView()]);

    }

    /**
     * @Route("/updateC/{id}", name="updateClassroom")
     */
    public function updateClassroom(ClassroomRepository $repo,$id, Request $request): Response
    {
        $cl=$repo->find($id);
        $myForm=$this->createForm(ClassroomType::class,$cl);
        $myForm->handleRequest($request);
        $myForm->add('Modifier', SubmitType::class);
        if ($myForm->isSubmitted()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cl);
            $manager->flush();
            return $this->redirectToRoute("listclassroom2");
        }
        return $this->render('classroom/add.html.twig',['monF'=>$myForm->createView()]);

    }
}
