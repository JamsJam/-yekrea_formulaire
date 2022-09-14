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
    /**
     * @Route("admin/validate/{id}", name="app_validate")
     */
    public function index( Command $command, CommandRepository $commandRepository, DevisRepository $devisRepository ): Response
    {   
        // création du numéro de devis à la validation du bouton
        $devi = new Devis();

        $numDevis= time()-1900;
        $devi->setnumDevis($numDevis);

        $devi->setCommand($command);

        // insert dans la table la date de validation de la commande
        $command->setValidationDate(new DateTimeImmutable("now"));

        // ajoute en BDD si l'id n'existe pas et le modifie si l'ID existe
        $commandRepository->add($command, true);
        $devisRepository->add($devi, true);
        
        return $this->redirectToRoute('app_command_show',["id"=>$command->getId()], Response::HTTP_SEE_OTHER);
    }
}
