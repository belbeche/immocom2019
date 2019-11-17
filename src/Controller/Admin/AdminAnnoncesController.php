<?php 

namespace App\Controller\Admin;

use App\Entity\Annonce;
use App\Form\AnnoncesType;
use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAnnoncesController extends AbstractController
{

    public function __construct(AnnonceRepository $repository,ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.annonces.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
        $annonces = $this->repository->findAll();

        return $this->render('Admin/Annonces/index.html.twig', compact('annonces'));
    }

    /**
     * @Route("/admin/annonce/create", name="admin.annonces.new")
     */
    public function new(Request $request)
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($annonce);
            $this->em->flush();
            $this->addFlash('success', 'Bien créer avec succés');
            return $this->redirectToRoute('admin.annonces.index');
        }

        return $this->render('Admin/Annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/{id}", name="admin.annonces.edit", methods="GET|POST")
     * @param Annonce repository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(Annonce $annonce,Request $request)
    {
        
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succés');
            return $this->redirectToRoute('admin.annonces.index');
        }

        return $this->render('Admin/Annonces/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.annonces.delete", methods="DELETE")
     */

    public function delete(Annonce $annonce,Request $request)
    {
        // $annonce = new Annonce();
        // if($this->isCsrfTokenValid('delete', $annonce->getId(), $request->get('_token'))){
        // }
            $this->em->remove($annonce);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succés');
            return $this->redirectToRoute('admin.annonces.index');
       
        
    }
}
