<?php

namespace App\Form;

use App\Entity\Associe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AssocieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('Prenom', TextType::class, [
                'label' => 'Prenom',
            ])
            ->add('NumRue', TextType::class, [
                'label' => 'Numero de la rue',
            ])
            ->add('Rue', TextType::class, [
                'label' => 'Rue',
            ])
            ->add('Copos', TextType::class, [
                'label' => 'Code postal',
            ])
            ->add('Ville', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('Tel', TextType::class, [
                'label' => 'Numero de teléphone',
            ])
            ->add('Mail', TextType::class, [
                'label' => 'Adresse email',
            ])
            ->add('NbPart', TextType::class, [
                'label' => 'Nombre de Part',
            ])
            ->add('societe', EntityType::class, array('class' => 'App\Entity\Societe','choice_label' => 'nom' ))
            ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel associe'))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Associe::class,
        ]);
    }
}
