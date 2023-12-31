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

        $bails = $repository->findBy(['archive' => 0]);
        return $this->render('bail/lister.html.twig', [
            'pBails' => $bails,]);

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

    public function ajouterBail(ManagerRegistry $doctrine,Request $request){
        $bail = new Bail();

        $locataire = new Locataire();
        $bail->getLocataires()->add($locataire);

        $form = $this->createForm(BailType::class, $bail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $bail = $form->getData();
                $bail->setArchive(0);
                $locataire->setArchive(0);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($bail);
                $entityManager->flush();

            return $this->render('bail/consulter.html.twig', ['bail' => $bail,]);
        }
        else
        {
            return $this->render('bail/ajouterBail.html.twig', array('form' => $form->createView(),));
	    }
    }

    public function listerContratLocation(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Bail::class);

        $bails = $repository->findBy(['archive' => 0]);
        return $this->render('bail/listerContratLocation.html.twig', [
            'pBails' => $bails,]);

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

    public function modifierContratLocation(ManagerRegistry $doctrine, $id, Request $request){
 
        //récupération de l'étudiant dont l'id est passé en paramètre
        $bail = $doctrine->getRepository(Bail::class)->find($id);

        if (!$bail) {
            throw $this->createNotFoundException('Aucun bail trouvé avec le numéro '.$id);
        }
        else
        {
                $form = $this->createForm(BailModifierType::class, $bail);
                $form->handleRequest($request);
     
                if ($form->isSubmitted() && $form->isValid()) {
     
                     $bail = $form->getData();
                     $entityManager = $doctrine->getManager();
                     $entityManager->persist($bail);
                     $entityManager->flush();
                     return $this->render('bail/consulter.html.twig', ['bail' => $bail,]);
               }
               else{
                    return $this->render('bail/formModifierContratLocation.html.twig', array('form' => $form->createView(),));
               }
        }
    }

    public function cloturerContratLocation(ManagerRegistry $doctrine, $id, Request $request){
 
        $bail = $doctrine->getRepository(Bail::class)->find($id);
        $bail->setMontantDerEcheance($bail->getMontantHC() + $bail->getMontantCharges());

        if (!$bail) {
            throw $this->createNotFoundException('Aucun bail trouvé avec le numéro '.$id);
        }
        else
        {
                $form = $this->createForm(BailCloturerType::class, $bail);


                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                     $bail = $form->getData();
                     $bail->setArchive(1);
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
    }
}
