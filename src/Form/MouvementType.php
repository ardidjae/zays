<?php

namespace App\Form;

use App\Entity\Mouvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class MouvementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateM', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'disabled' => true,
                 ])
            ->add('libelle', TextType::class, [
                'disabled' => true,
                 ])
            ->add('debit', TextType::class, [
                'disabled' => true,
                 ])
            ->add('credit', TextType::class, [
                'disabled' => true,
                 ])
            ->add('souscategorie', EntityType::class, array('class' => 'App\Entity\SousCategorie','choice_label' => 'libelle' ))
            ->add('enregistrer', SubmitType::class, array('label' => 'Sauvegarder'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouvement::class,
        ]);
    }
}
