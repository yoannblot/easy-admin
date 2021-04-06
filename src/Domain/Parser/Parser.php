<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Parser;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use InvalidArgumentException;

interface Parser
{
    /**
     * @param string $path
     * @param array  $values
     *
     * @return ItemStructure
     *
     * @throws InvalidArgumentException
     */
    public function parse(string $path, array $values): ItemStructure;
}
