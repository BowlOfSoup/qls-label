<?php

namespace App\Form\Response;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AbstractResponseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('meta', MetaFormType::class)
            ->add('pagination', PaginationFormType::class)
        ;
    }
}
