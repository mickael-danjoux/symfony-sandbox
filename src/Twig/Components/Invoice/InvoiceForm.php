<?php

namespace App\Twig\Components\Invoice;

use App\Entity\Invoice\Invoice;
use App\Entity\Invoice\InvoiceLine;
use App\Form\InvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent]
class InvoiceForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp]
    public ?Invoice $initialInvoice = null;

    #[LiveAction]
    public function submit(EntityManagerInterface $em): RedirectResponse
    {
        $this->submitForm();
        $em->persist($this->initialInvoice);
        $em->flush();

        $this->addFlash('success', 'Invoice created !');

        return $this->redirectToRoute('app_invoice');

    }


    public function getTotal(): float
    {
        $taxMultiplier = 1 + ($this->initialInvoice->getTaxRate() / 100);

        return $this->getSubtotal() * $taxMultiplier;
    }

    public function getSubTotal(): float
    {
        $result = 0;
        foreach ($this->initialInvoice->getInvoiceLines() as $line) {
            $result += $line->getProduct()?->getPrice() * max($line->getQuantity(), 1);
        }

        return $result;
    }

    protected function instantiateForm(): FormInterface
    {
        $this->initialInvoice->addInvoiceLine(new InvoiceLine());
        return $this->createForm(InvoiceType::class, $this->initialInvoice);
    }
}
