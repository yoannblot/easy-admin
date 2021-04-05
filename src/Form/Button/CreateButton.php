<?php

declare(strict_types=1);

namespace EasyAdmin\Form\Button;

final class CreateButton implements Button
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
