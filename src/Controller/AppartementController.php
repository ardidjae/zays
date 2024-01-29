<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Appartement;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Form\AppartementType;
use Symfony\Component\Finder\Finder;


class AppartementController extends AbstractController
{
    #[Route('/appartement', name: 'app_appartement')]
    public function index(): Response
    {
        return $this->render('appartement/index.html.twig', [
            'controller_name' => 'AppartementController',
        ]);
    }

    public function consulterAppartement(ManagerRegistry $doctrine, int $id, SluggerInterface $slugger){

        $appartement = $doctrine->getRepository(Appartement::class)->find($id);

        if (!$appartement) {
            throw $this->createNotFoundException(
            'Aucun appartement trouvé'
            );
        }

        // Récupérer le répertoire de l'appartement
        $numeroPorteAppartement = $appartement->getPorte();
        $appartementDirectory = $this->getParameter('appartement_directory') . '/' . $slugger->slug($numeroPorteAppartement);

        // Utiliser Finder pour récupérer la liste des fichiers dans le répertoire
        $finder = new Finder();
        $files = $finder->files()->in($appartementDirectory);

        return $this->render('appartement/consulter.html.twig', [
            'appartement' => $appartement,
            'files' => $files,
        ]);
    }

    public function listerAppartement(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Appartement::class);

        $appartements= $repository->findAll();
        return $this->render('appartement/lister.html.twig', [
            'pAppartements' => $appartements,]);

    }

    public function consulterAppart(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger, int $id)
    {
        $appartement = $doctrine->getRepository(Appartement::class)->find($id);

        if (!$appartement) {
            throw $this->createNotFoundException('Aucun appartement trouvé');
        }

        $form = $this->createForm(AppartementType::class, $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            // this condition is needed because the 'image' field is not required
            // so the file must be processed only when a file is uploaded
            if ($imageFile) {
                // Créer un répertoire pour le locataire
                $numeroPorteAppartement = $appartement->getPorte();
                $appartementDirectory = $this->getParameter('appartement_directory') . '/' . $slugger->slug($numeroPorteAppartement);
                if (!is_dir($appartementDirectory)) {
                    mkdir($appartementDirectory);
                }

                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                // Move the file to the directory where pieces are stored within the apartment directory
                try {
                    $imageFile->move(
                        $appartementDirectory,
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'image' property to store the file name
                // instead of its contents
                $appartement->setimage($newFilename);
            }

            // Save the updated appartement entity
            $entityManager = $doctrine->getManager();
            $entityManager->persist($appartement);
            $entityManager->flush();
        }

         // Récupérer le répertoire de l'appartement
         $numeroPorteAppartement = $appartement->getPorte();
         $appartementDirectory = $this->getParameter('appartement_directory') . '/' . $slugger->slug($numeroPorteAppartement);

         // Utiliser Finder pour récupérer la liste des fichiers dans le répertoire
         $finder = new Finder();
         $files = $finder->files()->in($appartementDirectory);

        return $this->render('appartement/consulterAppart.html.twig', [
            'form' => $form->createView(),
            'appartement' => $appartement,
            'files' => $files,
        ]);
    }
}
