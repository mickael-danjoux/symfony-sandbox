<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class Logs
{
    use DefaultActionTrait;

    #[LiveProp]
    public array $messages = ['First Message'];

    #[LiveListener('addLogEvent')]
    public function addLog(#[LiveArg] string $message): void
    {
        $this->messages[] = $message;
    }

    #[LiveAction]
    public function clear(): void
    {
        $this->messages = [];
    }

}
