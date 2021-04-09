<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Create;

use EasyAdmin\Application\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateController implements Controller
{
    private ItemStructureFactory $itemFactory;

    private ItemCreator $itemCreator;

    private ItemStructureViewer $viewer;

    public function __construct(
        ItemStructureFactory $parser,
        ItemCreator $creator,
        ItemStructureViewer $viewer
    ) {
        $this->itemFactory = $parser;
        $this->itemCreator = $creator;
        $this->viewer = $viewer;
    }

    public function getAction(): string
    {
        return 'create';
    }

    public function __invoke(Request $request): Response
    {
        $itemStructure = $this->itemFactory->fromRequest($request);
        $htmlContent = '';

        if ($request->getMethod() === Request::METHOD_POST) {
            $htmlContent .= $this->itemCreator->createAndRetrieveOutput($itemStructure);
        }

        $htmlContent .= $this->viewer->toHtml($itemStructure);

        return new Response($htmlContent, Response::HTTP_OK);
    }
}
