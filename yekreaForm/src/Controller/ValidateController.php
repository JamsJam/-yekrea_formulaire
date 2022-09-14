<?php

namespace App\Controller;

use App\Entity\Devis;
use DateTimeImmutable;
use App\Entity\Command;
use App\Repository\DevisRepository;
use App\Repository\CommandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ValidateController extends AbstractController
{
    /** A la validation de la commande, cette route permet:
     * - la création du numéro de devis dans la table DEVIS
     * - l'insertion de la "date de validation" dans la table COMMANDE
     * 
     * @Route("admin/validate/{id}", name="app_validate")
     */

    public function index( Command $command, CommandRepository $commandRepository, DevisRepository $devisRepository ): Response
    {   
        
        $devi = new Devis();

        // fonction time -1900 pour créer le num du devis 
        $numDevis= time()-1900;
        
        $devi->setnumDevis($numDevis);
        $devi->setCommand($command);

        // insert dans la table la date de validation de la commande dans la BDD
        $command->setValidationDate(new DateTimeImmutable("now"));

        // Si l'ID n'existe pas l'ajoute en BDD 
        // le modifie si l'ID existe
        $commandRepository->add($command, true);
        $devisRepository->add($devi, true);
        
        return $this->redirectToRoute('app_command_show',["id"=>$command->getId()], Response::HTTP_SEE_OTHER);
    }
}
