<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Element\Simple;

final class SelectElement
{
    private string $selectedValue;

    private string $bind;

    private string $values;

    private bool $emptyValueAllowed;

    public function __construct(string $selectedValue, string $bind, string $values, bool $emptyValueAllowed)
    {
        $this->selectedValue = $selectedValue;
        $this->bind = $bind;
        $this->values = $values;
        $this->emptyValueAllowed = $emptyValueAllowed;
    }

    public function getBind(): string
    {
        return $this->bind;
    }

    public function getSelectedValue(): string
    {
        return $this->selectedValue;
    }

    public function getValues(): string
    {
        return $this->values;
    }

    public function isEmptyValueAllowed(): bool
    {
        return $this->emptyValueAllowed;
    }
}
