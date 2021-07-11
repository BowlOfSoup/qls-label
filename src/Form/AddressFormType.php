<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName', TextType::class)
            ->add('fullName', TextType::class)
            ->add('street', TextType::class)
            ->add('houseNumber', TextType::class)
            ->add('zibCode', TextType::class)
            ->add('city', TextType::class)
            ->add('countryCode', CountryType::class)
            ->add('email', EmailType::class)
            ->add('phone', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}