<?php

declare(strict_types=1);

namespace Tests\Builder\DisplayList;

use EasyAdmin\Domain\DisplayList\Field;

final class FieldBuilder
{
    private string $name;

    private string $label;

    private string $value;

    public function __construct()
    {
        $this->name = 'name';
        $this->label = 'label';
        $this->value = 'value';
    }

    public function build(): Field
    {
        return new Field($this->name, $this->label, $this->value);
    }
}
