<?php

namespace App\Form;

use App\Entity\Bail;
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

class BailCloturerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dateDebut', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'disabled' => true,
        ])
        ->add('MontantHC', TextType::class, [
            'label' => 'Montant HC :',
            'disabled' => true,
        ])
        ->add('MontantCharges', TextType::class, [
            'label' => 'Montant des charges :',
            'disabled' => true,
        ])
        ->add('MontantCaution', TextType::class, [
            'label' => 'Montant de la caution :',
            'disabled' => true,
        ])
        ->add('MontantPremEcheance', TextType::class, [
            'label' => 'Montant Premiere Echeance :',
            'disabled' => true,
        ])
        ->add('MontantDerEcheance', TextType::class, [
            'label' => 'Montant Derniere Echeance :',
        ])
        ->add('DateFin', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'label' => 'Date de fin du bail :',
        ])
        ->add('EtatLieuEntree', TextType::class, [
            'label' => 'État des lieux à l\'entrée :',
        ])
        ->add('EtatLieuSortie', TextType::class, [
            'label' => 'État des lieux à la sortie :',
        ])
        ->add('appartement', EntityType::class, [
            'class' => 'App\Entity\Appartement',
            'choice_label' => 'porte',
            'label' => 'Appartement :',
            'disabled' => true,
        ])
        ->add('locataires', CollectionType::class, ['entry_type' => LocataireType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'disabled' => true,
        ])
        ->add('Archive', TextType::class, [
            'label' => 'Archive',
        ])
        ->add('CautionRestituer', TextType::class, [
            'label' => 'Montant caution à restituer :',
        ])
        ->add('enregistrer', SubmitType::class, array('label' => 'Modifier Bail'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bail::class,
        ]);
    }
}
