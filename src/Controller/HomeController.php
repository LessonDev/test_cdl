<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        LivreRepository $repository,
        Request $request
    ): Response {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);

        $form->handleRequest($request);
        $livres = $repository->findSearch($data);

        return $this->render('home/index.html.twig', [
            'livres' => $livres,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Permets de supprimer une livre
     * @Route("/delete/{id}", name="delete")
     *
     * @return Response
     */
    public function delete(Livre $livre, EntityManagerInterface $manager)
    {
        $manager->remove($livre);
        $manager->flush();

        $this->addFlash(
            'success',
            "La livre <strong>{$livre->getTitle()}</strong> a bien été suprimer"
        );

        return $this->redirectToRoute('home');
    }
}
