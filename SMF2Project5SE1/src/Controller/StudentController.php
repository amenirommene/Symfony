<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{

    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        //return  new Response("Bonjour mes étudiants");
        return $this->render('student/index.html.twig',
            ['controller_name' => 'StudentController', "classe"=>"5SE1"]);
    }
    /**
     * @Route("/show/{name}", name="showstudent")
     */
    public function showstudent($name): Response
    {
        //return  new Response("Bonjour mes étudiants");
        return $this->render('student/student.html.twig',
            ["pathparam"=> $name]);
    }
}
