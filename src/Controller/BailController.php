<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Bail;

class BailController extends AbstractController
{
    /*
     * #[Route('/bail', name: 'app_bail')]
     */
    public function index(): Response
    {
        return $this->render('bail/accueil.html.twig', [
            'controller_name' => 'BailController',
        ]);
    }

    public function listerBaux(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails= $repository->findAll();
        return $this->render('bail/lister.html.twig', [
            'pBails' => $bails,]);

    }

    public function listerLoyer(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails= $repository->findAll();
        return $this->render('bail/lister.html.twig', [
            'pBails' => $bails,]);

    }
}
