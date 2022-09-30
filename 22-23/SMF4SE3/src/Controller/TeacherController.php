<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
  #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController4se3',
        ]);
    }

    #[Route('/teacher2', name: 'app_teacher2')]
    public function bonjour(): Response
    {
        return $this->render('teacher/index2.html.twig', [
            'controller_name' => 'TeacherController4se3',
        ]);
    }
}
