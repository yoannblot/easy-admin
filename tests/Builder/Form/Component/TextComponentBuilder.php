<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Component;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Label\Label;
use Tests\Builder\Form\Element\Simple\TextElementBuilder;
use Tests\Builder\Form\Label\LabelBuilder;

final class TextComponentBuilder
{
    private Label $label;

    public function __construct()
    {
        $this->label = (new LabelBuilder())->build();
    }

    public function withLabel(Label $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function build(): TextComponent
    {
        return new TextComponent($this->label, (new TextElementBuilder())->build());
    }
}
