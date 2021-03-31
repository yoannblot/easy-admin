<?php

declare(strict_types=1);

namespace EasyAdmin\View\Html\Element\Simple;

final class HtmlTextElementView
{
    public function toHtml(string $value): string
    {
        return '<input type="text">';
    }
}
