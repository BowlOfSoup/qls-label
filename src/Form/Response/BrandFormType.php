<?php

declare(strict_types=1);

namespace App\Form\Response;

use App\Model\Response\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrandFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', TextType::class)
            ->add('name', TextType::class)
            ->add('website', TextType::class)
            ->add('logo_web', TextType::class, [
                'property_path' => 'logoWeb',
            ])
            ->add('logo_print', TextType::class, [
                'property_path' => 'logoPrint',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}