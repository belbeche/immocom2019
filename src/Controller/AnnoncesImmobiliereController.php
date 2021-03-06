<?php

namespace App\Controller;

use App\Entity\Search;
use App\Entity\Annonce;
use App\Form\SearchType;
use App\Repository\AnnonceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/", name="annonces_immobiliere")
     * @return Query
     */
    public function index(PaginatorInterface $paginator,Request $request,$id = true): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        
        $annonces = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            1);

        // $annonce[0]->setSold(true);
        

        return $this->render('annonces_immobiliere/index.html.twig', [
            'current_menu' => 'annonce',
            'annonces' => $annonces,
            'form' => $form->createView()
        ]);
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
