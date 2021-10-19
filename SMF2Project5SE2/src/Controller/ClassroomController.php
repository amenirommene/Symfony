<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroomlist", name="classroomlist")
     */
    public function list(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Classroom::class);
        $list=$repo->findAll();
        return $this->render('classroom/index.html.twig', ['listClassroom'=>$list]);

    }
    /**
     * @Route("/classroomlist2", name="classroomlist2")
     */
    public function list2(ClassroomRepository $repo): Response
    {

        $list=$repo->findAll();
        return $this->render('classroom/index.html.twig', ['listClassroom'=>$list]);

    }

    /**
     * @Route("/classroom/{id}", name="classroom")
     */
    public function getClassroom(ClassroomRepository $repoc, $id): Response
    {
        $classr=$repoc->find($id);
        return $this->render('classroom/class.html.twig', ['classroom'=>$classr]);

    }

    /**
     * @Route("/add", name="addclassroom")
     */
    public function addClassroom(): Response
    {
        $classr= new Classroom();
        $classr->setName("4SE66");
        $em=$this->getDoctrine()->getManager();
        $em->persist($classr) ;
        $em->flush();
        return new Response("added");
    }

    /**
     * @Route("/addClassroom", name="addclassroomform")
     */
    public function addC(Request $request): Response
    {
        $cl=new Classroom();
       $f=$this->createForm(ClassroomType::class, $cl);
       $f=$f->handleRequest($request);
       if ($f->isSubmitted()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($cl);
        $em->flush();
       }
       return $this->render('classroom/add.html.twig',
           ['myform'=>$f->createView()]);
    }
}
