<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategorieType;
use App\Entity\Categorie;
use App\Form\CategorieModifierType;
use App\Form\SousCategorieType;
use App\Entity\SousCategorie;
use App\Form\SousCategorieModifierType;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    public function ajouterCategorie(ManagerRegistry $doctrine,Request $request){
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $categorie = $form->getData();

                $entityManager = $doctrine->getManager();
                $entityManager->persist($categorie);
                $entityManager->flush();

            return $this->render('admin/categorie/listerCategorie.html.twig', ['categorie' => $categorie,]);
        }
        else
        {
            return $this->render('admin/categorie/ajouterCategorie.html.twig', array('form' => $form->createView(),));
	    }
    }

    public function listerCategorie(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Categorie::class);

        $categorie= $repository->findAll();
        return $this->render('admin/categorie/listerCategorie.html.twig', [
            'categorie' => $categorie,]);

    }

    #[Route('/api/categories', name: 'api_categories')]
    public function listerCategoriesAPI(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getRepository(Categorie::class);
        $categories = $repository->findAll();

        // Convertir les données en format JSON et les renvoyer
        $data = [];
        foreach ($categories as $categorie) {
            $data[] = [
                'id' => $categorie->getId(),
                'nom' => $categorie->getNom(),
                // Ajoutez d'autres propriétés au besoin
            ];
        }

        return new JsonResponse($data);
    }

    public function modifierCategorie(ManagerRegistry $doctrine, $id, Request $request){

        $categorie = $doctrine->getRepository(Categorie::class)->find($id);

        if (!$categorie) {
            throw $this->createNotFoundException('Aucun categorie trouvé avec le numéro '.$id);
        }
        else
        {
                $form = $this->createForm(CategorieModifierType::class, $categorie);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                     $categorie = $form->getData();
                     $entityManager = $doctrine->getManager();
                     $entityManager->persist($categorie);
                     $entityManager->flush();
                     return $this->render('admin/categorie/listerCategorie.html.twig', ['categorie' => $categorie,]);
               }
               else{
                    return $this->render('admin/categorie/modifierCategorie.html.twig', array('form' => $form->createView(),));
               }
        }
    }

    public function ajouterSousCategorie(ManagerRegistry $doctrine,Request $request){
        $SousCategorie = new SousCategorie();

        $form = $this->createForm(SousCategorieType::class, $SousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $SousCategorie = $form->getData();

                $entityManager = $doctrine->getManager();
                $entityManager->persist($SousCategorie);
                $entityManager->flush();

            return $this->render('admin/sous_categorie/listerSousCategorie.html.twig', ['SousCategorie' => $SousCategorie,]);
        }
        else
        {
            return $this->render('admin/sous_categorie/ajouterSousCategorie.html.twig', array('form' => $form->createView(),));
	    }
    }

    public function listerSousCategorie(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(SousCategorie::class);

        $SousCategorie= $repository->findAll();
        return $this->render('admin/sous_categorie/listerSousCategorie.html.twig', [
            'SousCategorie' => $SousCategorie,]);

    }

    public function modifierSousCategorie(ManagerRegistry $doctrine, $id, Request $request){

        $SousCategorie = $doctrine->getRepository(SousCategorie::class)->find($id);

        if (!$SousCategorie) {
            throw $this->createNotFoundException('Aucun SousCategorie trouvé avec le numéro '.$id);
        }
        else
        {
                $form = $this->createForm(SousCategorieModifierType::class, $SousCategorie);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                     $SousCategorie = $form->getData();
                     $entityManager = $doctrine->getManager();
                     $entityManager->persist($SousCategorie);
                     $entityManager->flush();
                     return $this->render('admin/sous_categorie/listerSousCategorie.html.twig', ['SousCategorie' => $SousCategorie,]);
               }
               else{
                    return $this->render('admin/sous_categorie/modifierSousCategorie.html.twig', array('form' => $form->createView(),));
               }
        }
    }
}
