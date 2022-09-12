<?php

namespace App\Controller;

use App\Entity\Command;
use App\Form\CommandType;
use App\Repository\CommandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security as CoreSecurity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as ConfigurationSecurity;

/**
 * @Route("/command")
 */
class CommandController extends AbstractController
{
    /**
     * @Route("/", name="app_command_index", methods={"GET"})
     */
    public function index(CommandRepository $commandRepository, Security $security): Response
    {
        // $user = $this->$security->getUser();
        // dd($this->$security->getUser());
        // $command->setUser($user->getId());
        return $this->render('command/index.html.twig', [
            'commands' => $commandRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="app_command_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CommandRepository $commandRepository): Response
    {
        $command = new Command();
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $command->setCreateDate(new \DateTimeImmutable("now"));


            $commandRepository->add($command, true);
            
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
}
