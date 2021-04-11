<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\DisplayList;

use EasyAdmin\Domain\Database\ItemRepository;
use EasyAdmin\Domain\DisplayList\DisplayItemsParser;
use EasyAdmin\Domain\Form\Item\ItemStructure;

final class DisplayListViewer
{
    private ItemRepository $repository;

    private DisplayItemsParser $itemsParser;

    public function __construct(
        ItemRepository $repository,
        DisplayItemsParser $itemsParser
    ) {
        $this->repository = $repository;
        $this->itemsParser = $itemsParser;
    }

    public function toHtml(ItemStructure $itemStructure): string
    {
        // TODO only fields to display
        $displayListStructure = clone $itemStructure;

        ob_start();
        /** @noinspection PhpUnusedLocalVariableInspection */
        $items = $this->itemsParser->parse(
            $displayListStructure,
            $this->repository->getItemValues($displayListStructure)
        );
        require __DIR__ . '/../../../Infrastructure/Template/DisplayList/table.php';

        return ob_get_clean();
    }
}
