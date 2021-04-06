<?php

declare(strict_types=1);

namespace EasyAdmin\Viewer\Html\FormType;

use EasyAdmin\Domain\Form\FormType\Form;
use EasyAdmin\Viewer\Html\Button\ButtonViewer;
use EasyAdmin\Viewer\Html\FormType\Tag\FormTagViewer;
use EasyAdmin\Viewer\HtmlViewer;

final class FormViewer
{
    private FormTagViewer $formTagViewer;

    private HtmlViewer $htmlViewer;

    private ButtonViewer $buttonViewer;

    public function __construct(FormTagViewer $formTagViewer, HtmlViewer $htmlViewer, ButtonViewer $buttonViewer)
    {
        $this->formTagViewer = $formTagViewer;
        $this->htmlViewer = $htmlViewer;
        $this->buttonViewer = $buttonViewer;
    }

    public function toHtml(Form $form): string
    {
        return $this->formTagViewer->startTagToHtml($form->getTag())
            . $this->htmlViewer->toHtml($form->getStructure())
            . $this->buttonViewer->toHtml($form->getButton())
            . $this->formTagViewer->endTagToHtml();
    }
}
