<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\Component\Simple;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Component\Simple\TextComponent;
use EasyAdmin\Viewer\Html\Component\ComponentTagViewer;
use EasyAdmin\Viewer\Html\Component\HtmlComponentViewer;
use EasyAdmin\Viewer\Html\Element\Simple\TextElementViewer;
use EasyAdmin\Viewer\Html\Label\LabelViewer;

final class TextComponentViewer implements HtmlComponentViewer
{
    private ComponentTagViewer $componentTagViewer;

    private LabelViewer $labelView;

    private TextElementViewer $textElementView;

    public function __construct(
        ComponentTagViewer $componentTagViewer,
        LabelViewer $labelView,
        TextElementViewer $textElementView
    ) {
        $this->componentTagViewer = $componentTagViewer;
        $this->labelView = $labelView;
        $this->textElementView = $textElementView;
    }

    public function toHtml(Component $component): string
    {
        if (!($component instanceof TextComponent)) {
            return '';
        }

        $html = '';
        $html .= $this->componentTagViewer->startTagToHtml($component);
        $html .= $this->labelView->toHtml($component->getLabelValue(), $component->getName(), $component->isRequired());
        $html .= $this->textElementView->toHtml(
            $component->getTextElementValue(),
            $component->getName(),
            $component->isRequired()
        );
        $html .= $this->componentTagViewer->endTagToHtml();

        return $html;
    }
}
