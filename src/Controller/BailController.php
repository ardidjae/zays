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
use App\Form\BailType;
use App\Entity\Locataire;

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

        // Instanciation de la librairie DOMPDF
        $dompdf = new Dompdf();

        // Contenu HTML
        $html = $this->renderView('bail/quittancePDF.html.twig', [
            'bail' => $bail,
            'pPaiements' => $paiements,
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

    public function consulterBaux(ManagerRegistry $doctrine, int $id){

        $bail = $doctrine->getRepository(Bail::class)->find($id);

        if (!$bail) {
            throw $this->createNotFoundException(
            'Aucun bail trouvé'
            );
        }

        return $this->render('bail/consulter.html.twig', [
            'bail' => $bail,
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

        $bails= $repository->findAll();
        return $this->render('bail/listerContratLocation.html.twig', [
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
}
