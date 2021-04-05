<?php

declare(strict_types=1);

namespace EasyAdmin\Database\Exception;

use Throwable;

final class QueryException extends DatabaseException
{
    public static function fromException(string $query, string $errorMessage, ?Throwable $e): self
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

    public static function fromQuery(string $query): self
    {
        return new self(sprintf('Invalid query \n%s', $query));
    }

    private function __construct(string $message)
    {
        parent::__construct($message);
    }
}
