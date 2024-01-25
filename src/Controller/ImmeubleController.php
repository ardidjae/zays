<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Immeuble;
use App\Entity\Appartement;



class ImmeubleController extends AbstractController
{
    #[Route('/immeuble', name: 'app_immeuble')]
    public function index(): Response
    {
        return $this->render('immeuble/index.html.twig', [
            'controller_name' => 'ImmeubleController',
        ]);
    }

    public function listerImmeuble(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Immeuble::class);

        $immeubles= $repository->findAll();
        return $this->render('immeuble/lister.html.twig', [
            'pImmeubles' => $immeubles,
        ]);
    }

    public function consulterImmeuble(ManagerRegistry $doctrine, $id) {

        $repository = $doctrine->getRepository(Immeuble::class);

        $immeuble= $repository->find($id);
        // Récupérer les appartements associés à cet immeuble
        $appartements = $immeuble->getAppartements();

        return $this->render('immeuble/consulter.html.twig', [
            'immeuble' => $immeuble,
            'appartements' => $appartements,
        ]);
    }
}
