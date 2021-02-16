<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\LivreRepository;
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
        $form = $this->createForm(SearchForm::class, $data);

        $form->handleRequest($request);
        $livres = $repository->findSearch($data);

        return $this->render('home/index.html.twig', [
            'livres' => $livres,
            'form' => $form->createView(),
        ]);
    }
}
