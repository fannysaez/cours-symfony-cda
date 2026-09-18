<?php

namespace App\Form;

use App\Entity\Tool;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ToolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', null, [
                'label' => 'Nom de mon outil'
            ])
            ->add('danger', ChoiceType::class, [
                'label' => 'Mettez un niveau de danger',
                'choices' => [
                    'Faible'    => 1,
                    'Modéré'    => 2,
                    'Moyen'     => 5,
                    'Élevé'     => 8,
                    'Extrême'   => 10,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tool::class,
        ]);
    }
}
