<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Form\FormType\FormFactory;
use EasyAdmin\Domain\Message\FlashMessage;
use EasyAdmin\Domain\Message\FlashMessageFactory;
use EasyAdmin\Domain\Parser\Parser;
use EasyAdmin\Infrastructure\Database\MySql\ItemRepository;
use EasyAdmin\Infrastructure\Viewer\Html\FormType\FormViewer;
use EasyAdmin\Infrastructure\Viewer\Html\Message\FlashMessageViewer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateController implements Controller
{
    private ConfigurationLoader $loader;

    private Parser $parser;

    private FormViewer $formViewer;

    private FormFactory $formFactory;

    private ItemRepository $itemRepository;

    private FlashMessageFactory $messageFactory;

    private FlashMessageViewer $messageViewer;

    public function __construct(
        ConfigurationLoader $loader,
        Parser $parser,
        FormViewer $formViewer,
        FormFactory $formFactory,
        ItemRepository $itemRepository,
        FlashMessageFactory $messageFactory,
        FlashMessageViewer $messageViewer
    ) {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->formViewer = $formViewer;
        $this->formFactory = $formFactory;
        $this->itemRepository = $itemRepository;
        $this->messageFactory = $messageFactory;
        $this->messageViewer = $messageViewer;
    }

    public function getAction(): string
    {
        return 'create';
    }

    public function __invoke(Request $request): Response
    {
        $itemName = $request->query->get('type');
        $itemStructure = $this->parser->parse($this->loader->getFilePath($itemName), $this->getValues($request));
        $htmlContent = '';

        if ($request->getMethod() === Request::METHOD_POST) {
            $isCreationSuccess = $this->itemRepository->create($itemStructure);
            if ($isCreationSuccess) {
                // TODO translate
                $message = $this->messageFactory->create(FlashMessage::SUCCESS, 'Création réussi');
            } else {
                // TODO translate
                $message = $this->messageFactory->create(FlashMessage::ERROR, 'Problème de création');
            }

            $htmlContent .= $this->messageViewer->toHtml($message);
        }

        $htmlContent .= $this->formViewer->toHtml(
            $this->formFactory->createForm(
                $itemStructure
            )
        );

        return new Response(
            $htmlContent, Response::HTTP_OK
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
