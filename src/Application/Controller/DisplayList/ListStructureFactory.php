<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\DisplayList;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\DisplayList\DisplayItem;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Parser\ListParser;

final class ListStructureFactory
{
    private ConfigurationLoader $loader;

    private ListParser $parser;

    public function __construct(ConfigurationLoader $loader, ListParser $parser)
    {
        $this->loader = $loader;
        $this->parser = $parser;
    }

    public function fromItemStructure(ItemStructure $itemStructure): DisplayItem
    {
        return $this->parser->parse($itemStructure, $this->loader->getListFilePath($itemStructure->getName()));
    }
}
