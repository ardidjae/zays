<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Doctrine\Persistence\ManagerRegistry;

class SousCategorieController extends AbstractController
{
    #[Route('/sous/categorie', name: 'app_sous_categorie')]
    public function index(): Response
    {
        return $this->render('sous_categorie/index.html.twig', [
            'controller_name' => 'SousCategorieController',
        ]);
    }

    #[Route('/api/sousCategorie', name: 'api_SousCategorie')]
    public function listerSousCategorieAPI(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(SousCategorie::class);
        $sousCategories= $repository->findAll();
        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($sousCategories as $sousCategorie) {
            $data[] = [
                'id' => $sousCategorie->getId(),
                'libelle' => $sousCategorie->getLibelle(),
                'categorie' => [
                    'id' => $sousCategorie->getCategorie()->getId(),
                    'libelle' => $sousCategorie->getCategorie()->getLibelle(),
                ],
            ];
        }

        return new JsonResponse($data);
    }
}
