<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Button;

use EasyAdmin\Form\Button\CreateButton;

final class CreateButtonBuilder
{
    private string $name;

    public function __construct()
    {
        $this->name = 'create-name';
    }

    public function withoutName(): self
    {
        $this->name = '';

        return $this;
    }

    public function build(): CreateButton
    {
        return new CreateButton($this->name, 'submit');
    }
}
