<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Viewer\Html\Component\Simple;

use EasyAdmin\Domain\Form\Component\Component;

final class DummyComponent implements Component
{
    public function getName(): string
    {
        return '';
    }

    public function getBind(): string
    {
        return '';
    }

    public function getValue()
    {
        return '';
    }

}
