<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Element\Simple;

final class TextElement
{
    private string $value;

    private string $bind;

    public function __construct(string $value, string $bind)
    {
        $this->value = $value;
        $this->bind = $bind;
    }

    public function getBind(): string
    {
        return $this->bind;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
