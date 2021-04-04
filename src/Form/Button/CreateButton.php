<?php

declare(strict_types=1);

namespace EasyAdmin\Form\Button;

final class CreateButton implements Button
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): ButtonType
    {
        return ButtonType::submit();
    }
}
