<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Label;

final class LabelViewer
{
    public function toHtml(string $label, string $componentName): string
    {
        $attributes = '';
        if ($componentName !== '') {
            $attributes = sprintf(' for="%s"', $componentName);
        }

        return "<label{$attributes}>{$label}</label>";
    }
}
