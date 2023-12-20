<?php

namespace App\Form;

use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SousCategorieModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'Libelle',
            ])
            ->add('categorie', EntityType::class, array('class' => 'App\Entity\Categorie','choice_label' => 'libelle' ))

            ->add('enregistrer', SubmitType::class, array('label' => 'Modifier Sous-Categorie'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousCategorie::class,
        ]);
    }
}
