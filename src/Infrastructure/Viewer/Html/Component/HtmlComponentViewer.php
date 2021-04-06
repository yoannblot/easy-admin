<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Component;

use EasyAdmin\Domain\Form\Component\Component;

interface HtmlComponentViewer
{
    public function toHtml(Component $component): string;
}
