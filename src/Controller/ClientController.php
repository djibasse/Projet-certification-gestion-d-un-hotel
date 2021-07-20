<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'client')]
    public function index(ClientRepository $clientRepository): Response
    {
        $liste = $clientRepository-> findAll();
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'liste' => $liste
        ]);
    }
    
       
    
    #[Route("/client/create" , name : "creation_client")]
    
     
     public function create( Request $request): Response{
         $client = new Client();
    
         $form = $this->createForm(ClientType::class, $client);
    
        $form->handleRequest($request);
    
        if($form->isSubmitted()&&$form->isValid()){
         
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager-> flush();
    
            Return $this->redirectToRoute('accueil');
        }
    
        return $this->render ("client/create.html.twig",[
            'formClient'=> $form->createView()
            ]);
     }
    
    }