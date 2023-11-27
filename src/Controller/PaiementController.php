<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Paiement;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(): Response
    {
        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }

    public function listerLoyer(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Paiement::class);

        $paiements= $repository->findAll();
        return $this->render('paiement/listerLoyer.html.twig', [
            'pPaiements' => $paiements,]);

    }
}
