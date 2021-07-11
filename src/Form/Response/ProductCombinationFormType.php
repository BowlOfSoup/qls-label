<?php

declare(strict_types=1);

namespace App\Form\Response;

use App\Model\Response\Meta;
use App\Model\Response\ProductCombination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCombinationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', NumberType::class)
            ->add('name', TextType::class)
            ->add('product_options', CollectionType::class, [
                'property_path' => 'productOptions',
                'entry_type' => ProductOptionFormType::class,
                'allow_add' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductCombination::class,
        ]);
    }
}