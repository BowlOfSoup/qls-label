<?php

namespace App\Form\Response;

use App\Model\Response\Pagination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaginationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('page', NumberType::class)
            ->add('count', NumberType::class)
            ->add('pageCount', NumberType::class)
            ->add('nextPage', CheckboxType::class)
            ->add('prevPage', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pagination::class,
        ]);
    }
}
