<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Api\Values;

use EasyAdmin\Application\Controller\Controller;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Common\ValuesParser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ValuesController implements Controller
{
    private ValuesParser $valuesParser;

    public function __construct(ValuesParser $valuesParser)
    {
        $this->valuesParser = $valuesParser;
    }

    public function __invoke(Request $request): Response
    {
        $valuesConfiguration = $request->query->get('values');
        $componentName = $request->query->get('name');

        return new JsonResponse($this->valuesParser->parse($componentName, $valuesConfiguration));
    }

    public function getAction(): string
    {
        return 'values';
    }
}
