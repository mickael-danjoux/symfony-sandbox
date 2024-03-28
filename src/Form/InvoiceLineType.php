<?php

namespace App\Form;

use App\Entity\Invoice\Invoice;
use App\Entity\Invoice\InvoiceLine;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity',NumberType::class,[
                'empty_data' => 1,
                'attr' => [
                    'min' => 1
                ]

            ])
            ->add('product', EntityType::class, [
                'placeholder' => 'Choose a product',
                'class' => Product::class,
                'choice_label' => function(Product $p){
                    return $p->getName() . ' (' . $p->getPrice() . '€)';
                },
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InvoiceLine::class,
        ]);
    }
}
