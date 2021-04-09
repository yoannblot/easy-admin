<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

use EasyAdmin\Domain\Form\Item\ItemStructure;

interface ItemRepository
{
    public function create(ItemStructure $itemStructure): bool;

    public function get(ItemStructure $itemStructure, int $itemId): array;
}
