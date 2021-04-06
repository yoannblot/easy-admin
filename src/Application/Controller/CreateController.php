<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Form\FormType\FormFactory;
use EasyAdmin\Domain\Parser\Parser;
use EasyAdmin\Infrastructure\Viewer\Html\FormType\FormViewer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateController implements Controller
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

    public function getAction(): string
    {
        return 'create';
    }

    public function __invoke(Request $request): Response
    {
        if ($request->getMethod() === Request::METHOD_POST) {
            // TODO retrieve values
            $values = $request->request->all();
        }

        $itemName = $request->query->get('type');

        return new Response(
            $this->formViewer->toHtml(
                $this->formFactory->createForm(
                    $this->parser->parse($this->loader->getFilePath($itemName)),
                    'create'
                )
            ), Response::HTTP_OK
        );
    }
}
