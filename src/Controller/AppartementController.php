<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Appartement;

class AppartementController extends AbstractController
{
    #[Route('/appartement', name: 'app_appartement')]
    public function index(): Response
    {
        return $this->render('appartement/index.html.twig', [
            'controller_name' => 'AppartementController',
        ]);
    }

    public function consulterAppartement(ManagerRegistry $doctrine, int $id){

        $appartement = $doctrine->getRepository(Appartement::class)->find($id);

        if (!$appartement) {
            throw $this->createNotFoundException(
            'Aucun appartement trouvé'
            );
        }

        return $this->render('appartement/consulter.html.twig', [
            'appartement' => $appartement,
        ]);
    }
}
