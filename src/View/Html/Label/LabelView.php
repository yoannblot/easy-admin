<?php

declare(strict_types=1);

namespace EasyAdmin\View\Html\Label;

final class LabelView
{
    public function toHtml(string $label): string
    {
        return "<label>{$label}</label>";
    }
}
