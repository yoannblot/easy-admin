<?php

declare(strict_types=1);

namespace EasyAdmin\Form\Button;

final class ButtonType
{
    public static function submit(): self
    {
        return new self('submit');
    }

    private string $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
