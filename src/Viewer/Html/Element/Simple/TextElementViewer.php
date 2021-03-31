<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Element\Simple;

final class TextElementViewer
{
    public function toHtml(string $value): string
    {
        return '<input type="text">';
    }
}
