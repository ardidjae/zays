<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Societe;
use Doctrine\Persistence\ManagerRegistry;



class SocieteController extends AbstractController
{
    #[Route('/societe', name: 'app_societe')]
    public function index(): Response
    {
        return $this->render('societe/index.html.twig', [
            'controller_name' => 'SocieteController',
        ]);
    }

    #[Route('/api/societes', name: 'api_societes')]
    public function listerSocietesAPI(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Societe::class);
        $societes = $repository->findAll();

        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($societes as $societe) {
            $data[] = [
                'id' => $societe->getId(),
                'nom' => $societe->getNom(),
            ];
        }

        return new JsonResponse($data);
    }
}
