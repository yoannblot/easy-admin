<?php

declare(strict_types=1);

namespace Tests\Doubles\Stub;

use EasyAdmin\Domain\Form\Item\ItemFactory;
use EasyAdmin\Domain\Form\Item\ItemStructure;

final class StubItemFactory implements ItemFactory
{
    private ItemStructure $itemStructure;

    public function get(string $itemName): ItemStructure
    {
        return $this->itemStructure;
    }

    public function setItemStructure(ItemStructure $itemStructure): void
    {
        $this->itemStructure = $itemStructure;
    }
}
