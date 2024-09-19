<?php

namespace App\Controller;

use App\Form\SearchCustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(Request $request): Response
    {
        $searchCustomerForm = $this->createForm(SearchCustomerType::class)->handleRequest($request);

        return $this->render('form/index.html.twig', [
            'searchCustomerForm' => $searchCustomerForm->createView(),
        ]);
    }
}
