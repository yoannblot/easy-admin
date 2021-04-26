<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Common;

final class ElementAttributes
{
    private string $bind;

    private string $name;

    private string $label;

    private string $defaultValue;

    private bool $required;

    private string $values;

    public function __construct(
        string $bind,
        string $name,
        string $label,
        string $defaultValue,
        bool $required,
        string $values
    ) {
        $this->bind = $bind;
        $this->name = $name;
        $this->label = $label;
        $this->defaultValue = $defaultValue;
        $this->required = $required;
        $this->values = $values;
    }

    public function getBind(): string
    {
        return $this->bind;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValues(): string
    {
        return $this->values;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }
}
