<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function listeContacts(EntityManagerInterface $entityManagerInterface): Response
    {
        $repoContact = $entityManagerInterface->getRepository(User::class);
        $users = $repoContact->findAll();
        return $this->render('utilisateur/index.html.twig', [
           'users' => $users
        ]);
    
  
  }

  #[Route('/private_profil', name: 'app_profil')]
  public function profil(): Response
  {
      
      return $this->render('utilisateur/profil.html.twig', [
        
      ]);
  

}
 }