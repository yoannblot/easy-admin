<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database\MySql;

use PHPUnit\Framework\TestCase;
use Tests\Builder\Database\MySql\MySqlConnectionBuilder;

final class MysqlConnectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_retrieves_dsn(): void
    {
        $connexion = (new MySqlConnectionBuilder())->withDatabase('database')->withHost('localhost')->build();
        $expectedDsn = 'mysql:host=localhost;dbname=database;charset=utf8';

        self::assertSame($expectedDsn, $connexion->getDsn());
    }
}
