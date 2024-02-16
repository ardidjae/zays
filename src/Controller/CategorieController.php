<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;


class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    #[Route('/api/categorie', name: 'api_categorie')]
    public function listerCategorieAPI(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Categorie::class);
        $categories= $repository->findAll();
        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($categories as $categorie) {
            $data[] = [
                'id' => $categorie->getId(),
                'libelle' => $categorie->getLibelle(),
            ];
        }

        return new JsonResponse($data);
    }
}
