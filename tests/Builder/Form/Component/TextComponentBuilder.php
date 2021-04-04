<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Component;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Label\Label;
use Tests\Builder\Form\Element\Simple\TextElementBuilder;
use Tests\Builder\Form\Label\LabelBuilder;

final class TextComponentBuilder
{
    private string $name;

    private Label $label;

    private TextElement $textElement;

    public function __construct()
    {
        $this->name = '';
        $this->label = (new LabelBuilder())->build();
        $this->textElement = (new TextElementBuilder())->build();
    }

    public function withLabel(Label $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function withTextElement(TextElement $textElement): self
    {
        $this->textElement = $textElement;

        return $this;
    }

    public function build(): TextComponent
    {
        return new TextComponent($this->name, $this->label, $this->textElement);
    }
}
