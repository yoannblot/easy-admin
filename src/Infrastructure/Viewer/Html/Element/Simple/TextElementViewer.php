<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Element\Simple;

use EasyAdmin\Infrastructure\Viewer\Html\Builder\InputBuilder;

final class TextElementViewer
{
    public function toHtml(string $value, string $componentName, bool $required): string
    {
        $builder = new InputBuilder();
        if ($value !== '') {
            $builder->withValue($value);
        }
        if ($componentName !== '') {
            $builder->withName($componentName);
            $builder->withId($componentName);
        }
        if ($required) {
            $builder->required();
        }

        return $builder->build();
    }
}
