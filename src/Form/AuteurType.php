<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrer un nouvel Auteur',
                ],
            ])
            ->add('Birth', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
                'attr' => [
                    'placeholder' =>
                        'Renseigner date de naissance d\'auteur dd-mm-yyyy ',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
