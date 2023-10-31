<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;



class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', []);
    }
    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('base/apropos.html.twig', []);
    }
    #[Route('/mentionslegales', name: 'app_mentionslegales')]
    public function mentionslegales(): Response
    {
        return $this->render('base/mentionslegales.html.twig', []);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($contact);
                $em->flush();
                $this->addFlash('notice', 'Message envoyé');
                return $this->redirectToRoute('app_contact');
            }
        }
        return $this->render('base/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
   
    #[Route('/categorie', name: 'app_categorie')]
    public function categorie(Request $request, EntityManagerInterface $em): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($categorie);
                $em->flush();
                $this->addFlash('notice', 'Message envoyé');
                return $this->redirectToRoute('app_categorie');
            }
        }
        return $this->render('base/categorie.html.twig', [
            'form' => $form->createView()
        ]);
    }
   
    #[Route('/liste-categorie', name: 'app_liste-categories')]
    public function listeCategorie(CategorieRepository $categorieRepository): Response
    {
       
        $categories = $categorieRepository->findAll();
        return $this->render('base/liste-categories.html.twig', [
           'categories' => $categories
        ]);
    
    }
       
    #[Route('/modif-categorie/{id}', name: 'app_modif-categorie')]
    public function modifCategorie(Categorie $categorie, Request $request, EntityManagerInterface $em): Response
        {
            $form = $this->createForm(CategorieType::class, $categorie);
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
    
                if ($form->isSubmitted() && $form->isValid()) {
                    $em->persist($categorie);
                    $em->flush();
                    $this->addFlash('notice', 'Message modifié');
                    return $this->redirectToRoute('app_liste-categories');
                }
            }
            
            return $this->render('base/modif-categories.html.twig', [
                'form' => $form->createView()
            ]);
  }
   

  #[Route('/del-categorie/{id}', name: 'app_del-categorie')]
    public function delCategorie(Categorie $categorie, EntityManagerInterface $em): Response
        {
         
    
               
                    $em->remove($categorie);
                    $em->flush();
                    $this->addFlash('notice', 'Categorie supp');
                    return $this->redirectToRoute('app_liste-categories');
                }
           
  
  
  
  
  /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('base/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    
}
