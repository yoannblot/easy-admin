<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database\MySql;

use EasyAdmin\Infrastructure\Database\MySql\MysqlConnexion;
use PHPUnit\Framework\TestCase;

final class MysqlConnexionTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_dsn(): void
    {
        $connexion = new MysqlConnexion('database', 'localhost', 'root', 'password');
        $expectedDsn = 'mysql:host=localhost;dbname=database;charset=utf8';

        self::assertSame($expectedDsn, $connexion->getDsn());
    }
}
