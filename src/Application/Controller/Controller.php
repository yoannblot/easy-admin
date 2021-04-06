<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface Controller
{
    public function getAction(): string;

    public function __invoke(Request $request): Response;
}
