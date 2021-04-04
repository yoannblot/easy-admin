<?php

declare(strict_types=1);

namespace EasyAdmin\Form\Button;

interface Button
{
    public function getType(): ButtonType;

    public function getName(): string;
}
