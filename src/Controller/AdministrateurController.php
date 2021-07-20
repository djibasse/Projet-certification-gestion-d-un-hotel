<?php

namespace App\Controller;

use App\Entity\Administrateur;
use App\Form\AdministrateurType;
use App\Repository\AdministrateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdministrateurController extends AbstractController
{
    #[Route('/administrateur', name: 'administrateur')]
    public function index(AdministrateurRepository $administrateurRepository): Response
    {
        $liste = $administrateurRepository-> findAll();
        return $this->render('administrateur/index.html.twig', [
            'controller_name' => 'AdministrateurController',
            'liste' => $liste
        ]);
    }
    
       
    
    #[Route("/administrateur/create" , name : "creation_administrateur")]
    
     
     public function create( Request $request): Response{
         $administrateur = new Administrateur();
    
         $form = $this->createForm(AdministrateurType::class, $administrateur);
    
        $form->handleRequest($request);
    
        if($form->isSubmitted()&&$form->isValid()){
         
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($administrateur);
            $entityManager-> flush();
    
            Return $this->redirectToRoute('accueil');
        }
    
        return $this->render ("administrateur/create.html.twig",[
            'formAdministrateur'=> $form->createView()
            ]);
     }
    
    }
    