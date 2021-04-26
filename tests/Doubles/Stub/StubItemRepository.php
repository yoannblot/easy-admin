<?php

declare(strict_types=1);

namespace Tests\Doubles\Stub;

use EasyAdmin\Domain\Database\ItemRepository;
use EasyAdmin\Domain\DisplayList\Filters;
use EasyAdmin\Domain\Form\Item\ItemStructure;

final class StubItemRepository implements ItemRepository
{
    private array $expectedValues = [];

    public function create(ItemStructure $itemStructure): bool
    {
        return true;
    }

    public function get(ItemStructure $itemStructure, int $itemId): array
    {
        return [];
    }

    public function getItemValues(ItemStructure $structure, Filters $filters): array
    {
        return $this->expectedValues;
    }

    public function remove(ItemStructure $structure): bool
    {
        return true;
    }

    public function setExpectedValues(array $expectedValues): void
    {
        $this->expectedValues = $expectedValues;
    }
}
