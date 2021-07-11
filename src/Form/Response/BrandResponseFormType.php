<?php

declare(strict_types=1);

namespace App\Form\Response;

use App\Model\Response\BrandResponse;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrandResponseFormType extends AbstractResponseFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('data', CollectionType::class, [
                'property_path' => 'brands',
                'entry_type' => BrandFormType::class,
                'allow_add' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BrandResponse::class,
        ]);
    }
}