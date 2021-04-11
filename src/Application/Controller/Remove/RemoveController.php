<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Remove;

use EasyAdmin\Application\Controller\Controller;
use EasyAdmin\Application\Controller\Error\NotFoundHttpResponse;
use EasyAdmin\Domain\Database\Exception\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RemoveController implements Controller
{
    private ItemStructureFactory $itemFactory;

    private ItemRemoveService $itemRemoveService;

    private ItemStructureViewer $viewer;

    public function __construct(
        ItemStructureFactory $itemFactory,
        ItemRemoveService $itemRemoveService,
        ItemStructureViewer $viewer
    ) {
        $this->itemFactory = $itemFactory;
        $this->itemRemoveService = $itemRemoveService;
        $this->viewer = $viewer;
    }

    public function getAction(): string
    {
        return 'remove';
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
            $htmlContent .= $this->itemRemoveService->removeAndRetrieveOutput($itemStructure);
        }

        $htmlContent .= $this->viewer->toHtml($itemStructure);

        return new Response($htmlContent, Response::HTTP_OK);
    }

}
