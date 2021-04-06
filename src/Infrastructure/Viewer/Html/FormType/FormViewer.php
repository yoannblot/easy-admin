<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\FormType;

use EasyAdmin\Domain\Form\FormType\Form;
use EasyAdmin\Domain\Viewer\Html\Viewer;
use EasyAdmin\Infrastructure\Viewer\Html\Button\ButtonViewer;
use EasyAdmin\Infrastructure\Viewer\Html\FormType\Tag\FormTagViewer;

final class FormViewer
{
    private FormTagViewer $formTagViewer;

    private Viewer $htmlViewer;

    private ButtonViewer $buttonViewer;

    public function __construct(FormTagViewer $formTagViewer, Viewer $htmlViewer, ButtonViewer $buttonViewer)
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
