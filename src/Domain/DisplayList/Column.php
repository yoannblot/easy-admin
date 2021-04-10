<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\DisplayList;

final class Column
{
    private string $name;

    private string $label;

    private string $value;

    public function __construct(string $name, string $label, string $value)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
