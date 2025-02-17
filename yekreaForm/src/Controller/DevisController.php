<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisType;
use App\Service\PdfService;
use App\Repository\DevisRepository;
use App\Repository\CommandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("")
 */
class DevisController extends AbstractController
{
    /**
     * @Route("/devis/", name="app_devis_index", methods={"GET"})
     */
    public function index(DevisRepository $devisRepository, Request $request): Response
    {
        if($request->query->get('comId') ){
            $devis = $devisRepository->findDevis($request->query->get('comId'));
        }
        else{
            if (($request->query->get('status'))) {
                $status = $request->query->get('status');
                $devis = $devisRepository->findBy(['status' => $status],['id' => 'DESC']);
            } else {
                
                $devis = $devisRepository->findBy([],['id' => 'DESC']);
            }
            
        }

        return $this->render('devis/index.html.twig', [
            //rangement dans du plus recent au plus ancient
            'devis' => $devis,
        ]);
    }



    /**
     * @Route("admin/devis/devis/{id}", name="app_devis_show", methods={"GET"})
     */
    public function show(Devis $devis): Response
    {
        // dd($devis->getCommand()->isValidated());
        return $this->render('devis/show.html.twig', [
            'devis' => $devis,
        ]);
    }

    /**
     * @Route("/admin/devis/{id}/edit", name="app_devis_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Devis $devis, DevisRepository $devisRepository): Response
    {
        $form = $this->createForm(DevisType::class, $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisRepository->add($devis, true);

            return $this->redirectToRoute('app_devis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis/edit.html.twig', [
            'devis' => $devis,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/devis/{id}", name="app_devis_delete", methods={"POST"})
     */
    public function delete(Request $request, Devis $devis, DevisRepository $devisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devis->getId(), $request->request->get('_token'))) {
            $devisRepository->remove($devis, true);
        }

        return $this->redirectToRoute('app_devis_index', [], Response::HTTP_SEE_OTHER);
    }


















    
    // **************************************** AFFICHAGE DU PDF


    //Route ayant pour seul et unique but de mettre en forme et de servir de base au PDF. 
    // /!\/!\   Non destiné a etre affiché   /!\/!\
    /**
     * @Route("/admin/devis/pdf/{id}", name="app_devis_pdf_template", methods={"GET"})
     */
    public function htmlToPdf(Devis $devis):Response
    {
        return $this->render('devis/toPdf.html.twig', [
            'devis' => $devis,
        ]);
    }


    //Route permettant de telecharger le PDF
    // /!\/!\   Route a mettre sur les boutons correspondant   /!\/!\
    /**
     * @Route("commerce/devis/getpdf/{id}", name="app_devis_pdf_render")
     */
    public function generatePdfDevis(Devis $devis , PdfService $pdf)
    {
        $html = $this-> renderview('devis/toPdf.html.twig',['devis' => $devis]);
        $pdf-> showPdfFile($html);
        }


}
