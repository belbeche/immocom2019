<?php

namespace App\Controller\Admin;

use App\Entity\OptionAnnonce;
use App\Form\OptionAnnonceType;
use App\Repository\OptionAnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/add/options")
 */
class OptionAnnonceController extends AbstractController
{
    /**
     * @Route("/", name="option_annonce_index", methods={"GET"})
     */
    public function index(OptionAnnonceRepository $optionAnnonceRepository): Response
    {
        return $this->render('option_annonce/index.html.twig', [
            'option_annonces' => $optionAnnonceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="option_annonce_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $optionAnnonce = new OptionAnnonce();
        $form = $this->createForm(OptionAnnonceType::class, $optionAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($optionAnnonce);
            $entityManager->flush();

            return $this->redirectToRoute('option_annonce_index');
        }

        return $this->render('option_annonce/new.html.twig', [
            'option_annonce' => $optionAnnonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="option_annonce_show", methods={"GET"})
     */
    public function show(OptionAnnonce $optionAnnonce): Response
    {
        return $this->render('option_annonce/show.html.twig', [
            'option_annonce' => $optionAnnonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="option_annonce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OptionAnnonce $optionAnnonce): Response
    {
        $form = $this->createForm(OptionAnnonceType::class, $optionAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('option_annonce_index');
        }

        return $this->render('option_annonce/edit.html.twig', [
            'option_annonce' => $optionAnnonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="option_annonce_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OptionAnnonce $optionAnnonce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$optionAnnonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($optionAnnonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('option_annonce_index');
    }
}
