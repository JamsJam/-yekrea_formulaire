<?php

namespace App\Controller;

use App\Entity\ServicesDetail;
use App\Form\ServicesDetailType;
use App\Repository\ServicesDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/servicesdetail")
 */
class AdminServicesDetailController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_services_detail_index", methods={"GET"})
     */
    public function index(ServicesDetailRepository $servicesDetailRepository): Response
    {
        return $this->render('admin_services_detail/index.html.twig', [
            'services_details' => $servicesDetailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_services_detail_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ServicesDetailRepository $servicesDetailRepository): Response
    {
        $servicesDetail = new ServicesDetail();
        $form = $this->createForm(ServicesDetailType::class, $servicesDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $servicesDetail->setDateCreation(new \DateTimeImmutable("now"));
            $servicesDetailRepository->add($servicesDetail, true);

            return $this->redirectToRoute('app_admin_services_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_services_detail/new.html.twig', [
            'services_detail' => $servicesDetail,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_services_detail_show", methods={"GET"})
     */
    public function show(ServicesDetail $servicesDetail): Response
    {
        return $this->render('admin_services_detail/show.html.twig', [
            'services_detail' => $servicesDetail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_services_detail_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ServicesDetail $servicesDetail, ServicesDetailRepository $servicesDetailRepository): Response
    {
        $form = $this->createForm(ServicesDetailType::class, $servicesDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $servicesDetailRepository->add($servicesDetail, true);

            return $this->redirectToRoute('app_admin_services_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_services_detail/edit.html.twig', [
            'services_detail' => $servicesDetail,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_services_detail_delete", methods={"POST"})
     */
    public function delete(Request $request, ServicesDetail $servicesDetail, ServicesDetailRepository $servicesDetailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servicesDetail->getId(), $request->request->get('_token'))) {
            $servicesDetailRepository->remove($servicesDetail, true);
        }

        return $this->redirectToRoute('app_admin_services_detail_index', [], Response::HTTP_SEE_OTHER);
    }
}
