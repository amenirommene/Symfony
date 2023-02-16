<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class testController extends AbstractController
{
    #[Route('/test/index', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
