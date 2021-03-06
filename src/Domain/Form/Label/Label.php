<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Label;

final class Label
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
