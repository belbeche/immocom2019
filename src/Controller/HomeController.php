<?php

namespace App\Controller;

use App\Entity\Search;
use App\Entity\Annonce;
use App\Form\SearchType;
use App\Entity\OptionAnnonce;
use App\Repository\AnnonceRepository;
use App\Repository\OptionAnnonceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $repository;
    private $Optionrepository;

    public function __construct(AnnonceRepository $repository,OptionAnnonceRepository $Optionrepository)
    {
        $this->repository = $repository;
        $this->Optionrepository = $Optionrepository;
    }

    /**
    * @Route("/", name="home")
    * @param AnnonceRepository $repository
    * @return Response
    */

    public function index(PaginatorInterface $paginator,Request $request,$id = true): Response
    {
        
        $search = new Search();
        $annonces = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12);

        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $search = $form->getData();
            return $this->redirectToRoute('annonces_immobiliere', ['id' => $search->getId()]);
        }
        //$annonces = $repository->findLatest();
        return $this->render('home/index.html.twig', [
            'current_menu' => 'annonces',
            'annonces' => $annonces,
            'form' => $form->createView()
        ]);
    }
}
