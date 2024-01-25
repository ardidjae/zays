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
use Symfony\Component\Validator\Constraints\File;

class BailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date entrée :',
            ])
            ->add('MontantHC', TextType::class, [
                'label' => 'Loyer brut :',
            ])
            ->add('MontantCharges', TextType::class, [
                'label' => 'Charges :',
            ])
            ->add('MontantCaution', TextType::class, [
                'label' => 'Dépôt de garantie :',
            ])
            ->add('MontantPremEcheance', TextType::class, [
                'label' => 'Montant Premiere Echeance :',
            ])
            ->add('TrimestreReference', TextType::class, [
                'label' => 'Trimestre de référence de l\'IRL  :',
            ])
            ->add('appartement', EntityType::class, [
                'class' => 'App\Entity\Appartement',
                'choice_label' => 'porte',
                'label' => 'Selectionner une appart :',
            ])
            ->add('locataires', CollectionType::class, [
                'entry_type' => LocataireType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => true,
            ])

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
