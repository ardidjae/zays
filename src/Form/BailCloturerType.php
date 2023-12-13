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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class BailCloturerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
