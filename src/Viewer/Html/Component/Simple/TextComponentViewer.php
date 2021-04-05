<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Component\Simple;

use EasyAdmin\Form\Component\Component;
use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Viewer\Html\Component\HtmlComponentViewer;
use EasyAdmin\Viewer\Html\Element\Simple\TextElementViewer;
use EasyAdmin\Viewer\Html\Label\LabelViewer;

final class TextComponentViewer implements HtmlComponentViewer
{
    private LabelViewer $labelView;

    private TextElementViewer $textElementView;

    public function __construct(LabelViewer $labelView, TextElementViewer $textElementView)
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
        $html .= $this->labelView->toHtml($component->getLabelValue(), $component->getName());
        $html .= $this->textElementView->toHtml($component->getTextElementValue(), $component->getName(), $component->isRequired());

        return $html;
    }
}
