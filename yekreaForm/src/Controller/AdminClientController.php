<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/client")
 */
class AdminClientController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('admin_client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_client_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ClientRepository $clientRepository, UserRepository $userRepository): Response
    {
        // Je cree mon nouvel objet client
        $client = new Client();
        //creation du formulaire
        $form = $this->createForm(ClientType::class, $client);
        //Methode POST
        $form->handleRequest($request);

        // Recuperation de l'ID de mon user via l'URL  et recuperation en BDD de du User 
        $userID = $userRepository->findOneBy(['id'=>$request->query->get('Id')]);
        
        
        
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            //Assignation du champ User avec l'objet UserID
            $client->setUser($userID) ;
            //Envoie en BDD de client
            $clientRepository->add($client, true);
            //Recuperation de l'ID du client
            $clientId = $client->getId();

            // Redirection vers commande/new avec l'id du client dans l'URL
            return $this->redirectToRoute('app_command_new', [
                'client' => $clientId,
                
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_client_show", methods={"GET"})
     */
    public function show(Client $client): Response
    {
        return $this->render('admin_client/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_client_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Client $client, ClientRepository $clientRepository): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->add($client, true);

            return $this->redirectToRoute('app_admin_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_client_delete", methods={"POST"})
     */
    public function delete(Request $request, Client $client, ClientRepository $clientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $clientRepository->remove($client, true);
        }

        return $this->redirectToRoute('app_admin_client_index', [], Response::HTTP_SEE_OTHER);
    }


}
