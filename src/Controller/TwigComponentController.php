<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TwigComponentController extends AbstractController
{
    #[Route('/twig-component', name: 'app_twig_component')]
    public function index(): Response
    {
        $this->addFlash('success', 'test success');
        $this->addFlash('warning', 'test success');
        $this->addFlash('danger', 'test danger');
        return $this->render('twig_component/index.html.twig', [
            'controller_name' => 'TwigComponentController',
        ]);
    }
}
