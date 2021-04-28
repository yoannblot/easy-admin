<?php

declare(strict_types=1);

namespace Tests\Doubles\Stub;

use EasyAdmin\Application\Logger\LoggerInterface;
use EasyAdmin\Domain\Database\Exception\QueryException;
use Psr\Log\NullLogger as PsrNullLogger;

final class NullLogger extends PsrNullLogger implements LoggerInterface
{
    public function queryError(QueryException $exception): void
    {
    }
}
