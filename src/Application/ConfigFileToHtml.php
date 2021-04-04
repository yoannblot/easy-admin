<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Form\Button\CreateButton;
use EasyAdmin\Form\FormType\CreateForm;
use EasyAdmin\Parser\Parser;
use EasyAdmin\Viewer\Html\FormType\FormViewer;

final class ConfigFileToHtml
{
    private ConfigurationLoader $loader;

    private Parser $parser;

    private FormViewer $formViewer;

    private FormTagFactory $formTagFactory;

    public function __construct(
        ConfigurationLoader $loader,
        Parser $parser,
        FormViewer $formViewer,
        FormTagFactory $formTagFactory
    ) {
        $this->parser = $parser;
        $this->formViewer = $formViewer;
        $this->formTagFactory = $formTagFactory;
        $this->loader = $loader;
    }

    public function execute(string $itemName): string
    {
        $itemStructure = $this->parser->parse($this->loader->getFilePath($itemName));

        return $this->formViewer->toHtml(
            new CreateForm(
                $this->formTagFactory->getCreateFormTag($itemStructure),
                $itemStructure,
                new CreateButton('create-' . $itemStructure->getName())
            )
        );
    }
}
