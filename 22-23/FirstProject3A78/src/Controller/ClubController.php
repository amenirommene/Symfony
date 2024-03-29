<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club/index', name: 'app_club')] //une route : chemin qui va me permettre d'éxucter la méthode
   //.......(path, nom de la route)
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    #[Route('/club/formations', name: 'app_formations')]
    public function getFormations(){
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony 4','Description'=>'formation pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020', 'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'formation theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'formation theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>12));
        return $this->render('club/index.html.twig', [
            'formations' => $formations,
        ]);

    }
}
