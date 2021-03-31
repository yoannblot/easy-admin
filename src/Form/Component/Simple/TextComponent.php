<?php

declare(strict_types=1);

namespace EasyAdmin\Form\Component\Simple;

use EasyAdmin\Form\Component\Component;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Label\Label;

final class TextComponent implements Component
{
    private Label $label;

    private TextElement $textElement;

    public function __construct(Label $label, TextElement $textElement)
    {
        $this->label = $label;
        $this->textElement = $textElement;
    }

    public function getLabelValue(): string
    {
        return $this->label->getValue();
    }

    public function getTextElementValue(): string
    {
        return $this->textElement->getValue();
    }
}
