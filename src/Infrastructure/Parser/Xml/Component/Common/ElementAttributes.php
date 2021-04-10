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

    public function __construct(string $bind, string $name, string $label, string $defaultValue, bool $required)
    {
        $this->bind = $bind;
        $this->name = $name;
        $this->label = $label;
        $this->defaultValue = $defaultValue;
        $this->required = $required;
    }

    public function getBind(): string
    {
        return $this->bind;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }
}
