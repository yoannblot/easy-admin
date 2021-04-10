<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Element\Simple;

final class IntegerElement
{
    private ?int $value;

    private string $bind;

    public function __construct(?int $value, string $bind)
    {
        $this->value = $value;
        $this->bind = $bind;
    }

    public function getBind(): string
    {
        return $this->bind;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

}
