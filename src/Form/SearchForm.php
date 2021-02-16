<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Auteur;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher',
                ],
            ])

            ->add('auteur', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Auteur::class,
                'expanded' => true,
                'multiple' => true,
            ])

            ->add('categorie', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Categorie::class,
                'expanded' => true,
                'multiple' => true,
            ])

            ->add('datePublicationMin', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy',
            ])
            ->add('datePublicationMax', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
