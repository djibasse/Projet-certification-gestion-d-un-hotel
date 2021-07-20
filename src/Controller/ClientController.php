<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    
    #[Route('/client' ,name: 'client')]

    public function index(ClientRepository $clientRepository): Response
    {
        $liste = $clientRepository->findAll();
        return $this->render('client/index.html.twig', [
            'liste' => $liste,
        ]);
    }
    #[Route('/', name: 'accueil')]

    public function accueil(): Response
    {
        return $this->render('client/accueil.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }


    #[Route('/client/create', name: 'creation_client')]
    public function create( Request $request): Response{
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);

       $form->handleRequest($request);

       if($form->isSubmitted()&&$form->isValid()){

           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($client);
           $entityManager-> flush();

           Return $this->redirectToRoute('client');
       }

       return $this->render ("client/create.html.twig",[
           'formulaire'=> $form->createView()
           ]);
  }

  
  #[Route('/client/update/{id}', name: 'client_update')]
  
  public function update(Request $request , $id) 
  {

     $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
     
     $form = $this->createForm(ClientType::class, $client);
  
     $form->handleRequest($request);
     if($form->isSubmitted() && $form->isValid()){
  
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($client);
         $entityManager->flush();
  
         return  $this->redirectToRoute('client');
     }
     
     
     return $this->render ("client/update.html.twig",[
         'formulaire'=> $form->createView()
         ]);
  
     }
     #[Route('/{id}', name: 'client_delete')]
  
     public function delete($id)
     {
         $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->remove($client);
         $entityManager->flush();
  
         return  $this->redirectToRoute('client');
     }   
  



}