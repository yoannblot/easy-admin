<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Update;

use EasyAdmin\Application\Loader\ConfigurationLoader;
use EasyAdmin\Domain\Database\ItemRepository;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Parser\ItemParser;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

final class ItemStructureFactory
{
    private ConfigurationLoader $loader;

    private ItemParser $parser;

    private ItemRepository $itemRepository;

    public function __construct(ConfigurationLoader $loader, ItemParser $parser, ItemRepository $itemRepository)
    {
        $this->loader = $loader;
        $this->parser = $parser;
        $this->itemRepository = $itemRepository;
    }

    public function fromRequest(Request $request): ItemStructure
    {
        if (!$request->query->has('type') || !$request->query->has('id')) {
            throw new InvalidArgumentException('type and id should be filled');
        }

        $itemName = $request->query->get('type');
        $itemId = (int) $request->query->get('id');

        $itemStructure = $this->parser->parse($this->loader->getItemFilePath($itemName), []);

        if ($request->getMethod() === Request::METHOD_POST) {
            $values = $request->request->all();
            $values[$itemStructure->getIdBind()] = $itemId;
        } else {
            $values = $this->itemRepository->get($itemStructure, $itemId);
        }

        return $this->parser->parse(
            $this->loader->getItemFilePath($itemName),
            $values
        );
    }
}
