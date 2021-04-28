<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Logger;

use EasyAdmin\Domain\Database\Exception\QueryException;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

interface LoggerInterface extends PsrLoggerInterface
{
    public function queryError(QueryException $exception): void;
}
