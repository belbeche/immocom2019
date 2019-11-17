<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param AnnonceRepository $repository
     * @return Response
     */
    public function index(AnnonceRepository $repository): Response
    {
        $annonces = $repository->findLatest();
        return $this->render('home/index.html.twig', [
            'current_menu' => 'annonces',
            'annonces' => $annonces
        ]);
    }
}
