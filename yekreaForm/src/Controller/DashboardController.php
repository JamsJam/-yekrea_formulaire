<?php

namespace App\Controller;

use App\Repository\CommandRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Command;
use App\Repository\DevisRepository;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(CommandRepository $commandRepository, DevisRepository $devisRepository, UserRepository $userRepository): Response
    {
        
        // ***********************************Recuperation des 4 dernieres commandes

        $lastCommandes = $commandRepository->findby([],['id'=> 'DESC'], 4);



        // *********************************** Recuperation du premier vendeur

        $users = $userRepository->findAll();
        $resultat = [];
        $resultat1 = [];
        foreach ($users as $user) {
            if($user->getRoleInt() != 3 ){

                $id = $user->getId();
                $nombreDeCommande = count ($commandRepository->findBy(['user'=> $id])) ;
                $table = [$user->getNom().' '.$user->getPrenom(), $id, $nombreDeCommande ];
                array_push($resultat, $table);

                // *********************************** Recuperation du vendeur le plus rentable


                $nombreDeCommandeValide = ( $commandRepository->findBy(['user'=> $id, 'isValidated'=> true])) ;
                // if($commande->isValidated() == true)
                if($nombreDeCommande){
                    $prix = 0;
                    foreach( $nombreDeCommandeValide as $commande){
                        if($commande->getDevis()){

                            if($commande->getDevis()->getStatus() == "accepted"){
                                $prix += $commande->getDevis()->getPrixFinal();
                                $table1 = [$user->getNom().' '.$user->getPrenom() , $prix ];
                                array_push($resultat1, $table1);
                            }
                        }
                    }
                    
                }
                
                
            }
        }
        
        $columnVente = array_column($resultat, 2);
        array_multisort($columnVente, SORT_DESC, $resultat);
        
        $columnPrix = array_column($resultat1, 1);
        array_multisort($columnPrix, SORT_DESC, $resultat1);
        
        




        return $this->render('dashboard/index.html.twig', [
            // ****************************************recuperation du vendeur le plus rentable
            "devisAccepted"     =>  count($devisRepository->findby(['status' => 'accepted'])),
            "devisAborted"      => count($devisRepository->findby(['status' => 'aborted'])),
            "devisPending"      => count($devisRepository->findby(['status' => 'pending'])),
            'lastCommandes'     =>  $lastCommandes,
            'premierVender'     => $resultat[0],
            'vendeurRentable'   => $resultat1[0],
        ]);
    }
}
