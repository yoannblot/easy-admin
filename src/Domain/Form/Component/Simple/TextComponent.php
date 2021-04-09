<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Component\Simple;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Element\Simple\TextElement;
use EasyAdmin\Domain\Form\Label\Label;

final class TextComponent implements Component
{
    private string $name;

    private Label $label;

    private TextElement $textElement;

    private bool $required;

    public function __construct(string $name, Label $label, TextElement $textElement, bool $required)
    {
        $this->name = $name;
        $this->label = $label;
        $this->textElement = $textElement;
        $this->required = $required;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabelValue(): string
    {
        return $this->label->getValue();
    }

    public function getTextElementValue(): string
    {
        return $this->textElement->getValue();
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getBind(): string
    {
        return $this->textElement->getBind();
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        if ($this->textElement->getValue() === '') {
            return null;
        }

        return $this->textElement->getValue();
    }
}
