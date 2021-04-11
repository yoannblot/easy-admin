<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Create;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Parser\ItemParser;
use Symfony\Component\HttpFoundation\Request;

final class ItemStructureFactory
{
    private ConfigurationLoader $loader;

    private ItemParser $parser;

    public function __construct(ConfigurationLoader $loader, ItemParser $parser)
    {
        $this->loader = $loader;
        $this->parser = $parser;
    }

    public function fromRequest(Request $request): ItemStructure
    {
        $itemName = $request->query->get('type');

        return $this->parser->parse($this->loader->getFilePath($itemName), $this->getValues($request));
    }

    private function getValues(Request $request): array
    {
        $values = [];
        if ($request->getMethod() === Request::METHOD_POST) {
            $values = $request->request->all();
        }

        return $values;
    }
}
