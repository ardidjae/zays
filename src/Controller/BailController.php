<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Bail;
use App\Entity\Paiement;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\BailType;
use App\Entity\Locataire;
use App\Form\BailModifierType;
use App\Form\BailCloturerType;
use Symfony\Component\Security\Core\Security;
use App\Entity\SousCategorie;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;


class BailController extends AbstractController
{
    /*
     * #[Route('/bail', name: 'app_bail')]
     */
    /*
    public function indexs(): Response
    {
        return $this->render('bail/accueil.html.twig', [
            'controller_name' => 'BailController',
        ]);
    }
    */

    public function index(Security $security): Response
    {
        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            // Redirige vers la page de connexion s'ils ne sont pas connectés
            return $this->redirectToRoute('app_login');
        }

        // Redirige vers la page d'accueil s'ils sont connectés
        return $this->render('paiement/listerLoyer.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }

    public function listerBaux(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails = $repository->findBy(['archive' => 0]);
        return $this->render('bail/lister.html.twig', [
            'pBails' => $bails,]);

    }

    #[Route('/api/baux', name: 'api_baux')]
    public function listerBauxAPI(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Bail::class);
        $bails = $repository->findBy(['archive' => 0]);

        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($bails as $bail) {
            $data[] = [
                'id' => $bail->getId(),
                'montantHC' => $bail->getMontantHC(),
                'MontantCharges' => $bail->getMontantCharges(),
                'MontantCaution' => $bail->getMontantCaution(),
                'dateDebut' => $bail->getDateDebut()->format('Y-m-d'),
                'dateFin' => $bail->getDateFin() ? $bail->getDateFin()->format('Y-m-d') : null,
                'dureeBail' => $bail->getDureeBail(),
                'appartement' => [
                    'id' => $bail->getAppartement()->getId(),
                    'porte' => $bail->getAppartement()->getPorte(),
                    'surfaceHabitable' => $bail->getAppartement()->getSurfaceHabitable(),
                    'situation' => $bail->getAppartement()->getSituation(),
                    'immeuble' => $bail->getAppartement()->getImmeuble()->getNom(),
                    'numCompteur' => $bail->getAppartement()->getNumCompteur(),
                ],
                'associe' => [
                    'nom' => $bail->getAssocie() ? $bail->getAssocie()->getNom() : null,
                    // Add other properties if needed
                ],
                'locataires' => $bail->getLocataires()->map(function($locataire) {
                    return [
                        'nom' => $locataire->getNom(),
                        'prenom' => $locataire->getPrenom(),
                        // Add other properties if needed
                    ];
                })->toArray(),
                'nomCaution1' => $bail->getNomCaution1(),
                'nomCaution2' => $bail->getNomCaution2(),
                'paiements' => $bail->getPaiements()->map(function ($paiement) {
                    return [
                        'dateP' => $paiement->getDateP()->format('Y-m-d'),
                        'montant' => $paiement->getMontant(),
                        // Add other properties if needed
                    ];
                })->toArray(),

                // Ajoutez d'autres propriétés au besoin
            ];
        }

        return new JsonResponse($data);
    }

    public function listerBauxArchives(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails = $repository->findBy(['archive' => 1]);
        return $this->render('bail/listerBauxArchives.html.twig', [
            'pBails' => $bails,]);

    }

    public function listerLoyer(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails= $repository->findAll();
        return $this->render('bail/lister.html.twig', [
            'pBails' => $bails,]);

    }

