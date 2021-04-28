<?php

declare(strict_types=1);

namespace Tests\Doubles\Stub;

use EasyAdmin\Domain\Database\Connector;
use EasyAdmin\Domain\Database\Connexion;
use PDOStatement;

final class StubConnector implements Connector
{
    public function exec(string $sQuery): PDOStatement
    {
        return new PDOStatement();
    }

    public function execOnce(string $sQuery): bool
    {
        return true;
    }

    public function load(Connexion $connexion): void
    {
    }

}
