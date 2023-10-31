<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
class ContactController extends AbstractController
{
   #[Route('/private-liste-contacts', name: 'app_liste-contacts')]
   public function listeContacts(EntityManagerInterface $entityManagerInterface): Response
   {
       $repoContact = $entityManagerInterface->getRepository(Contact::class);
       $contacts = $repoContact->findAll();
       return $this->render('base/liste-contacts.html.twig', [
          'contacts' => $contacts
       ]);
   
 
 }
}

