<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Locataire;
use App\Form\LocataireType;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class LocataireController extends AbstractController
{
    #[Route('/locataire', name: 'app_locataire')]
    public function index(): Response
    {
        return $this->render('locataire/index.html.twig', [
            'controller_name' => 'LocataireController',
        ]);
    }

    public function ajouterLocataire(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger){
        $locataire = new Locataire();
        $form = $this->createForm(LocataireType::class, $locataire);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $pieceJustificativeFile */
            $pieceJustificativeFile = $form->get('pieceJustificative')->getData();
    
            // this condition is needed because the 'pieceJustificative' field is not required
            // so the file must be processed only when a file is uploaded
            if ($pieceJustificativeFile) {
                $originalFilename = pathinfo($pieceJustificativeFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pieceJustificativeFile->guessExtension();
    
                // Move the file to the directory where pieces are stored
                try {
                    $pieceJustificativeFile->move(
                        $this->getParameter('pieces_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
    
                // updates the 'pieceJustificative' property to store the file name
                // instead of its contents
                $locataire->setPieceJustificative($newFilename);
            }
    
            // persist the $locataire variable or any other work
            $locataire->setArchive(0);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($locataire);
            $entityManager->flush();
    
            return $this->render('locataire/consulter.html.twig', ['locataire' => $locataire]);
        } else {
            return $this->render('locataire/ajouter.html.twig', ['form' => $form->createView()]);
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
