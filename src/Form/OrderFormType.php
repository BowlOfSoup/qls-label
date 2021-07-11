<?php

namespace App\Form;

use App\Model\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', NumberType::class, [
                'property_path' => 'productId',
            ])
            ->add('product_combination', NumberType::class, [
                'property_path' => 'productCombinationId',
            ])
            ->add('brand', HiddenType::class, [
                'property_path' => 'brandId'
            ])
            ->add('address', AddressFormType::class, [
                'label' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Bestellen!'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
