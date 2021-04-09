<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Form\FormType\FormFactory;
use EasyAdmin\Domain\Parser\Parser;
use EasyAdmin\Infrastructure\Database\MySql\ItemRepository;
use EasyAdmin\Infrastructure\Viewer\Html\FormType\FormViewer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateController implements Controller
{
    private ConfigurationLoader $loader;

    private Parser $parser;

    private FormViewer $formViewer;

    private FormFactory $formFactory;

    private ItemRepository $itemRepository;

    public function __construct(
        ConfigurationLoader $loader,
        Parser $parser,
        FormViewer $formViewer,
        FormFactory $formFactory,
        ItemRepository $itemRepository
    ) {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->formViewer = $formViewer;
        $this->formFactory = $formFactory;
        $this->itemRepository = $itemRepository;
    }

    public function getAction(): string
    {
        return 'create';
    }

    public function __invoke(Request $request): Response
    {
        $itemName = $request->query->get('type');
        $itemStructure = $this->parser->parse($this->loader->getFilePath($itemName), $this->getValues($request));

        if ($request->getMethod() === Request::METHOD_POST) {
            $isCreationSuccess = $this->itemRepository->create($itemStructure);
            if ($isCreationSuccess){
                // TODO flash message
                var_dump('Créer avec succès');
            }
        }

        return new Response(
            $this->formViewer->toHtml(
                $this->formFactory->createForm(
                    $itemStructure
                )
            ), Response::HTTP_OK
        );
    }

    private function getValues(Request $request): array
    {
        $values = [];
        if ($request->getMethod() === Request::METHOD_POST) {
            $values = $request->request->all();
        }

        return $values;
    }
}
