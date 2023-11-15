<?php

namespace App\Form;

use App\Entity\Reponse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isTrue', ChoiceType::class, [
                'label' => 'Est-ce la bonne réponse ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('contenu')
            ->add('question', EntityType::class, [
                'class' => 'App\Entity\Question',
                'choice_label' => 'contenu', // Remplacez 'texte' par le champ de votre entité Question à afficher
                'label' => 'Choisissez la question associée',
            ])
            ->add('envoyer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
}
