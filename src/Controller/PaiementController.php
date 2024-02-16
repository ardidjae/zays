<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Paiement;
use App\Entity\Bail;
use Symfony\Component\HttpFoundation\JsonResponse;

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

        $repositoryBail = $doctrine->getRepository(Bail::class);
        $bails= $repositoryBail->findAll();

        $paiements= $repository->findAll();
        return $this->render('paiement/listerLoyer.html.twig', [
            'pPaiements' => $paiements,
            'pBails' => $bails,
        ]);

    }

    #[Route('/api/loyer', name: 'api_loyer')]
    public function listerLoyerAPI(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Paiement::class);
        $paiements= $repository->findAll();
        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($paiements as $paiement) {
            $bail = $paiement->getBail();
            $montantTotalLoyer = $bail->getMontantHC() + $bail->getMontantCharges();
            $soldeMois = $bail->getMontantHC()  + $bail->getMontantCharges() - $paiement->getMontant();
            $soldeAnnee = $bail->getMontantHC()  + $bail->getMontantCharges() - $paiement->getMontant();

            $data[] = [
                'id' => $paiement->getId(),
                'appartement' => $paiement->getBail()->getAppartement()->getPorte(),
                'locataire' => implode(', ', array_map(function($locataire) {
                    return $locataire->getNom() . ' ' . $locataire->getPrenom();
                }, $paiement->getBail()->getLocataires()->toArray())),
                'loyer_du' => $montantTotalLoyer.' € ',
                'loyer_percu' => $paiement->getMontant() . ' € | Le ' . $paiement->getDateP()->format('d/m/Y'),
                'solde_mois' => $soldeMois.' € ',
                'solde_annee' => $soldeAnnee,
            ];
        }

        return new JsonResponse($data);
    }
}
