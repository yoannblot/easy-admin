<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Element\Simple;

use EasyAdmin\Form\Element\Simple\TextElement;

final class TextElementBuilder
{
    private string $value;

    public function __construct()
    {
        $this->value = 'text value';
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function withoutValue(): self
    {
        $this->value = '';

        return $this;
    }

    public function build(): TextElement
    {
        return new TextElement($this->value);
    }
}
