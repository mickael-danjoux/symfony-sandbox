<?php

namespace App\Controller;

use App\Entity\Invoice\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'app_invoice')]
    public function index(): Response
    {
        $invoice = new Invoice();
        return $this->render('invoice/index.html.twig', [
            'invoice' => $invoice,
        ]);
    }
}
