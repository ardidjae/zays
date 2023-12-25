<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Associe;
use App\Form\AssocieType;

class AssocieController extends AbstractController
{
    #[Route('/associe', name: 'app_associe')]
    public function index(): Response
    {
        return $this->render('associe/index.html.twig', [
            'controller_name' => 'AssocieController',
        ]);
    }

    public function ajouterAssocie(ManagerRegistry $doctrine,Request $request){
        $associe = new Associe();

        $form = $this->createForm(AssocieType::class, $associe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $associe = $form->getData();

                $entityManager = $doctrine->getManager();
                $entityManager->persist($associe);
                $entityManager->flush();

            return $this->render('associe/consulter.html.twig', ['associe' => $associe,]);
        }
        else
        {
            return $this->render('associe/ajouter.html.twig', array('form' => $form->createView(),));
	    }
    }

    public function consulterAssocie(ManagerRegistry $doctrine, int $id){

        $associe = $doctrine->getRepository(Associe::class)->find($id);

        if (!$associe) {
            throw $this->createNotFoundException(
            'Aucun associe trouvé'
            );
        }

        return $this->render('associe/consulter.html.twig', [
            'associe' => $associe,
        ]);
    }

    public function listerAssocie(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Associe::class);

        $associes= $repository->findAll();
        return $this->render('associe/lister.html.twig', [
            'pAssocies' => $associes,]);

    }
}
