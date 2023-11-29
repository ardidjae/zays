<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Bail;
use App\Entity\Paiement;
use Dompdf\Dompdf;

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
}
