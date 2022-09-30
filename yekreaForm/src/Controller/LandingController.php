<?php

namespace App\Controller;

use App\Service\Mail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LandingController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_landing")
     */
    public function index(): Response
    {   

        return $this->render('landing/index.html.twig', []);
    }
}
