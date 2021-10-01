<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'param1' => '4SE3','param2'=>'Symfony'
        ]);
    }
    /**
     * @Route("/getname/{nom}", name="getname")
     */
    public function getName($nom): Response
    {
        return $this->render('club/detail.html.twig', [
            'myName' => $nom
        ]);
    }

    /**
     * @Route("/list", name="list")
     */
    public function getList(): Response
    {
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony 4','Description'=>'formation pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020', 'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'formation theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'formation theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>20));


        return $this->render('club/list.html.twig', [
            'mesformations' => $formations
        ]);
    }
}
