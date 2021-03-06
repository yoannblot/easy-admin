<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Label;

use EasyAdmin\Domain\Form\Label\Label;

final class LabelBuilder
{
    private string $value;

    public function __construct()
    {
        $this->value = 'label value';
    }

    public function withValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function build(): Label
    {
        return new Label($this->value);
    }
}
