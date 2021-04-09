<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Controller\Error;

use Symfony\Component\HttpFoundation\Response;

final class NotFoundHttpResponse extends Response
{
    public function __construct()
    {
        parent::__construct('404 Not found', Response::HTTP_NOT_FOUND);
    }
}
