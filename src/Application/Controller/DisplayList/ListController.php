<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\DisplayList;

use EasyAdmin\Application\Controller\Controller;
use EasyAdmin\Application\Controller\Create\ItemStructureFactory;
use EasyAdmin\Domain\Database\ItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListController implements Controller
{
    private ItemStructureFactory $factory;

    private ItemRepository $repository;

    public function __construct(ItemStructureFactory $itemStructureFactory, ItemRepository $repository)
    {
        $this->factory = $itemStructureFactory;
        $this->repository = $repository;
    }

    public function getAction(): string
    {
        return 'list';
    }

    public function __invoke(Request $request): Response
    {
        $itemStructure = $this->factory->fromRequest($request);

        $htmlContent = 'list of ' . $itemStructure->getName();
        foreach ($this->repository->getItemValues($itemStructure) as $elementValues) {
            $htmlContent .= implode(',', $elementValues);
        }

        return new Response($htmlContent, Response::HTTP_OK);
    }
}
