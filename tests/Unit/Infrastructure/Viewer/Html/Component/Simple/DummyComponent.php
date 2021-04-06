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
}
