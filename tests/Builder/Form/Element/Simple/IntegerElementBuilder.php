<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Element\Simple;

use EasyAdmin\Domain\Form\Element\Simple\IntegerElement;

final class IntegerElementBuilder
{
    private int $value;

    private string $bind;

    public function __construct()
    {
        $this->value = 1;
        $this->bind = 'number';
    }

    public function build(): IntegerElement
    {
        return new IntegerElement($this->value, $this->bind);
    }
}
