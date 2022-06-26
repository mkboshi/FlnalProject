<?php

namespace App\Controller;

use App\Entity\Exemplar;
use App\Form\ExemplarType;
use App\Repository\ExemplarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exemplar")
 */
class ExemplarController extends AbstractController
{
    /**
     * @Route("/", name="app_exemplar_index", methods={"GET"})
     */
    public function index(ExemplarRepository $exemplarRepository): Response
    {
        return $this->render('exemplar/index.html.twig', [
            'exemplars' => $exemplarRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_exemplar_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ExemplarRepository $exemplarRepository): Response
    {
        $exemplar = new Exemplar();
        $form = $this->createForm(ExemplarType::class, $exemplar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exemplarRepository->add($exemplar, true);

            return $this->redirectToRoute('app_exemplar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exemplar/new.html.twig', [
            'exemplar' => $exemplar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_exemplar_show", methods={"GET"})
     */
    public function show(Exemplar $exemplar): Response
    {
        return $this->render('exemplar/show.html.twig', [
            'exemplar' => $exemplar,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_exemplar_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Exemplar $exemplar, ExemplarRepository $exemplarRepository): Response
    {
        $form = $this->createForm(ExemplarType::class, $exemplar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exemplarRepository->add($exemplar, true);

            return $this->redirectToRoute('app_exemplar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exemplar/edit.html.twig', [
            'exemplar' => $exemplar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_exemplar_delete", methods={"POST"})
     */
    public function delete(Request $request, Exemplar $exemplar, ExemplarRepository $exemplarRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exemplar->getId(), $request->request->get('_token'))) {
            $exemplarRepository->remove($exemplar, true);
        }

        return $this->redirectToRoute('app_exemplar_index', [], Response::HTTP_SEE_OTHER);
    }
}