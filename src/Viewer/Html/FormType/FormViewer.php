<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\FormType;

use EasyAdmin\Form\FormType\Form;
use EasyAdmin\Viewer\Html\FormType\Tag\FormTagViewer;
use EasyAdmin\Viewer\HtmlViewer;

final class FormViewer
{
    private FormTagViewer $formTagViewer;

    private HtmlViewer $htmlViewer;

    public function __construct(FormTagViewer $formTagViewer, HtmlViewer $htmlViewer)
    {
        $this->formTagViewer = $formTagViewer;
        $this->htmlViewer = $htmlViewer;
    }

    public function toHtml(Form $form): string
    {
        return $this->formTagViewer->startTagToHtml($form->getTag())
            . $this->htmlViewer->toHtml($form->getStructure())
            . $this->formTagViewer->endTagToHtml();
    }
}
