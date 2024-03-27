<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class RandomNumber
{
    const MAX = 1000;

    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp(writable: true)]
    public int $max = self::MAX;

    #[LiveProp]
    public int $number;


    #[LiveAction]
    public function getNewNumber(): void
    {
        $number = $this->generateRandomNumber();
        $this->emit('addLogEvent', ['message' => 'New number generated: ' . $number]);
        $this->number = $number;
    }

    private function generateRandomNumber(): int
    {
        return rand(0, $this->max);
    }

    #[LiveAction]
    public function resetMax(): void
    {
        if ($this->max !== self::MAX) {
            $this->max = self::MAX;
            $this->emit('addLogEvent', ['message' => 'Reset to 1000']);
        }
    }

    public function mount(): void
    {
        $this->number = $this->generateRandomNumber();
    }

}