    // Générer la quittance sous forme PDF pour un bail donné
    public function quittancePDF(ManagerRegistry $doctrine, int $id){

        $bail = $doctrine->getRepository(Bail::class)->find($id);
        $repositoryPaiement = $doctrine->getRepository(Paiement::class);
        $paiements= $repositoryPaiement->findAll();

        if (!$bail) {
            throw $this->createNotFoundException(
            'Aucun bail trouvé'
            );
        }

        // Récupérer les dates actuelles du mois
        $dateDebut = new \DateTime('first day of this month');
        $dateFin = new \DateTime('last day of this month');

        // Instanciation de la librairie DOMPDF
        $dompdf = new Dompdf();

        // Contenu HTML
        $html = $this->renderView('bail/quittancePDF.html.twig', [
            'bail' => $bail,
            'pPaiements' => $paiements,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
        ]);

        // Chargement du contenu HTML
        $dompdf->loadHtml($html);

        // Configuration des options
        $dompdf->setPaper('A4', 'portrait');

        // Rendu du PDF
        $dompdf->render();

        $numeroAppartement = $bail->getAppartement()->getPorte(); // Mettez à jour selon votre entité Appartement
        $fileName = sprintf("%04d_%02d_%d.pdf", date('Y'), date('m'), $numeroAppartement);

        // Envoi du PDF dans la réponse avec le nom de fichier spécifié
        return $dompdf->stream($fileName, [
            "Attachment" => false
        ]);
    }

    public function consulterBaux(ManagerRegistry $doctrine, int $id){

        $bail = $doctrine->getRepository(Bail::class)->find($id);

        $repositoryPaiement = $doctrine->getRepository(Paiement::class);
        $paiements= $repositoryPaiement->findAll();

        if (!$bail) {
            throw $this->createNotFoundException(
            'Aucun bail trouvé'
            );
        }

        return $this->render('bail/consulter.html.twig', [
            'bail' => $bail,
            'pPaiements' => $paiements,
        ]);
    }

    #[Route('/api/baux/consulter/{id}', name: 'api_consulter_baux')]
    public function consulterBauxAPI(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $bail = $doctrine->getRepository(Bail::class)->find($id);

        $data = [];
        $data[] = [
            'id' => $bail->getId(),
            'montantHC' => $bail->getMontantHC(),
            'MontantCharges' => $bail->getMontantCharges(),
            'MontantCaution' => $bail->getMontantCaution(),
            'dateDebut' => $bail->getDateDebut()->format('Y-m-d'),
            'dateFin' => $bail->getDateFin() ? $bail->getDateFin()->format('Y-m-d') : null,
            'dureeBail' => $bail->getDureeBail(),
            'associe' => [
                'nom' => $bail->getAssocie() ? $bail->getAssocie()->getNom() : null,
                // Add other properties if needed
            ],
            'appartement' => [
                'id' => $bail->getAppartement()->getId(),
                'porte' => $bail->getAppartement()->getPorte(),
                'surfaceHabitable' => $bail->getAppartement()->getSurfaceHabitable(),
            ],
            'locataires' => $bail->getLocataires()->map(function ($locataire) {
                return [
                    'id' => $locataire->getId(),
                    'nom' => $locataire->getNom(),
                    'prenom' => $locataire->getPrenom(),
                    // Add other properties if needed
                ];
            })->toArray(),
            'nomCaution1' => $bail->getNomCaution1(),
            'nomCaution2' => $bail->getNomCaution2(),
            'paiements' => $bail->getPaiements()->map(function ($paiement) {
                return [
                    'dateP' => $paiement->getDateP()->format('Y-m-d'),
                    'montant' => $paiement->getMontant(),
                    // Add other properties if needed
                ];
            })->toArray(),
        ];

        return new JsonResponse($data);
    }


