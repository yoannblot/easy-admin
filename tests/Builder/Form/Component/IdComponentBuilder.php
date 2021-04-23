<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Component;

use EasyAdmin\Domain\Form\Component\Simple\IdComponent;
use EasyAdmin\Domain\Form\Element\Simple\IntegerElement;
use Tests\Builder\Form\Element\Simple\IntegerElementBuilder;

final class IdComponentBuilder
{
    private IntegerElement $intElement;

    public function __construct()
    {
        $this->intElement = (new IntegerElementBuilder())->build();
    }

    public function build(): IdComponent
    {
        return new IdComponent($this->intElement);
    }
}
