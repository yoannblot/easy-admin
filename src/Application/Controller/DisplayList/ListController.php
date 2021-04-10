<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\DisplayList;

use EasyAdmin\Application\Controller\Controller;
use EasyAdmin\Domain\Database\ItemRepository;
use EasyAdmin\Domain\DisplayList\DisplayItemsParser;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListController implements Controller
{
    private ItemStructureFactory $factory;

    private ItemRepository $repository;

    private DisplayItemsParser $itemsParser;

    public function __construct(
        ItemStructureFactory $itemStructureFactory,
        ItemRepository $repository,
        DisplayItemsParser $itemsParser
    ) {
        $this->factory = $itemStructureFactory;
        $this->repository = $repository;
        $this->itemsParser = $itemsParser;
    }

    public function getAction(): string
    {
        return 'list';
    }

    public function __invoke(Request $request): Response
    {
        $itemStructure = $this->factory->fromRequest($request);

        $htmlContent = '<h1>list of ' . $itemStructure->getName() . '</h1>';
        $htmlContent .= $this->getTableContent($itemStructure);

        return new Response($htmlContent, Response::HTTP_OK);
    }

    private function getTableContent(ItemStructure $itemStructure): string
    {
        ob_start();
        $items = $this->itemsParser->parse($itemStructure, $this->repository->getItemValues($itemStructure));
        require __DIR__ . '/../../../Infrastructure/Template/DisplayList/table.php';

        return ob_get_clean();
    }
}
