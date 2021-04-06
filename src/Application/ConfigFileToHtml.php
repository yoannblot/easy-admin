<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Form\FormType\FormFactory;
use EasyAdmin\Domain\Parser\Parser;
use EasyAdmin\Viewer\Html\FormType\FormViewer;

final class ConfigFileToHtml
{
    private ConfigurationLoader $loader;

    private Parser $parser;

    private FormViewer $formViewer;

    private FormFactory $formFactory;

    public function __construct(
        ConfigurationLoader $loader,
        Parser $parser,
        FormViewer $formViewer,
        FormFactory $formFactory
    ) {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->formViewer = $formViewer;
        $this->formFactory = $formFactory;
    }

    public function execute(string $itemName): string
    {
        return $this->formViewer->toHtml(
            $this->formFactory->createForm(
                $this->parser->parse($this->loader->getFilePath($itemName)),
                'create'
            )
        );
    }
}
