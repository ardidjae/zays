<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mouvement;
use App\Entity\SousCategorie;
use App\Form\MouvementModifierType;
use Symfony\Component\Security\Core\Security;

class MouvementController extends AbstractController
{
    #[Route('/mouvement', name: 'app_mouvement')]
    public function index(): Response
    {
        return $this->render('mouvement/index.html.twig', [
            'controller_name' => 'MouvementController',
        ]);
    }

    public function listerMouvement(ManagerRegistry $doctrine, Security $security){

        // Vérifier si l'utilisateur est connecté
        if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
            // Récupérer l'utilisateur connecté
            $user = $this->getUser();

            $repository = $doctrine->getRepository(Mouvement::class);
            $sousCategoriesRepository = $doctrine->getRepository(SousCategorie::class);

            $sousCategories = $sousCategoriesRepository->findAll();

            // Vérifier le rôle de l'utilisateur
            if ($security->isGranted('ROLE_ASSOCIE')) {
                // Si l'utilisateur a le rôle ROLE_ASSOCIE, afficher les mouvements avec sous-catégorie non nulle
                $mouvements = $repository->findBy(['souscategorie' => $sousCategories]);
            } elseif ($security->isGranted('ROLE_ADMIN')) {
                // Si l'utilisateur a le rôle ROLE_ADMIN, afficher les mouvements avec sous-catégorie_id NULL
                $mouvements = $repository->findBy(['souscategorie' => NULL]);
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'a ni ROLE_ASSOCIE ni ROLE_ADMIN
                return $this->redirectToRoute('app_login');
            }

            return $this->render('mouvement/lister.html.twig', [
                'pMouvements' => $mouvements,
                'pSousCategories' => $sousCategories,
            ]);
        } else {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            return $this->redirectToRoute('app_login');
        }
    }

    public function modifierMouvement(ManagerRegistry $doctrine, $id, Request $request){

        //récupération de l'étudiant dont l'id est passé en paramètre
        $mouvement = $doctrine->getRepository(Mouvement::class)->find($id);

        if (!$mouvement) {
            throw $this->createNotFoundException('Aucun mouvement trouvé avec le numéro '.$id);
        }
        else
        {
                $form = $this->createForm(MouvementModifierType::class, $mouvement);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                     $mouvement = $form->getData();
                     $entityManager = $doctrine->getManager();
                     $entityManager->persist($mouvement);
                     $entityManager->flush();
                     return $this->render('mouvement/lister.html.twig', ['mouvement' => $mouvement,]);
               }
               else{
                    return $this->render('mouvement/modifier.html.twig', array('form' => $form->createView(),));
               }
        }
    }

    public function uploadFileMouvement(): Response
    {
        return $this->render('mouvement/uploadFile.html.twig', [
            'controller_name' => 'MouvementController',
        ]);
    }
}