    public function ajouterBail(ManagerRegistry $doctrine,Request $request, Security $security, SluggerInterface $slugger){
        $bail = new Bail();

        $locataire = new Locataire();

        // Récupérer l'associé connecté
        $user = $security->getUser();

        if ($user) {

            $associe = $user->getAssocie();

            // Vérifier que l'associé existe
            if ($associe) {
                // Associer le bail à l'associé
                $bail->setAssocie($associe);
            } else {

            }
        }

        $bail->getLocataires()->add($locataire);

        $form = $this->createForm(BailType::class, $bail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $bail = $form->getData();

                $locatairesForms = $form->get('locataires')->all();

                foreach ($bail->getLocataires() as $index => $locataire) {
                    /** @var UploadedFile $pieceJustificativeFile */
                    $pieceJustificativeFile = $locatairesForms[$index]->get('pieceJustificative')->getData();

                    // Vérifier si un fichier a été téléchargé
                    if ($pieceJustificativeFile) {

                        // Créer un répertoire pour le locataire
                        $numeroPorteAppartement = $bail->getAppartement()->getPorte();
                        $locataireDirectory = $this->getParameter('pieces_directory') . '/' . $slugger->slug($numeroPorteAppartement . ' - ' .$locataire->getNom(). '  ' . $locataire->getPrenom());
                        if (!is_dir($locataireDirectory)) {
                            mkdir($locataireDirectory);
                        }

                        $originalFilename = pathinfo($pieceJustificativeFile->getClientOriginalName(), PATHINFO_FILENAME);
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename . '-' . uniqid() . '.' . $pieceJustificativeFile->guessExtension();

                        try {
                            $pieceJustificativeFile->move(
                                $locataireDirectory,
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // Gérer l'exception en cas d'échec du téléchargement
                        }

                        // Mettre à jour le champ pieceJustificative pour le locataire
                        $locataire->setPieceJustificative($newFilename);
                    }

                    // Assurez-vous de mettre à jour d'autres propriétés du locataire si nécessaire
                    $locataire->setArchive(0);
                }
                $bail->setArchive(0);
                $locataire->setArchive(0);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($bail);
                $entityManager->flush();

                // Création de la sous-catégorie (Categorie Loyer)
                $categorie = $entityManager->getRepository(Categorie::class)->find(1); // Remplacez 1 par l'id de la catégorie "Loyer"
                $sousCategorieLibelle = "Appartement " . $bail->getAppartement()->getPorte() . " - " . $locataire->getNom() . " " . $locataire->getPrenom();

                $sousCategorie = new SousCategorie();
                $sousCategorie->setLibelle($sousCategorieLibelle);
                $sousCategorie->setCategorie($categorie);
                $sousCategorie->setBail($bail);

                $entityManager->persist($sousCategorie);
                $entityManager->flush();

                // Création de la sous-catégorie (Categorie Caution – renommer dépôt de garantie)
                $categorie = $entityManager->getRepository(Categorie::class)->find(2); // Remplacez 2 par l'id de la catégorie "Caution"
                $sousCategorieLibelle = "Dépôt garantie " . $bail->getAppartement()->getPorte() . " - " . $locataire->getNom() . " " . $locataire->getPrenom();

                $sousCategorie = new SousCategorie();
                $sousCategorie->setLibelle($sousCategorieLibelle);
                $sousCategorie->setCategorie($categorie);
                $sousCategorie->setBail($bail);

                $entityManager->persist($sousCategorie);
                $entityManager->flush();

                // Création de la sous-catégorie (Categorie Caution – renommer dépôt de garantie)
                $categorie = $entityManager->getRepository(Categorie::class)->find(2); // Remplacez 2 par l'id de la catégorie "Caution"
                $sousCategorieLibelle = "Restitution dépôt garantie " . $bail->getAppartement()->getPorte() . " - " . $locataire->getNom() . " " . $locataire->getPrenom();

                $sousCategorie = new SousCategorie();
                $sousCategorie->setLibelle($sousCategorieLibelle);
                $sousCategorie->setCategorie($categorie);
                $sousCategorie->setBail($bail);

                $entityManager->persist($sousCategorie);
                $entityManager->flush();

            return $this->render('bail/consulter.html.twig', ['bail' => $bail,]);
        }
        else
        {
            return $this->render('bail/ajouterBail.html.twig', array('form' => $form->createView(),));
	    }
    }

    #[Route('/api/bail/ajouter', name: 'api_ajouter_bail', methods: ['POST'])]
    public function ajouterBailAPI(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): JsonResponse
    {
        $data = [];

        // Récupérer les données de la requête JSON
        $requestData = json_decode($request->getContent(), true);

        // Créer une nouvelle instance de Bail
        $bail = new Bail();

        // Assurez-vous que toutes les données requises sont présentes
        if (!isset($requestData['appartement'], $requestData['locataires'])) {
            $data['error'] = 'Données manquantes';
            return new JsonResponse($data, JsonResponse::HTTP_BAD_REQUEST);
        }

        // Manipulez les données de l'appartement comme nécessaire et associez-les au bail
        // Assurez-vous que vous avez le bon ID de l'appartement
        // $bail->setAppartement($appartement);

        // Manipulez les données des locataires et associez-les au bail
        foreach ($requestData['locataires'] as $locataireData) {
            $locataire = new Locataire();
            $locataire->setNom($locataireData['nom']);
            $locataire->setPrenom($locataireData['prenom']);
            $locataire->setDateNaissance($locataireData['dateNaissance']);
            $locataire->setLieuNaissance($locataireData['lieuNaissance']);
            $locataire->setEmail($locataireData['email']);
            $locataire->setTelephone($locataireData['telephone']);
            $locataire->setPieceJustificative($locataireData['pieceJustificative']);


            // Générez un nouveau nom de fichier pour la pièce justificative du locataire si nécessaire
            // Exemple :
            $newFilename = $slugger->slug($locataire->getNom() . '-' . $locataire->getPrenom()) . '-' . uniqid() . '.pdf';
            $locataire->setPieceJustificative($newFilename);

            // Ajoutez le locataire à la liste des locataires du bail
            $bail->addLocataire($locataire);
        }

        // Manipulez les autres données du bail
        // Exemple :
        $bail->setDateDebut(new \DateTime($requestData['dateDebut']));
        $bail->setMontantHC($requestData['montantHC']);
        $bail->setMontantCharges($requestData['montantCharges']);
        $bail->setMontantCaution($requestData['montantCaution']);
        $bail->setDureeBail($requestData['dureeBail']);
        $bail->getAppartement()->setPorte($requestData['porte']);


        // Enregistrez le bail dans la base de données
        $entityManager = $doctrine->getManager();
        $entityManager->persist($bail);
        $entityManager->flush();

        // Vous pouvez retourner l'ID du bail nouvellement ajouté si nécessaire
        $data['id'] = $bail->getId();
        $data['message'] = 'Bail ajouté avec succès!';

        return new JsonResponse($data, JsonResponse::HTTP_CREATED);
    }

    public function listerContratLocation(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails = $repository->findBy(['archive' => 0]);
        return $this->render('bail/listerContratLocation.html.twig', [
            'pBails' => $bails,]);

    }

    #[Route('/api/contrat', name: 'api_lister_contrat_location')]
    public function listerContratLocationAPI(ManagerRegistry $doctrine): JsonResponse
    {

        $repository = $doctrine->getRepository(Bail::class);
        $bails = $repository->findBy(['archive' => 0]);

        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($bails as $bail) {
            $data[] = [
                'appartement' => [
                    'porte' => $bail->getAppartement()->getPorte(),
                ],
                'locataires' => $bail->getLocataires()->map(function($locataire) {
                    return [
                        'nom' => $locataire->getNom(),
                        'prenom' => $locataire->getPrenom(),
                        // Add other properties if needed
                    ];
                })->toArray(),

                // Ajoutez d'autres propriétés au besoin
            ];
        }

        return new JsonResponse($data);

    }

    public function listerModifierContratLocation(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails = $repository->findBy(['archive' => 0]);
        return $this->render('bail/listerModifierContratLocation.html.twig', [
            'pBails' => $bails,]);

    }

    public function listerCloturerContratLocation(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails = $repository->findBy(['archive' => 0]);
        return $this->render('bail/listerCloturerContratLocation.html.twig', [
            'pBails' => $bails,]);

    }

    public function listerContratLocationArchives(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails = $repository->findBy(['archive' => 1]);
        return $this->render('bail/listerContratLocationArchives.html.twig', [
            'pBails' => $bails,]);

    }

    // Générer le contrat de location sous forme PDF pour un bail donné
    public function contratLocationPDF(ManagerRegistry $doctrine, int $id){

        $bail = $doctrine->getRepository(Bail::class)->find($id);
        $repositoryPaiement = $doctrine->getRepository(Paiement::class);
        $paiements= $repositoryPaiement->findAll();

        if (!$bail) {
            throw $this->createNotFoundException(
            'Aucun bail trouvé'
            );
        }

        // Instanciation de la librairie DOMPDF
        $dompdf = new Dompdf();

        // Contenu HTML
        $html = $this->renderView('bail/contratLocationPDF.html.twig', [
            'bail' => $bail,
        ]);

        // Chargement du contenu HTML
        $dompdf->loadHtml($html);

        // Configuration des options
        $dompdf->setPaper('A4', 'portrait');

        // Rendu du PDF
        $dompdf->render();

        // Envoi du PDF dans la réponse
        $dompdf->stream("bail_".$bail->getId().".pdf", [
            "Attachment" => false
        ]);
    }

    #[Route('/api/baux/contrat-pdf/{id}', name: 'api_pdf_contrat_location')]
    public function contratLocationPDFAPI(ManagerRegistry $doctrine, int $id) : Response
    {
        $bail = $doctrine->getRepository(Bail::class)->find($id);
        $repositoryPaiement = $doctrine->getRepository(Paiement::class);
        $paiements= $repositoryPaiement->findAll();

        if (!$bail) {
            throw $this->createNotFoundException(
            'Aucun bail trouvé'
            );
        }

        // Instanciation de la librairie DOMPDF
        $dompdf = new Dompdf();

        // Contenu HTML
        $html = $this->renderView('bail/contratLocationPDF.html.twig', [
            'bail' => $bail,
        ]);

        // Chargement du contenu HTML
        $dompdf->loadHtml($html);

        // Configuration des options
        $dompdf->setPaper('A4', 'portrait');

        // Rendu du PDF
        $dompdf->render();

        // Envoi du PDF dans la réponse
        $dompdf->stream("bail_".$bail->getId().".pdf", [
            "Attachment" => false
        ]);

        // Renvoyer le PDF en tant que réponse
        return new Response(
            $dompdf->output(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="bail_' . $bail->getId() . '.pdf"',
            ]
        );
    }

    public function genererContratOdt(ManagerRegistry $doctrine, Request $request, Security $security, SluggerInterface $slugger)
    {

        // Créer une nouvelle instance de PhpWord
        $phpWord = new PhpWord();

        // Créer une nouvelle section dans le document
        $section = $phpWord->addSection();

        // Ajouter du texte ou d'autres éléments à votre document
        $section->addText('CONTRAT DE LOCATION', ['bold' => true]);

        // Ajouter d'autres éléments et remplacer les balises avec les données réelles du contrat
        // ...

        // Chemin de sortie pour le fichier ODT généré
        $outputPath = $this->getParameter('pieces_directory') . '/contrat_location_' . uniqid() . '.odt';

        // Enregistrez le document en format ODT
        $objWriter = IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save($outputPath);

        // Vous pouvez maintenant envoyer le fichier au navigateur ou le stocker selon vos besoins
        // ...

        return $this->redirectToRoute('route_vers_document', ['filename' => 'le_nom_du_fichier_généré.odt']);
    }

    public function modifierContratLocation(ManagerRegistry $doctrine, SluggerInterface $slugger, $id, Request $request)
    {
        // récupération du bail dont l'id est passé en paramètre
        $bail = $doctrine->getRepository(Bail::class)->find($id);

        if (!$bail) {
            throw $this->createNotFoundException('Aucun bail trouvé avec le numéro ' . $id);
        } else {
            $form = $this->createForm(BailModifierType::class, $bail);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // récupération des fichiers depuis le formulaire
                $bailSigneFile = $form->get('BailSigne')->getData();
                if ($bailSigneFile) {
                    $newBailSigneFilename = $this->uploadFile($bailSigneFile, $slugger, $this->getParameter('pieces_directory'), $bail->getLocataires(), $bail);
                    $bail->setBailSigne($newBailSigneFilename);
                }
                $attestationAssuranceFile = $form->get('AttestationAssurance')->getData();
                $etatLieuEntreeSigneFile = $form->get('EtatLieuEntreeSigne')->getData();
                $etatLieuSortieSigneFile = $form->get('EtatLieuSortieSigne')->getData();

                // traitement des fichiers s'ils ont été uploadés
                if ($bailSigneFile) {
                    $newBailSigneFilename = $this->uploadFile($bailSigneFile, $slugger, 'pieces_directory', $bail->getLocataires(), $bail);
                    $bail->setBailSigne($newBailSigneFilename);
                }

                if ($attestationAssuranceFile) {
                    $newAttestationAssuranceFilename = $this->uploadFile($attestationAssuranceFile, $slugger, 'pieces_directory', $bail->getLocataires(), $bail);
                    $bail->setAttestationAssurance($newAttestationAssuranceFilename);
                }

                if ($etatLieuEntreeSigneFile) {
                    $newEtatLieuEntreeSigneFilename = $this->uploadFile($etatLieuEntreeSigneFile, $slugger, 'pieces_directory', $bail->getLocataires(), $bail);
                    $bail->setEtatLieuEntreeSigne($newEtatLieuEntreeSigneFilename);
                }

                if ($etatLieuSortieSigneFile) {
                    $newEtatLieuSortieSigneFilename = $this->uploadFile($etatLieuSortieSigneFile, $slugger, 'pieces_directory', $bail->getLocataires(), $bail);
                    $bail->setEtatLieuSortieSigne($newEtatLieuSortieSigneFilename);
                }

                // persiste les changements dans la base de données
                $entityManager = $doctrine->getManager();
                $entityManager->persist($bail);
                $entityManager->flush();

                // redirige vers la page de consultation du bail
                return $this->render('bail/formModifierContratLocation.html.twig', ['form' => $form->createView()]);
            } else {
                // affiche le formulaire de modification s'il y a des erreurs
                return $this->render('bail/formModifierContratLocation.html.twig', ['form' => $form->createView()]);
            }
        }
    }

