<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Component;

interface Component
{
    public function getBind(): string;

    public function getName(): string;

    public function getValue();
}
