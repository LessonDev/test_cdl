<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    /**
     * Permet d'éditer une livre
     * @Route("/create",  name="createbook")
     * @Route("/edit/{id}", name="editbook")
     *
     * @return Response
     */
    public function editBook(
        Livre $livre = null,
        Request $request,
        EntityManagerInterface $manager
    ) {
        $message = 'modifiée';
        if (!$livre) {
            $livre = new Livre();
            $message = 'créer';
        }

        $form = $this->createForm(LivreType::class, $livre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($livre);
            $manager->flush();

            $this->addFlash(
                'success',
                "La livre <strong>{$livre->getTitle()}</strong> a bien été" .
                    ' ' .
                    $message
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('livre/index.html.twig', [
            'form' => $form->createView(),
            'livre' => $livre,
        ]);
    }
}
