<?php

namespace App\Form;

use App\Entity\Mouvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class MouvementModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateM', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => false,
                'disabled' => true,
                 ])
            ->add('libelle', TextType::class, [
                'disabled' => true,
                'label' => false,
                 ])
            ->add('debit', TextType::class, [
                'disabled' => true,
                'label' => false,
                 ])
            ->add('credit', TextType::class, [
                'disabled' => true,
                'label' => false,
                 ])
            ->add('souscategorie', EntityType::class, [
                    'class' => 'App\Entity\SousCategorie',
                    'choice_label' => 'libelle',
                    'label' => false,
                ])
            ->add('enregistrer', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouvement::class,
        ]);
    }
}
