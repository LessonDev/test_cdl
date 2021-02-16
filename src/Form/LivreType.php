<?php

namespace App\Form;

use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Renseigner le titre de livre',
                ],
            ])
            ->add('DatePublication', DateType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => "Entrez l'année d'édition YYYY",
                ],
                'widget' => 'single_text',
            ])
            ->add('Auteur', EntityType::class, [
                'required' => true,
                'choice_label' => 'name',
                'attr' => [
                    'placeholder' => 'Entrer un nouvel auteur',
                ],
                'class' => Auteur::class,
            ])
            ->add('Categorie', EntityType::class, [
                'required' => true,
                'choice_label' => 'topic',
                'attr' => [
                    'placeholder' => 'Entrer une nouvelle catégorie',
                ],
                'class' => Categorie::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
