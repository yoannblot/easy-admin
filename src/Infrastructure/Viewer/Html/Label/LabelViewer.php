<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Label;

final class LabelViewer
{
    public function toHtml(string $label, string $componentName, bool $required): string
    {
        $attributes = '';
        if ($componentName !== '') {
            $attributes .= sprintf(' for="%s"', $componentName);
        }
        if ($required) {
            $attributes .= ' class="required"';
        }

        return "<label{$attributes}>{$label}</label>";
    }
}
