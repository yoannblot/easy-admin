<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Viewer\Html\FormType;

use EasyAdmin\Domain\Form\FormType\Form;
use EasyAdmin\Infrastructure\Viewer\Html\Button\ButtonViewer;
use EasyAdmin\Infrastructure\Viewer\Html\FormType\Tag\FormTagViewer;

final class RemoveFormViewer
{
    private FormTagViewer $formTagViewer;

    private ButtonViewer $buttonViewer;

    public function __construct(FormTagViewer $formTagViewer, ButtonViewer $buttonViewer)
    {
        $this->formTagViewer = $formTagViewer;
        $this->buttonViewer = $buttonViewer;
    }

    public function toHtml(Form $form): string
    {
        return $this->formTagViewer->startTagToHtml($form->getTag())
            . $this->buttonViewer->toHtml($form->getButton())
            . $this->formTagViewer->endTagToHtml();
    }
}
