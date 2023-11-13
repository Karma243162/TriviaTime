<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class AddQuizzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('image', FileType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('titre', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('nbQuestion', TextType::class, ['attr' => ['class'=> 'form-control'], 'label_attr' => ['class'=> 'fw-bold']])
        ->add('difficulte', EntityType::class, [
            'class' => Quiz::class,
            'choice_label' => 'difficulte', 
            'placeholder' => 'Sélectionnez une Difficulté',
            'attr' => ['class' => 'form-control'], 
            'label_attr' => ['class' => 'fw-bold'], 
        ])
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'nom', 
            'placeholder' => 'Sélectionnez une catégorie',
            'attr' => ['class' => 'form-control'], 
            'label_attr' => ['class' => 'fw-bold'], 
        ])
        ->add('envoyer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
