<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Remove;

use EasyAdmin\Domain\Form\FormType\FormFactory;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Infrastructure\Viewer\Html\FormType\RemoveFormViewer;

final class ItemStructureViewer
{
    private RemoveFormViewer $formViewer;

    private FormFactory $formFactory;

    public function __construct(RemoveFormViewer $formViewer, FormFactory $formFactory)
    {
        $this->formViewer = $formViewer;
        $this->formFactory = $formFactory;
    }

    public function toHtml(ItemStructure $itemStructure): string
    {
        return $this->formViewer->toHtml(
            $this->formFactory->removeForm(
                $itemStructure
            )
        );
    }
}
