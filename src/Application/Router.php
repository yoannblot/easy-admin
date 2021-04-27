<?php

declare(strict_types=1);

namespace EasyAdmin\Application;

use EasyAdmin\Application\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class Router
{
    /**
     * @var Controller[]
     */
    private array $controllers;

    private Request $request;

    public function __construct(array $controllers, Request $request)
    {
        $this->controllers = $controllers;
        $this->request = $request;
    }

    public function execute(): Response
    {
        foreach ($this->controllers as $controller) {
            if ($this->getAction() === $controller->getAction()) {
                return $controller->__invoke($this->request);
            }
        }

        return new Response('Not found', Response::HTTP_NOT_FOUND);
    }

    private function getAction(): ?string
    {
        return $this->request->query->get('page');
    }
}
