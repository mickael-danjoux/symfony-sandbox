<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Alert
{
    public string $type = 'success';

    public ?string $message = null;

    public ?bool $withoutCloseButton = false;

    public function getClasses(): string
    {
        $classes = 'show alert alert-' . $this->type;
        if(!$this->withoutCloseButton){
            $classes .= ' alert-dismissible fade show';
        }
        return $classes;
    }

}
