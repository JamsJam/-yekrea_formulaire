<?php

namespace App\Controller;

use App\Entity\Command;
use App\Form\CommandType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ClientRepository;
use App\Repository\CommandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/command")
 */
class CommandController extends AbstractController
{
    /**
     * @Route("/", name="app_command_index", methods={"GET"})
     */
    public function index(CommandRepository $commandRepository): Response
    {
        // dd($this->getUser());
        $userRoles = $this->getUser()->getRoles();
        // $validation = $command->getValidateDate();
        if (in_array("ROLE_ADMIN", $userRoles)){
            // Si Admin, alors j'affiche toutes les commandes
            $command = $commandRepository->findBy(["validationDate" => null],["id" => "DESC"]);
        }elseif (in_array("ROLE_COMMERCIAL", $userRoles)) {
            //Si Commercial, j'affiche seulement les commandes le concernant null
            $userId = $this->getUser(); // getId() affiche methode undefini mais fonctionne
            // dd($userId);
            $command = $commandRepository->findBy(['user'=> $userId, "validationDate" => null],["id" => "DESC"]);
        }
        // $command->setUser($user->getId());
        return $this->render('command/index.html.twig', [
            'commands' => $command,
        ]);
    }
    
    /**
     * @Route("/historique", name="app_command_historique", methods={"GET"})
     */
    public function historique(CommandRepository $commandRepository): Response
    {
        $userRoles = $this->getUser()->getRoles();
        
        // $validation = $command->getValidateDate();
        if (in_array("ROLE_ADMIN", $userRoles)){
            // Si Admin, alors j'affiche toutes les commandes
            $command = $commandRepository->findBy([],["validationDate" => "DESC"]);
        }elseif (in_array("ROLE_COMMERCIAL", $userRoles)) {
            //Si Commercial, j'affiche seulement les commandes le concernant
            $userId = $this->getUser(); // getId() affiche methode undefini mais fonctionne
            $command = $commandRepository->findBy(['user'=> $userId],["validationDate" => "DESC"]);
        }
        // $command->setUser($user->getId());
        return $this->render('command/historique.html.twig', [
            'commands' => $command,
        ]);
    }
    
    /**
     * @Route("/new", name="app_command_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CommandRepository $commandRepository, ClientRepository $clientRepository): Response
    {

        // Permet d'envoyer un mail. la classe Mail est definis par App/Service/Mail
        // send() prend 4 argument!
            // $email = new Mail();
            // $email->send(
                        //     'mail_destinateur',
                        //     '$nom_destinateur',
                        //     '$objet',
                        //     '$message'
                        // );

        $command = new Command();
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);
        $command->setIsValidated(false);
        $numeroCommande = time()-100000;
        $command->setNbCommande($numeroCommande);
        //je set le champ User avec l'user actuellement connecté
        $command->setUser($this->getUser());

        //si requette get client...
        if($request->query->get('client') ){
            //...je recupere le client associer a l'user..
            $clientId = $clientRepository-> findOneBy(['id'=>$request->query->get('client')]);
            $command->setClient($clientId);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            


            $command->setCreateDate(new \DateTimeImmutable("now"));
            

            $commandRepository->add($command, true);

            // dd($command);

            $this->addFlash("success", 'Une nouvelle commande a été ajoutée par '.$command->getUser()->getNom() .'.'); 

            return $this->redirectToRoute('app_command_index', [], Response::HTTP_SEE_OTHER);
            
            

        }

        return $this->renderForm('command/new.html.twig', [
            'command' => $command,
            'form' => $form,
            
        ]);
    }

    /**
     * @Route("/{id}", name="app_command_show", methods={"GET"})
     */
    public function show(Command $command): Response
    {
        
        return $this->render('command/show.html.twig', [
            'command' => $command,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_command_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Command $command, CommandRepository $commandRepository): Response
    {
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $commandRepository->add($command, true);

            return $this->redirectToRoute('app_command_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('command/edit.html.twig', [
            'command' => $command,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_command_delete", methods={"POST"})
     */
    public function delete(Request $request, Command $command, CommandRepository $commandRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$command->getId(), $request->request->get('_token'))) {
            $commandRepository->remove($command, true);
        }

        return $this->redirectToRoute('app_command_index', [], Response::HTTP_SEE_OTHER);
    }

        /**
     * @Route("/api/fetch/client", name="app_json_command_client")
     */
    public function ClientJson(SerializerInterface $serializer, ClientRepository $clientRipo): JsonResponse
    {
        
        $client = $clientRipo->findClient('p');
        
        
        
        $jsonContent = $serializer
                                ->serialize(
                                        $client,
                                        'json'
                                            );
        

        return new JsonResponse($jsonContent, JsonResponse::HTTP_OK, [], true) ;        
    }
}
