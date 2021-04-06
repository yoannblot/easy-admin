<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Button;

interface Button
{
    public function getType(): ButtonType;

    public function getName(): string;

    public function getValue(): string;
}
