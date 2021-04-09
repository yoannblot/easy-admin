<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Element\Simple;

use EasyAdmin\Domain\Form\Element\Simple\TextElement;

final class TextElementBuilder
{
    private string $value;

    private string $bind;

    public function __construct()
    {
        $this->value = 'text value';
        $this->bind = 'value';
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
        return new TextElement($this->value, $this->bind);
    }
}
