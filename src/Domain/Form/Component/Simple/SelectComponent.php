<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Component\Simple;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Element\Simple\SelectElement;
use EasyAdmin\Domain\Form\Label\Label;

final class SelectComponent implements Component
{
    private string $name;

    private Label $label;

    private SelectElement $selectElement;

    private bool $required;

    public function __construct(string $name, Label $label, SelectElement $textElement, bool $required)
    {
        $this->name = $name;
        $this->label = $label;
        $this->selectElement = $textElement;
        $this->required = $required;
    }

    public function getBind(): string
    {
        return $this->selectElement->getBind();
    }

    public function getLabelValue(): string
    {
        return $this->label->getValue();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSelectedValue(): string
    {
        return $this->selectElement->getSelectedValue();
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        if ($this->selectElement->getSelectedValue() === '') {
            return null;
        }

        return $this->selectElement->getSelectedValue();
    }

    public function getValues(): string
    {
        return $this->selectElement->getValues();
    }

    public function isEmptyValueAllowed(): bool
    {
        return $this->selectElement->isEmptyValueAllowed();
    }

    public function isRequired(): bool
    {
        return $this->required;
    }
}
