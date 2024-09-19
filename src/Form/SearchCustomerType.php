<?php

namespace App\Form;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'fullName',
                'autocomplete' => true,
                'label' => 'Simple autocomplete',
                'placeholder' => 'Choose a Customer',
                'query_builder' => function (CustomerRepository $customerRepository) {
                    return $customerRepository->createQueryBuilder('c')
                        ->orderBy('c.lastName', 'ASC');
                },
            ])
            ->add('customer-ajax', CustomerAutocompleteField::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
