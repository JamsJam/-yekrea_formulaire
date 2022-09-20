<?php

namespace App\Controller;

use App\Repository\CommandRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Command;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(CommandRepository $commandRepository, UserRepository $userRepository): Response
    {
        // ***********************************Recuperation du premier vendeur
        $users = $userRepository->findAll();
        $resultat = [];
        foreach ($users as $user) {
            if($user->getRoles() != ['ROLE_USER']){

                $id = $user->getId();
                $nombreDeCommande = count ($commandRepository->findBy(['user'=> $id])) ;
                $table = [$user->getNom().' '.$user->getPrenom(), $id, $nombreDeCommande ];
                array_push($resultat, $table);
            }
        }
        $columnVente = array_column($resultat, 2);
        array_multisort($columnVente, SORT_DESC, $resultat);

        // ****************************************recuperation du vendeur le plus rentable
        $commandes =  $commandRepository->findall();
        $prixCommande = [];
        foreach ($commandes as $commande) {
            if($commande->getDevis() !== null){

                if($commande->getDevis()->getPrixFinal() !== null ){
                    $prixFinal = $commande->getDevis()->getPrixFinal();
                    $table2 = [$commande->getUser()->getNom().' '.$commande->getUser()->getPrenom(), $prixFinal];
                    array_push($prixCommande,$table2);
                }  
            }
        }
        dd($prixCommande);




        return $this->render('dashboard/index.html.twig', [
            
            'lastCommandes' =>  $commandRepository->findby([],['id'=> 'DESC'], 4),
            'premierVender' => $resultat[0],
        ]);
    }
}