    private function uploadFile(UploadedFile $file, SluggerInterface $slugger, $directory, $locataire, $bail)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        $directory = $this->getParameter('kernel.project_dir') . '/ressources';
        foreach ($bail->getLocataires() as $locataire) {
        // Adjust the directory based on tenant information
        $numeroPorteAppartement = $bail->getAppartement()->getPorte();
        $locataireDirectory = $directory . '/' . $slugger->slug($numeroPorteAppartement . ' - ' . $locataire->getNom() . '  ' . $locataire->getPrenom());

        try {
            $file->move($locataireDirectory, $newFilename);
        } catch (FileException $e) {
            // Handle the exception if the file cannot be moved
            throw new \Exception('Error uploading the file');
        }}

        // Perform any additional logic here, e.g., update database fields or associations

        return $newFilename;
    }


    public function cloturerContratLocation(ManagerRegistry $doctrine, $id, Request $request){
 
        $bail = $doctrine->getRepository(Bail::class)->find($id);
        $bail->setMontantDerEcheance($bail->getMontantHC() + $bail->getMontantCharges());

        if (!$bail) {
            throw $this->createNotFoundException('Aucun bail trouvé avec le numéro '.$id);
        }

                // Récupérer les locataires liés au bail
                $locataires = $bail->getLocataires();
                $form = $this->createForm(BailCloturerType::class, $bail);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                    // Effectuer les opérations nécessaires lors de la clôture du bail

                    // Supprimer les sous-catégories liées au bail
                    $this->supprimerSousCategories($doctrine, $bail);

                    // Mettre en archive le bail et les locataires
                    $bail->setArchive(1);
                    foreach ($locataires as $locataire) {
                        $locataire->setArchive(1);
                    }

                     $entityManager = $doctrine->getManager();
                     $entityManager->persist($bail);
                     $entityManager->flush();
                     return $this->render('bail/accueil.html.twig', ['bail' => $bail,]);
                }
               else{
                $locataires = $bail->getLocataires();

                return $this->render('bail/cloturerContratLocation.html.twig', [
                    'form' => $form->createView(),
                    'bail' => $bail,
                ]);
                }
    }

    private function supprimerSousCategories(ManagerRegistry $doctrine, Bail $bail)
    {
        $entityManager = $doctrine->getManager();
        $sousCategories = $entityManager->getRepository(SousCategorie::class)->findBy(['bail' => $bail]);

        foreach ($sousCategories as $sousCategorie) {
            $entityManager->remove($sousCategorie);
        }

        $entityManager->flush();
    }
}