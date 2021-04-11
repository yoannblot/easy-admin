<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\DisplayList;

use EasyAdmin\Application\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListController implements Controller
{
    private ItemStructureFactory $factory;

    private DisplayListViewer $viewer;

    public function __construct(
        ItemStructureFactory $itemStructureFactory,
        DisplayListViewer $viewer
    ) {
        $this->factory = $itemStructureFactory;
        $this->viewer = $viewer;
    }

    public function getAction(): string
    {
        return 'list';
    }

    public function __invoke(Request $request): Response
    {
        $itemStructure = $this->factory->fromRequest($request);

        $htmlContent = '<h1>list of ' . $itemStructure->getName() . '</h1>';
        $htmlContent .= $this->viewer->toHtml($itemStructure);

        return new Response($htmlContent, Response::HTTP_OK);
    }
}
