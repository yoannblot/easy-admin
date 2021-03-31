<?php

declare(strict_types=1);

namespace EasyAdmin\Form\Element\Simple;

final class TextElement
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
