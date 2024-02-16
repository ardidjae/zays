<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Associe;
use App\Form\AssocieType;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Societe;

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

    #[Route('/api/associe/ajouter', name: 'api_ajouter_associe', methods: ['POST'])]
    public function ajouterAssocieAPI(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = [];

        // Récupérer les données de la requête JSON
        $requestData = json_decode($request->getContent(), true);

        // Vérifier si les données requises sont présentes
        if (!isset($requestData['nom'], $requestData['prenom'], $requestData['numRue'], $requestData['rue'], $requestData['copos'], $requestData['ville'], $requestData['tel'], $requestData['mail'], $requestData['nbPart'])) {
            $data['error'] = 'Données manquantes';
            return new JsonResponse($data, JsonResponse::HTTP_BAD_REQUEST);
        }

        // Créer une nouvelle instance d'Associe
        $associe = new Associe();
        $associe->setNom($requestData['nom']);
        $associe->setPrenom($requestData['prenom']);
        $associe->setNumRue($requestData['numRue']);
        $associe->setRue($requestData['rue']);
        $associe->setCopos($requestData['copos']);
        $associe->setVille($requestData['ville']);
        $associe->setTel($requestData['tel']);
        $associe->setMail($requestData['mail']);
        $associe->setNbPart($requestData['nbPart']);

        // Vérifier si la société est spécifiée
        if (isset($requestData['nom'])) {
            $entityManager = $doctrine->getManager();

            // Charger la société depuis la base de données
            $societe = $entityManager->getRepository(Societe::class)->find($requestData['societe']['id']);

            // Vérifier si la société existe
            if (!$societe) {
                $data['error'] = 'Société non trouvée';
                return new JsonResponse($data, JsonResponse::HTTP_NOT_FOUND);
            }

            // Associer la société à l'associé
            $associe->setSociete($societe);

            // Enregistrer l'associé dans la base de données
            $entityManager->persist($associe);
            $entityManager->flush();

            // Vous pouvez retourner l'ID de l'associé nouvellement ajouté si nécessaire
            $data['id'] = $associe->getId();
            $data['message'] = 'Associe ajouté avec succès!';
        } else {
            $data['error'] = 'Données de société manquantes';
        }

        return new JsonResponse($data);
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

    #[Route('/api/associe', name: 'api_associe')]
    public function listerAssocieAPI(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Associe::class);
        $associes= $repository->findAll();
        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($associes as $associe) {
            $data[] = [
                'id' => $associe->getId(),
                'nom' => $associe->getNom(),
                'prenom' => $associe->getPrenom(),
                'numRue' => $associe->getNumRue(),
                'rue' => $associe->getRue(),
                'copos' => $associe->getCopos(),
                'ville' => $associe->getVille(),
                'tel' => $associe->getTel(),
                'nbPart' => $associe->getNbPart(),
                'societe' => [
                    'id' => $associe->getSociete()->getId(),
                    'porte' => $associe->getSociete()->getNom(),
                ],

            ];
        }

        return new JsonResponse($data);
    }

}
