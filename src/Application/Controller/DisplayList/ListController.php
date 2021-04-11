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

    private ListStructureFactory $listStructureFactory;

    public function __construct(
        ItemStructureFactory $itemStructureFactory,
        DisplayListViewer $viewer,
        ListStructureFactory $listStructureFactory
    ) {
        $this->factory = $itemStructureFactory;
        $this->viewer = $viewer;
        $this->listStructureFactory = $listStructureFactory;
    }

    public function getAction(): string
    {
        return 'list';
    }

    public function __invoke(Request $request): Response
    {
        $itemStructure = $this->factory->fromRequest($request);

        $htmlContent = '<h1>list of ' . $itemStructure->getName() . '</h1>';

        $htmlContent .= $this->viewer->toHtml(
            $itemStructure,
            $this->listStructureFactory->fromItemStructure($itemStructure)
        );

        return new Response($htmlContent, Response::HTTP_OK);
    }
}
