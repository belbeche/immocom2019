<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesImmobiliereController extends AbstractController
{

    /**
    * @var AnnonceRepository
    */

    private $repository;

    /**
    * @var ObjectManager
    */

    private $em;

    public function __construct(AnnonceRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/annonces", name="annonces_immobiliere")
     */
    public function index($slug, $id)
    {
        
        $annonce = $this->repository->findAllVisible();
        dump($annonce);
        // $annonce[0]->setSold(true);
        $this->em->flush();

        return $this->render('annonces_immobiliere/index.html.twig');
    }
    
    /**
     * @Route("/annonce/{slug} - {id}", name="show_annonce", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function showAnnonce(Annonce $annonce, string $slug): Response
    {
        // Annonce $annonce = findAuto $id, slug entity 
        // $annonce = $this->repository->find($id);
        // je crée une condition qui me redirige si le slug ne correspond pas 
        if ($annonce->getSlug() !== $slug)
        {
            return $this->redirectToRoute('show_annonce', [
                'id' => $annonce->getId(),
                'slug' => $annonce->getSlug()
            ], 301);
        }
        return $this->render('annonces_immobiliere/show.html.twig', [
            'current_menu' => 'annonces',
            'annonce' => $annonce
        ]);
    }
}
