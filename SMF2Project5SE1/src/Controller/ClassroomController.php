<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
