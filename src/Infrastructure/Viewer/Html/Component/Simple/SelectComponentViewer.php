<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\Component\Simple;

use EasyAdmin\Domain\Form\Component\Component;
use EasyAdmin\Domain\Form\Component\Simple\SelectComponent;
use EasyAdmin\Infrastructure\Viewer\Html\Component\ComponentTagViewer;
use EasyAdmin\Infrastructure\Viewer\Html\Component\HtmlComponentViewer;
use EasyAdmin\Infrastructure\Viewer\Html\Element\Simple\SelectElementViewer;
use EasyAdmin\Infrastructure\Viewer\Html\Label\LabelViewer;

final class SelectComponentViewer implements HtmlComponentViewer
{
    private ComponentTagViewer $componentTagViewer;

    private LabelViewer $labelView;

    private SelectElementViewer $elementViewer;

    public function __construct(
        ComponentTagViewer $componentTagViewer,
        LabelViewer $labelView,
        SelectElementViewer $elementViewer
    ) {
        $this->componentTagViewer = $componentTagViewer;
        $this->labelView = $labelView;
        $this->elementViewer = $elementViewer;
    }

    public function toHtml(Component $component): string
    {
        if (!($component instanceof SelectComponent)) {
            return '';
        }

        $html = '';
        $html .= $this->componentTagViewer->startTagToHtml($component);
        $html .= $this->labelView->toHtml($component->getLabelValue(), $component->getName(), $component->isRequired());
        $html .= $this->elementViewer->toHtml(
            $component->getSelectedValue(),
            $component->getValues(),
            $component->getName(),
            $component->isRequired(),
            $component->isEmptyValueAllowed()
        );
        $html .= $this->componentTagViewer->endTagToHtml();

        return $html;
    }
}
