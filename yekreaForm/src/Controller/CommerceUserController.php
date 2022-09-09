<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("")
 */
class CommerceUserController extends AbstractController
{
    /**
     * @Route("admin/user/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('commerce_user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/commerce/user/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        
        // ******* Utilisation de la fonction de hachage du mot de passe 

        // on stock dans cette variable le mot de passe en claire entré dans le formulaire
        $plaintextPassword =  $form->getData()->getPassword();
        // puis on execute le hachage avec la fonction definis dans security.yaml
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        //ensuite on assigne cette valeur comme mot de passe a notre nouvelle objet $user
        $user->setPassword($hashedPassword);
        // enfin on envois notre objet en base de donner
        $userRepository->add($user, true);
        
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('app_admin_client_new', [], Response::HTTP_SEE_OTHER);
            }
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commerce_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/commerce/user/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('commerce_user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/commerce/user/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {

            // on convertis les roles du formulaire en .json
            $role = json_encode($form->getData()->getRoles());

            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commerce_user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
