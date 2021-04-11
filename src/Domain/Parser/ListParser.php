<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Parser;

use EasyAdmin\Domain\DisplayList\DisplayItem;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use InvalidArgumentException;

interface ListParser
{
    /**
     * @param ItemStructure $itemStructure
     * @param string        $path
     *
     * @return DisplayItem
     *
     * @throws InvalidArgumentException
     */
    public function parse(ItemStructure $itemStructure, string $path): DisplayItem;
}
