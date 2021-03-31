<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Label;

final class LabelViewer
{
    public function toHtml(string $label): string
    {
        return "<label>{$label}</label>";
    }
}
