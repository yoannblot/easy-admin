<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

use EasyAdmin\Domain\DisplayList\Filters;
use EasyAdmin\Domain\Form\Item\ItemStructure;

interface ItemRepository
{
    public function create(ItemStructure $itemStructure): bool;

    public function get(ItemStructure $itemStructure, int $itemId): array;

    /**
     * @param ItemStructure $structure
     * @param Filters       $filters
     *
     * @return ItemStructure[]
     */
    public function getItemValues(ItemStructure $structure, Filters $filters): array;

    public function remove(ItemStructure $structure): bool;
}
