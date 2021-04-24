<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Update;

use EasyAdmin\Application\Controller\Controller;
use EasyAdmin\Application\Controller\Error\NotFoundHttpResponse;
use EasyAdmin\Domain\Database\Exception\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UpdateController implements Controller
{
    private ItemStructureFactory $itemFactory;

    private ItemUpdator $itemUpdator;

    private ItemStructureViewer $viewer;

    public function __construct(
        ItemStructureFactory $parser,
        ItemUpdator $itemUpdator,
        ItemStructureViewer $viewer
    ) {
        $this->itemFactory = $parser;
        $this->itemUpdator = $itemUpdator;
        $this->viewer = $viewer;
    }

    public function getAction(): string
    {
        return 'update';
    }

    public function __invoke(Request $request): Response
    {
        try {
            $itemStructure = $this->itemFactory->fromRequest($request);
        } catch (EntityNotFoundException $e) {
            return new NotFoundHttpResponse();
        }

        $htmlContent = '';
        if ($request->getMethod() === Request::METHOD_POST) {
            $htmlContent .= $this->itemUpdator->updateAndRetrieveOutput($itemStructure);
        }

        $htmlContent .= $this->viewer->toHtml($itemStructure);

        return new Response($htmlContent, Response::HTTP_OK);
    }
}
