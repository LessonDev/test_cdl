<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuteurController extends AbstractController
{
    /**
     * Permet créer une auteur
     * @Route("/editauthor", name="editauthor")
     * @return Response
     */
    public function editAuteur(
        Request $request,
        EntityManagerInterface $manager
    ) {
        $auteur = new Auteur();

        $form = $this->createForm(AuteurType::class, $auteur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($auteur);
            $manager->flush();

            $this->addFlash(
                'success',
                "Auteur <strong>{$auteur->getName()}</strong> a bien été ajouté"
            );

            return $this->redirectToRoute('home');
        }
        return $this->render('auteur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
