<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database;

use EasyAdmin\Infrastructure\Database\ConnectionLoader;
use EasyAdmin\Infrastructure\Database\MySql\MysqlConnection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ConnectionLoaderTest extends TestCase
{
    public function testItCreatesAMySQLConnection(): void
    {
        // Arrange
        $file = __DIR__ . '/Resources/valid.xml';

        // Act
        $connection = (new ConnectionLoader())->load($file);

        // Assert
        self::assertInstanceOf(MysqlConnection::class, $connection);
    }

    public function testItCreatesAValidMySQLDsn(): void
    {
        // Arrange
        $file = __DIR__ . '/Resources/valid.xml';

        // Act
        $connection = (new ConnectionLoader())->load($file);

        // Assert
        self::assertSame('mysql:host=localhost;dbname=db;charset=utf8', $connection->getDsn());
    }

    public function testItDoesNotHandleInvalidType(): void
    {
        // Arrange
        $file = __DIR__ . '/Resources/invalid-type.xml';

        // Assert
        $this->expectException(InvalidArgumentException::class);

        // Act
        (new ConnectionLoader())->load($file);
    }

    public function testItRetrievesLogin(): void
    {
        // Arrange
        $file = __DIR__ . '/Resources/valid.xml';

        // Act
        $connexion = (new ConnectionLoader())->load($file);

        // Assert
        $this->assertSame('user', $connexion->getLogin());
    }

    public function testItRetrievesPassword(): void
    {
        // Arrange
        $file = __DIR__ . '/Resources/valid.xml';

        // Act
        $connexion = (new ConnectionLoader())->load($file);

        // Assert
        $this->assertSame('pwd', $connexion->getPassword());
    }
}
