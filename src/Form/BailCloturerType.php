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
            ->add('dateDebut')
            ->add('MontantHC')
            ->add('MontantCharges')
            ->add('MontantCaution')
            ->add('NomCaution1')
            ->add('NomCaution2')
            ->add('DateFin')
            ->add('DureeBail')
            ->add('BailSigne')
            ->add('EtatLieuEntree')
            ->add('EtatLieuSortie')
            ->add('AttestationAssurance')
            ->add('MontantPremEcheance')
            ->add('MontantDerEcheance')
            ->add('TrimestreReference')
            ->add('PieceJustificative')
            ->add('archive')
            ->add('CautionRestituer', TextType::class, [
                'label' => 'Montant caution à restituer :',
            ])
            ->add('appartement')
            ->add('associe')
            ->add('locataires')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bail::class,
        ]);
    }
}
