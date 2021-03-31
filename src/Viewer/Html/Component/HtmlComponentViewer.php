<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Component;

use EasyAdmin\Form\Component\Component;

interface HtmlComponentViewer
{
    public function toHtml(Component $component): string;
}