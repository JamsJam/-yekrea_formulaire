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
        // $commercial = $userRepository->findBy(["roles"=> "ROLE_USER"]);
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
        $columns = array_column($resultat, 2);
        array_multisort($columns, SORT_DESC, $resultat);
        // dd($resultat[0]);
        return $this->render('dashboard/index.html.twig', [
            'commandes' =>  $commandRepository->findall(),
            'lastCommandes' => $lastCommand = $commandRepository->findby([],['id'=> 'DESC'], 4),
            'premierVender' => $resultat[0],

        ]);
    }
}
