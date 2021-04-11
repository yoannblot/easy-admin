<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

use EasyAdmin\Domain\Form\Item\ItemStructure;

interface ItemRepository
{
    public function create(ItemStructure $itemStructure): bool;

    public function get(ItemStructure $itemStructure, int $itemId): array;

    /**
     * @param ItemStructure $structure
     *
     * @return ItemStructure[]
     */
    public function getItemValues(ItemStructure $structure): array;

    public function remove(ItemStructure $structure): bool;
}
