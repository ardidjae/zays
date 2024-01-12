<?php

namespace App\Form;

use App\Entity\Bail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class BailModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dateDebut', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'label' => 'Date de Début :',
        ])
        ->add('MontantHC', TextType::class, [
            'label' => 'Loyer brut :',
        ])
        ->add('MontantCharges', TextType::class, [
            'label' => 'Montant des Charges :',
        ])
        ->add('MontantCaution', TextType::class, [
            'label' => 'Dépôt de garantie :',
        ])
        ->add('MontantPremEcheance', TextType::class, [
            'label' => 'Montant 1ère Echeance :',
        ])
        ->add('DateFin', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'label' => 'Date de fin du bail :',
        ])
        ->add('DureeBail', IntegerType::class, [
            'label' => 'Durée du bail (en années) :',
        ])
        ->add('BailSigne', FileType::class, [
            'label' => 'Joindre Bail Signé :',
            'mapped' => false,
        ])
        ->add('AttestationAssurance', FileType::class, [
            'label' => 'Joindre Attestation d\'assurance :',
            'mapped' => false,
        ])
        ->add('TrimestreReference', TextType::class, [
            'label' => 'Trimestre de référence de l\'IRL  :',
        ])
        ->add('appartement', EntityType::class, [
            'class' => 'App\Entity\Appartement',
            'choice_label' => 'porte',
            'label' => 'Appartement :',
        ])
        ->add('locataires', CollectionType::class, ['entry_type' => LocataireType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'disabled' => true,
        ])
        ->add('CautionRestituer', TextType::class, [
            'label' => 'Montant de la Caution à Restituer :',
        ])
        ->add('EtatLieuEntreeSigne', FileType::class, [
            'label' => 'Joindre Etat Lieu Entree Signe :',
            'mapped' => false,
        ])
        ->add('EtatLieuSortieSigne', FileType::class, [
            'label' => 'Joindre Etat Lieu Sortie Signe :',
            'mapped' => false,
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
