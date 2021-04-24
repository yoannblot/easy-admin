<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Element\Simple;

use EasyAdmin\Infrastructure\Viewer\Html\Builder\SelectBuilder;

final class SelectElementViewer
{
    public function toHtml(string $selectedValue, array $values, string $componentName, bool $required, bool $emptyValueAllowed): string
    {
        $builder = new SelectBuilder();
        $builder->withValues($values);
        if ($emptyValueAllowed){
            $builder->emptyValueAllowed();
        }
        if ($selectedValue !== '') {
            $builder->withSelectedValue($selectedValue);
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
