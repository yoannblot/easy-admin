<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database\MySql;

use PHPUnit\Framework\TestCase;
use Tests\Builder\Database\MySql\MySqlConnexionBuilder;

final class MysqlConnexionTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_dsn(): void
    {
        $connexion = (new MySqlConnexionBuilder())->withDatabase('database')->withHost('localhost')->build();
        $expectedDsn = 'mysql:host=localhost;dbname=database;charset=utf8';

        self::assertSame($expectedDsn, $connexion->getDsn());
    }
}
