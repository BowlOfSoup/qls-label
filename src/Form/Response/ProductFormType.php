<?php

declare(strict_types=1);

namespace App\Form\Response;

use App\Model\Response\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', NumberType::class)
            ->add('name', TextType::class)
            ->add('specifications', TextType::class)
            ->add('options', CollectionType::class, [
                'entry_type' => ProductOptionFormType::class,
                'allow_add' => true,
            ])
            ->add('combinations', CollectionType::class, [
                'entry_type' => ProductCombinationFormType::class,
                'allow_add' => true,
            ])
            ->add('pricing', CollectionType::class, [
                'entry_type' => ProductPricingFormType::class,
                'allow_add' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}