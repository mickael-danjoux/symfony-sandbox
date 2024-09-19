<?php

namespace App\Form;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CustomerAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Customer::class,
            'placeholder' => 'Choose a Customer',
            'choice_label' => 'fullName',
            'query_builder' => function (CustomerRepository $customerRepository) {
                return $customerRepository->createQueryBuilder('c')
                    ->orderBy('c.lastName', 'ASC')
                    ;
            },
            'label' => 'Search customer in ajax',
            'tom_select_options' => [
                "maxOptions" => null
            ],
            'max_results' => 20
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
