<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\FilterCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'All categories',
                'empty_data' => null,
                'required' => false,
                'label' => 'Filter by category'
            ])
            ->add('active', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Unsolved' => 'unsolved',
                    'Solved' => 'solved',
                    'All' => 'all',
                ],
                'expanded' => true,
                'data' => 'unsolved',
                'attr' => [
                    'class' => ('')
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilterCategory::class,
        ]);
    }
}
