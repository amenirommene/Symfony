<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{

    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig',
            [
            'name' => '3A54', 'niveau' => '3ème année']);
    }
    #[Route('/showteacher/{name}', name: 'app_show_teacher')]
    public function showTeacher($name): Response
    {
        return $this->render('teacher/showteacher.html.twig', ["myparam"=>$name]);
    }
    
}
