<?php

declare(strict_types=1);

namespace EasyAdmin\View\Html\Component\Simple;

use EasyAdmin\Form\Component\Component;
use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\View\Html\Component\HtmlComponentView;
use EasyAdmin\View\Html\Element\Simple\TextElementView;
use EasyAdmin\View\Html\Label\LabelView;

final class TextComponentView implements HtmlComponentView
{
    private LabelView $labelView;

    private TextElementView $textElementView;

    public function __construct(LabelView $labelView, TextElementView $textElementView)
    {
        $this->labelView = $labelView;
        $this->textElementView = $textElementView;
    }

    public function toHtml(Component $component): string
    {
        if (!($component instanceof TextComponent)) {
            return '';
        }

        $html = '';
        $html .= $this->labelView->toHtml($component->getLabelValue());
        $html .= $this->textElementView->toHtml($component->getTextElementValue());

        return $html;
    }
}
