<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Form\FormType\CreateForm;
use EasyAdmin\Parser\Parser;
use EasyAdmin\Viewer\Html\FormType\FormViewer;

final class ConfigFileToHtml
{
    private Parser $parser;

    private FormViewer $formViewer;

    private FormTagFactory $formTagFactory;

    public function __construct(Parser $parser, FormViewer $formViewer, FormTagFactory $formTagFactory)
    {
        $this->parser = $parser;
        $this->formViewer = $formViewer;
        $this->formTagFactory = $formTagFactory;
    }

    public function execute(string $filePath): string
    {
        $itemStructure = $this->parser->parse($filePath);

        return $this->formViewer->toHtml(
            new CreateForm($this->formTagFactory->getCreateFormTag($itemStructure), $itemStructure)
        );
    }
}
