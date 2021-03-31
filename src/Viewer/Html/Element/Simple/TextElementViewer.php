<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Element\Simple;

use EasyAdmin\Viewer\Html\Builder\InputBuilder;

final class TextElementViewer
{
    public function toHtml(string $value): string
    {
        $builder = new InputBuilder();
        if ($value !== '') {
            $builder->withValue($value);
        }

        return $builder->build();
    }
}
