<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Button;

use EasyAdmin\Domain\Form\Button\Button;
use EasyAdmin\Viewer\Html\Builder\InputBuilder;

final class ButtonViewer
{
    public function toHtml(Button $button): string
    {
        $builder = new InputBuilder();
        $builder->withType($button->getType()->getType());
        if ($button->getName() !== '') {
            $builder->withName($button->getName());
        }
        if ($button->getValue() !== '') {
            $builder->withValue($button->getValue());
        }

        return $builder->build();
    }
}
