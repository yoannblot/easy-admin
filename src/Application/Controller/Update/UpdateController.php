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

    private ItemStructureViewer $viewer;

    public function __construct(
        ItemStructureFactory $parser,
        ItemStructureViewer $viewer
    ) {
        $this->itemFactory = $parser;
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
            // TODO updator
        }

        $htmlContent .= $this->viewer->toHtml($itemStructure);

        return new Response($htmlContent, Response::HTTP_OK);
    }
}
