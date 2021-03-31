<?php

declare(strict_types=1);

namespace EasyAdmin\Form\Component\Simple;

use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Label\Label;

final class TextComponent
{
    private Label $label;

    private TextElement $textElement;

    public function __construct(Label $label, TextElement $textElement)
    {
        $this->label = $label;
        $this->textElement = $textElement;
    }

    public function getLabel(): Label
    {
        return $this->label;
    }

    public function getTextElement(): TextElement
    {
        return $this->textElement;
    }
}
