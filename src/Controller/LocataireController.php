<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Locataire;
use App\Form\LocataireType;

class LocataireController extends AbstractController
{
    #[Route('/locataire', name: 'app_locataire')]
    public function index(): Response
    {
        return $this->render('locataire/index.html.twig', [
            'controller_name' => 'LocataireController',
        ]);
    }

    public function ajouterLocataire(ManagerRegistry $doctrine,Request $request){
        $locataire = new Locataire();

        $form = $this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $locataire = $form->getData();

                $entityManager = $doctrine->getManager();
                $entityManager->persist($locataire);
                $entityManager->flush();

            return $this->render('locataire/consulter.html.twig', ['locataire' => $locataire,]);
        }
        else
        {
            return $this->render('locataire/ajouter.html.twig', array('form' => $form->createView(),));
	    }
    }

    public function consulterLocataire(ManagerRegistry $doctrine, int $id){

		$locataire= $doctrine->getRepository(Locataire::class)->find($id);

		if (!$locataire) {
			throw $this->createNotFoundException(
            'Aucun locataire trouvé avec le numéro '.$id
			);
		}

		//return new Response('locataire : '.$locataire->getNom());
		return $this->render('locataire/consulter.html.twig', [
            'locataire' => $locataire,]);
	}
}
