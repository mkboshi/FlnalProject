<?php

namespace App\Controller;

use App\Entity\PubHouse;
use App\Form\PubHouseType;
use App\Repository\PubHouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pubhouse")
 */
class PubHouseController extends AbstractController
{
    /**
     * @Route("/", name="app_pub_house_index", methods={"GET"})
     */
    public function index(PubHouseRepository $pubHouseRepository): Response
    {
        return $this->render('pub_house/index.html.twig', [
            'pub_houses' => $pubHouseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pub_house_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PubHouseRepository $pubHouseRepository): Response
    {
        $pubHouse = new PubHouse();
        $form = $this->createForm(PubHouseType::class, $pubHouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubHouseRepository->add($pubHouse, true);

            return $this->redirectToRoute('app_pub_house_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub_house/new.html.twig', [
            'pub_house' => $pubHouse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_house_show", methods={"GET"})
     */
    public function show(PubHouse $pubHouse): Response
    {
        return $this->render('pub_house/show.html.twig', [
            'pub_house' => $pubHouse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pub_house_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PubHouse $pubHouse, PubHouseRepository $pubHouseRepository): Response
    {
        $form = $this->createForm(PubHouseType::class, $pubHouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubHouseRepository->add($pubHouse, true);

            return $this->redirectToRoute('app_pub_house_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub_house/edit.html.twig', [
            'pub_house' => $pubHouse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_house_delete", methods={"POST"})
     */
    public function delete(Request $request, PubHouse $pubHouse, PubHouseRepository $pubHouseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pubHouse->getId(), $request->request->get('_token'))) {
            $pubHouseRepository->remove($pubHouse, true);
        }

        return $this->redirectToRoute('app_pub_house_index', [], Response::HTTP_SEE_OTHER);
    }
}