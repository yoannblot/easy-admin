<?php

declare(strict_types=1);

namespace EasyAdmin\Parser;

use EasyAdmin\Domain\Form\Item\ItemStructure;

interface Parser
{
    public function parse(string $path): ItemStructure;
}
