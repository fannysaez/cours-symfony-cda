<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\Tool;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duration')
            ->add('name')
            ->add('description')
            ->add('imagePath')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])
            ->add('tools', EntityType::class, [
                'class' => Tool::class,
                'choice_label' => 'label',
                'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'label',
                'multiple' => true,
                // 'expanded' => true,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
