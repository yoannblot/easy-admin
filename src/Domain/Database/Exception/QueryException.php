<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database\Exception;

final class QueryException extends DatabaseException
{
    public static function fromQuery(string $query, string $errorMessage): self
    {
        return new self($errorMessage, $query);
    }

    private string $query;

    private function __construct(string $message, string $query)
    {
        parent::__construct($message);
        $this->query = $query;
    }

    public function getQuery(): string
    {
        return $this->query;
    }
}
