<?php

namespace App\Twig\Components;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Flashes
{
    /** @var Alert[] */
    public array $alerts = [];

    private SessionInterface $session;

    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
        $this->session = $this->requestStack->getSession();
        $this->consume();
    }

    private function consume(): void
    {
        foreach ($this->session->getFlashBag()->peekAll() as $type => $messages) {
            foreach ($messages as $message){
                $alert = new Alert();
                $alert->type = $type;
                $alert->message = $message;
                $this->alerts[] = $alert;
            }
        }
        $this->session->getFlashBag()->clear();
    }
}
