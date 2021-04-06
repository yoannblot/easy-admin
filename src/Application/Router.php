<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Application\Controller\CreateController;
use Symfony\Component\HttpFoundation\Request;

final class Router
{
    private CreateController $createController;

    private Request $request;

    public function __construct(CreateController $createController, Request $request)
    {
        $this->createController = $createController;
        $this->request = $request;
    }

    public function execute(): string
    {
        if ($this->getItemType() === null) {
            // TODO home page
            return '';
        }

        if ($this->getPageType() === 'create') {
            return $this->createController->index($this->getItemType(), $this->request)->getContent();
        }

        // TODO 404
        return '';
    }

    private function getItemType(): ?string
    {
        return $this->request->query->get('type');
    }

    private function getPageType(): ?string
    {
        return $this->request->query->get('page');
    }
}
