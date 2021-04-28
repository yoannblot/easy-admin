<?php

declare(strict_types=1);

namespace Tests\Doubles\Stub;

use EasyAdmin\Domain\Database\Connector;
use EasyAdmin\Domain\Database\Connexion;
use EasyAdmin\Domain\Database\Exception\QueryException;
use PDOStatement;

final class FailConnector implements Connector
{
    public function exec(string $sQuery): PDOStatement
    {
        throw QueryException::fromQuery('query', 'message');
    }

    public function execOnce(string $sQuery): bool
    {
        throw QueryException::fromQuery('query', 'message');
    }

    public function load(Connexion $connexion): void
    {
        throw QueryException::fromQuery('query', 'message');
    }
}
