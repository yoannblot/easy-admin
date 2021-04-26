<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Form\Item;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Parser\ItemParser;

final class LoadedItemFactory implements ItemFactory
{
    private ConfigurationLoader $loader;

    private ItemParser $parser;

    public function __construct(ConfigurationLoader $loader, ItemParser $parser)
    {
        $this->loader = $loader;
        $this->parser = $parser;
    }

    public function get(string $itemName): ItemStructure
    {
        return $this->parser->parse($this->loader->getItemFilePath($itemName), []);
    }
}
