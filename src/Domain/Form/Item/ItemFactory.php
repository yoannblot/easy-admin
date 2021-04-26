<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Item;

interface ItemFactory
{
    public function get(string $itemName): ItemStructure;
}
