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

class BailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('MontantHC', TextType::class, [
                'label' => 'Montant HC :',
            ])
            ->add('MontantCharges', TextType::class, [
                'label' => 'Montant des charges :',
            ])
            ->add('MontantCaution', TextType::class, [
                'label' => 'Montant de la caution :',
            ])
            ->add('MontantPremEcheance', TextType::class, [
                'label' => 'Montant Premiere Echeance :',
            ])
            ->add('MontantDerEcheance', TextType::class, [
                'label' => 'Montant Derniere Echeance :',
            ])
            ->add('NomCaution1', TextType::class, [
                'label' => 'Nom Caution 1 :',
            ])
            ->add('NomCaution2', TextType::class, [
                'label' => 'Nom Caution 2 :',
            ])
            ->add('DateFin', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de fin du bail :',
            ])
            ->add('DureeBail', IntegerType::class, [
                'label' => 'Durée du bail (en mois) :',
            ])
            ->add('BailSigne', TextType::class, [
                'label' => 'Bail signé :',
            ])
            ->add('EtatLieuEntree', TextType::class, [
                'label' => 'État des lieux à l\'entrée :',
            ])
            ->add('EtatLieuSortie', TextType::class, [
                'label' => 'État des lieux à la sortie :',
            ])
            ->add('AttestationAssurance', TextType::class, [
                'label' => 'Attestation d\'assurance :',
            ])
            ->add('TrimestreReference', TextType::class, [
                'label' => 'Trimestre de référence de l\'IRL  :',
            ])
            ->add('PieceJustificative', TextType::class, [
                'label' => 'Piece Justificative :',
            ])
            ->add('appartement', EntityType::class, [
                'class' => 'App\Entity\Appartement',
                'choice_label' => 'porte',
                'label' => 'Appartement :',
            ])
            ->add('associe', EntityType::class, [
                'class' => 'App\Entity\Associe',
                'choice_label' => function ($asso) {
                    return strtoupper($asso->getNom()) . ' ' . $asso->getPrenom();
                },
                'label' => 'Associé',
                'required' => false,
            ])
            ->add('locataires', CollectionType::class, ['entry_type' => LocataireType::class,
            'entry_options' => ['label' => false],])

            
            ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel Bail'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bail::class,
        ]);
    }
}
