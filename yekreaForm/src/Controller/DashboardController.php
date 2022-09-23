<?php

namespace App\Controller;

use App\Entity\Command;
use App\Entity\ServicesDetail;
use App\Repository\UserRepository;
use App\Repository\DevisRepository;
use App\Repository\CommandRepository;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ServicesDetailRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(CommandRepository $commandRepository, ServicesRepository $serviceRepository, DevisRepository $devisRepository, UserRepository $userRepository, ServicesDetailRepository $servicesDetailRepository): Response
    {
        //initialisation des tableaux
        $resultatMeilleurVendeur = [];
        $resultatVendeurRentable = [];
        $arrayServices =[];
        $resultatCountService =[];
        $tableCountService =[];

        //recuperation des Donnée necessaires
        $AllService = $serviceRepository->findAll();
        $commandeValidee = $commandRepository->findBy(['isValidated' => true]); 
        $users = $userRepository->findAll();

        // ***********************************Recuperation des 4 dernieres commandes

        $lastCommandes = $commandRepository->findby([],['id'=> 'DESC'], 4);


        //pour chaque User...
        foreach ($users as $user) 
        {
            // *********************************** Recuperation du premier vendeur

            // recuperation de l'id du user
            $id = $user->getId();
            // Recuperation de toute les commandes passé par ce user qui ont ete validées
            $userCommandeValide = $commandRepository->findBy(['user'=> $id, 'isValidated'=> true]) ;
            // Si l'utilisatueur n'est pas un client :
            if($user->getRoleInt() != 3){
                // decompte du nombre de commande de ce user qui ont ete validées
                $nombreDeCommande = count ($userCommandeValide) ;
                // stockage dans un tableau [nom prenom, Id, nombre de commandes]
                $arrayMeilleurVendeur = [$user->getNom().' '.$user->getPrenom(), $id, $nombreDeCommande ];
                // Envoi du tableau precedent dans un tableau globale regroupant tous les vendeurs et leurs nombres de commandes.
                array_push($resultatMeilleurVendeur, $arrayMeilleurVendeur);


                // *********************************** Recuperation du vendeur le plus rentable
                
                // Si pour chaque user le nombre de commande existe...
                if($nombreDeCommande)
                {
                    //initialisation
                    $sommePrixFinal = 0;
                    // alor pour chaque commandes
                    foreach( $userCommandeValide as $commande)
                    {
                        //si un devis pour cette commande existe (securité car validation de la commande deja verifié  )
                        if($commande->getDevis())
                        {
                            //Si la commande en question a été accepter par le client
                            if($commande->getDevis()->getStatus() == "accepted")
                            {
                                // stockage et somme du prix final de chaque commande en provenance de ce user
                                $sommePrixFinal += $commande->getDevis()->getPrixFinal();
                                // stockage du resultat dans un tableau [nom prenom, somme Prixfinal]
                                $arrayVendeurRentable = [$user->getNom().' '.$user->getPrenom() , $sommePrixFinal ];
                                // Envoi du tableau precedent dans un tableau globale regroupant tous les vendeurs et leurs apports.
                                array_push($resultatVendeurRentable, $arrayVendeurRentable);
                            }
                        }
                    }
                    
                }
            }
        }
        // Trie dans le tableau "$resultatMeilleurVendeur" pour obtenir un classement des vendeur nombre de commande passée
        $columnVente = array_column($resultatMeilleurVendeur, 2);
        array_multisort($columnVente, SORT_DESC, $resultatMeilleurVendeur);
        
        // Trie dans le tableau "$resultatVendeurRentable" pour obtenir un classement des vendeur par rentabilité
        $columnPrix = array_column($resultatVendeurRentable, 1);
        array_multisort($columnPrix, SORT_DESC, $resultatVendeurRentable);
        


        // ******************************************************** Recuperation de la categorie la plus populaire

        // pour chaque commande qui a été validé ( si un devis existe)
        foreach ($commandeValidee as $commande) 
        {   
            // si le client  à accepté le devis rataché a cette commande...
            if($commande->getDevis()->getStatus() == 'accepted')
            {
                //et pour chaque serviceDetails dans cette commandes...
                foreach ($commande->getServicesDetail() as  $sd) //$sd = serviceDetail
                {
                    //je recupere la categorie de service detail...
                    $nomService = $sd->getServices()->getNom();
                    //je le stock dans un tableau [categorie, info commande]
                    $arrayServiceCommande = [$nomService, $commande, $commande->getId()];
                    // alors j'envois les information de ma commande dans le tabbleau "$arrayServices"
                    array_push($arrayServices, $arrayServiceCommande);
                }
            }
        }
        //Pour chaque service
        foreach ($AllService as $service) 
        {
            // initialisation du compteur
            $UtilisationService = 0;
            //Pour chaque element du tableau "$arrayServices",
            for ($i=0 ; $i < sizeof($arrayServices); $i++ ) 
            { 
                //decompte du nombre de fois que revient chaque service dans "$arrayServices"
                if($arrayServices[$i][0] == $service->getNom())
                {
                    $UtilisationService++  ;
                }
            }
            //stockage du resultat dans un tableau [service , info commande]
            $tableCountService = [$service->getNom(), $UtilisationService];
            //alors j'envois les information de ma commande dans le tabbleau "$resultatCountService"
            array_push($resultatCountService, $tableCountService);
        }
        // Trie dans le tableau "$resultatVendeurRentable" pour obtenir un classement des categories par popularité
        $columCountService= array_column($resultatCountService, 1);
        array_multisort($columCountService, SORT_DESC, $resultatCountService);
        







        return $this->render('dashboard/index.html.twig', [

            'lastCommandes'     =>  $lastCommandes,
            // ***************************************** Chiffre general (nb devis validé,en attente et annuler)
            "devisAccepted"     =>  count($devisRepository->findby(['status' => 'accepted'])),
            "devisAborted"      =>  count($devisRepository->findby(['status' => 'aborted'])),
            "devisPending"      =>  count($devisRepository->findby(['status' => 'pending'])),
            // ****************************************recuperation du vendeur meilleur vender
            'classementVendeurVente'   => $resultatMeilleurVendeur,
            // ****************************************recuperation du vendeur le plus rentable
            'classementVendeurPrix'    => $resultatVendeurRentable,
            // ****************************************recuperation de la categorie la plus populaire*
            'classementCategoriePopulaire' => $resultatCountService

        ]);
    }
}
