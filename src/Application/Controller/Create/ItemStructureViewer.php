<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Create;

use EasyAdmin\Domain\Form\FormType\FormFactory;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Infrastructure\Viewer\Html\FormType\FormViewer;

final class ItemStructureViewer
{
    private FormViewer $formViewer;

    private FormFactory $formFactory;

    public function __construct(FormViewer $formViewer, FormFactory $formFactory)
    {
        $this->formViewer = $formViewer;
        $this->formFactory = $formFactory;
    }

    public function toHtml(ItemStructure $itemStructure): string
    {
        return $this->formViewer->toHtml(
            $this->formFactory->createForm(
                $itemStructure
            )
        );
    }
}
