<?php

declare(strict_types=1);

namespace EasyAdmin\View\Html\Component;

use EasyAdmin\Form\Component\Component;

interface HtmlComponentView
{
    public function toHtml(Component $component): string;
}
