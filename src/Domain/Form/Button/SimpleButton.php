<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Button;

final class SimpleButton implements Button
{
    private string $name;

    private string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getType(): ButtonType
    {
        return ButtonType::submit();
    }
}
