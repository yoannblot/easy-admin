<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Component;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Component\Simple\TextComponent;

final class ComponentTagViewer
{
    public function startTagToHtml(Component $component): string
    {
        $attributes = 'form-item';
        if ($component->getName() !== '') {
            $attributes .= ' ' . $component->getName();
        }
        if ($this->getClassName($component) !== '') {
            $attributes .= ' ' . $this->getClassName($component);
        }

        return sprintf('<div class="%s">', $attributes);
    }

    public function endTagToHtml(): string
    {
        return '</div>';
    }

    private function getClassName(Component $component): string
    {
        if ($component instanceof TextComponent) {
            return 'text';
        }

        return '';
    }
}
