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
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Paiement;
use App\Entity\Bail;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Component\HttpFoundation\JsonResponse;

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

                     $this->addFlash('success', 'Mouvements modifiés avec succès.');

                     return $this->render('mouvement/lister.html.twig', ['mouvement' => $mouvement,]);
               }
               else{
                    return $this->render('mouvement/modifier_mouvements.html.twig', array('form' => $form->createView(),));
               }
        }
    }

    public function uploadFileMouvement(): Response
    {
        return $this->render('mouvement/uploadFile.html.twig', [
            'controller_name' => 'MouvementController',
        ]);
    }

    public function listerEtModifierMouvements(Request $request, ManagerRegistry $doctrine)
    {
        // Récupérez vos mouvements à partir de la base de données
        $entityManager = $doctrine->getManager();
        $mouvementRepository = $doctrine->getRepository(Mouvement::class);
        $mouvements = $mouvementRepository->findAll();

        // Créez un formulaire avec une collection de formulaires pour chaque mouvement
        $form = $this->createFormBuilder(['mouvements' => $mouvements])
            ->add('mouvements', CollectionType::class, [
                'entry_type' => MouvementModifierType::class,
                'entry_options' => ['label' => false], // Supprimez les étiquettes pour chaque sous-formulaire
            ])
            ->getForm();

        // Gérez la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitez les données du formulaire et enregistrez-les en base de données
            // ...

            // Parcourez chaque mouvement pour effectuer les mises à jour nécessaires
            foreach ($mouvements as $mouvement) {
                // Récupérer l'entité Mouvement associée au formulaire
                $mouvementToUpdate = $mouvementRepository->find($mouvement->getId());

                if ($mouvementToUpdate) {
                    // Mettre à jour uniquement la sous-catégorie
                    $sousCategorie = $mouvement->getSousCategorie();
                    $mouvementToUpdate->setSousCategorie($sousCategorie);
                    $this->addFlash('success', 'Mouvement modifié avec succès.');
                } else {
                    // Handle case where the Mouvement with the given ID was not found
                    $this->addFlash('error', 'Mouvement non trouvé.');
                }
            }
            // Redirigez ou affichez un message de confirmation
            // ...
            // Flush une seule fois après la boucle
            $entityManager->flush();
        }

        return $this->render('mouvement/modifier_mouvements.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/api/mouvements', name: 'api_mouvements')]
    public function listerEtModifierMouvementsAPI(Request $request, ManagerRegistry $doctrine)
    {
        // Récupérez vos mouvements à partir de la base de données
        $entityManager = $doctrine->getManager();
        $mouvementRepository = $doctrine->getRepository(Mouvement::class);
        $mouvements = $mouvementRepository->findAll();

        // Vérifiez la méthode de la requête
        if ($request->getMethod() === 'POST') {
            // Récupérez les données JSON envoyées dans la requête
            $data = json_decode($request->getContent(), true);

            // Traitez les données du formulaire et enregistrez-les en base de données
            // ...

            // Parcourez chaque mouvement pour effectuer les mises à jour nécessaires
            foreach ($data['mouvements'] as $mouvementData) {
                // Récupérer l'entité Mouvement associée au formulaire
                $mouvementToUpdate = $mouvementRepository->find($mouvementData['id']);

                if ($mouvementToUpdate) {
                    // Mettre à jour uniquement la sous-catégorie
                    $sousCategorie = $mouvementData['sousCategorie'];
                    $mouvementToUpdate->setSousCategorie($sousCategorie);
                    $this->addFlash('success', 'Mouvement modifié avec succès.');
                } else {
                    // Handle case where the Mouvement with the given ID was not found
                    $this->addFlash('error', 'Mouvement non trouvé.');
                }
            }
            // Flush une seule fois après la boucle
            $entityManager->flush();

            return new JsonResponse(['message' => 'Mouvements mis à jour avec succès'], JsonResponse::HTTP_OK);
        }

        // Retournez les données JSON des mouvements
        $mouvementsData = [];
        foreach ($mouvements as $mouvement) {
            $sousCategorie = $mouvement->getSousCategorie();
            $sousCategorieData = null;

            if ($sousCategorie) {
                $sousCategorieData = [
                    'id' => $sousCategorie->getId(),
                    'libelle' => $sousCategorie->getLibelle(),
                ];
            }

            $mouvementsData[] = [
                'id' => $mouvement->getId(),
                'dateM' => $mouvement->getDateM()->format('Y-m-d'),
                'libelle' => $mouvement->getLibelle(),
                'debit' => $mouvement->getDebit(),
                'credit' => $mouvement->getCredit(),
                'sousCategorie' => $sousCategorieData,
            ];
        }

        return new JsonResponse($mouvementsData);
    }

    public function importerFichier(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        // Vérifiez si le formulaire est soumis
        if ($request->isMethod('POST')) {
            // Gérer le téléchargement du fichier
            $file = $request->files->get('file');

            // Vérifiez si un fichier a été téléchargé
            if ($file) {
                $reader = new Xlsx();
                $spreadsheet = $reader->load($file->getPathname());
                $worksheet = $spreadsheet->getActiveSheet();

                foreach ($worksheet->getRowIterator() as $row) {
                    $rowData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $rowData[] = $cell->getValue();
                    }

                    // Créer une nouvelle entité Mouvement et définir ses propriétés
                    $mouvement = new Mouvement();
                    $dateValue = $rowData[0];
                    if ($dateValue !== null) {
                        // Convertir la date en objet DateTime avec le format "d/m/Y"
                        $dateObject = \DateTime::createFromFormat('d/m/Y', $dateValue);

                        if ($dateObject !== false) {
                            // Convertir l'objet DateTime au format "Y-m-d"
                            $formattedDate = $dateObject->format('Y-m-d');
                            $mouvement->setDateM(\DateTime::createFromFormat('Y-m-d', $formattedDate));
                        } else {
                            // Gérer le cas où la conversion de la date échoue
                            $this->addFlash('error', 'La conversion de la date a échoué pour cette ligne : ' . $dateValue);
                            // Vous pouvez également décider de ne pas persister cette entité dans ce cas
                        }
                    } else {
                        // Gérer le cas où la valeur de la date est nulle
                        $this->addFlash('error', 'La valeur de la date est nulle pour cette ligne.');
                        // Vous pouvez également décider de ne pas persister cette entité dans ce cas
                    }
                    $libelleValue = $rowData[1];
                    if ($libelleValue !== null) {
                        $mouvement->setLibelle($libelleValue);
                    } else {
                        // Gérer le cas où la valeur du libellé est nulle
                        // Par exemple, enregistrer un message dans le journal ou ajouter un message flash
                        $this->addFlash('error', 'La valeur du libellé est nulle pour cette ligne.');
                        // Vous pouvez également décider de ne pas persister cette entité dans ce cas
                    }
                    $mouvement->setDebit(floatval($rowData[2])); // Supposons que la troisième colonne est le débit
                    $mouvement->setCredit(floatval($rowData[3])); // Supposons que la quatrième colonne est le crédit

                    // Ajouter d'autres propriétés au besoin

                    // Persister l'entité
                    $entityManager->persist($mouvement);
                }

                // Appliquer les changements à la base de données
                $entityManager->flush();

                // Ajouter un message flash ou tout autre retour d'information
                $this->addFlash('success', 'Importation réussie !');
            } else {
                // Gérer le cas où aucun fichier n'est téléchargé
                $this->addFlash('error', 'Aucun fichier téléchargé !');
            }
        }

        return $this->render('mouvement/importExcel.html.twig', [
            'controller_name' => 'MouvementController',
        ]);
    }
}
