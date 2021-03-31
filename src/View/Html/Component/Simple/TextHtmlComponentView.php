<?php

declare(strict_types=1);

namespace EasyAdmin\View\Html\Component\Simple;

use EasyAdmin\Form\Component\Component;
use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\View\Html\Component\HtmlComponentView;
use EasyAdmin\View\Html\Label\LabelView;

final class TextHtmlComponentView implements HtmlComponentView
{
    private LabelView $labelView;

    public function __construct(LabelView $labelView)
    {
        $this->labelView = $labelView;
    }

    public function toHtml(Component $component): string
    {
        if (!($component instanceof TextComponent)) {
            return '';
        }

        return $this->labelView->toHtml($component->getLabelValue());
    }
}
