<?php

namespace App\Twig\Components\Invoice;

use App\Entity\Invoice\Invoice;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class InvoiceCreator
{
    use DefaultActionTrait;

    #[LiveProp(writable: ['lastName', 'firstName', 'taxRate'])]
    #[Valid]
    public Invoice $invoice;

}
