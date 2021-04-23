<?php

declare(strict_types=1);

namespace Tests\Builder\Form\Button;

use EasyAdmin\Domain\Form\Button\SimpleButton;

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

    public function build(): SimpleButton
    {
        return new SimpleButton($this->name, 'submit');
    }
}
