<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database\Exception;

use Throwable;

final class QueryException extends DatabaseException
{
    public static function fromException(string $query, string $errorMessage, Throwable $e): self
    {
        return new self(
            sprintf(
                'exec %s\n%s\n%s',
                $errorMessage,
                $e->getMessage(),
                $query
            )
        );
    }

    private function __construct(string $message)
    {
        parent::__construct($message);
    }
}
