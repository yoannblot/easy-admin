<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Database\MySql;

use EasyAdmin\Domain\Database\Connector;
use EasyAdmin\Domain\Database\Connection;
use EasyAdmin\Domain\Database\Exception\InvalidConnectionException;
use EasyAdmin\Domain\Database\Exception\QueryException;
use PDO;
use PDOException;
use PDOStatement;

final class MysqlConnector implements Connector
{
    private ?PDO $connection;

    public function __construct()
    {
        $this->connection = null;
    }

    public function load(Connection $connexion): void
    {
        try {
            $this->connection = new PDO(
                $connexion->getDsn(),
                $connexion->getLogin(),
                $connexion->getPassword(),
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                ]
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } catch (PDOException $e) {
            throw InvalidConnectionException::fromConnection($connexion);
        }
    }

    public function exec(string $sQuery): PDOStatement
    {
        $this->assertConnectionIsValid();
        try {
            return $this->connection->query($sQuery);
        } catch (PDOException $e) {
            throw QueryException::fromQuery($sQuery, $this->getLastError());
        }
    }

    public function execOnce(string $sQuery): bool
    {
        $this->assertConnectionIsValid();
        try {
            $iNbLines = $this->connection->exec($sQuery);

            return $iNbLines !== false;
        } catch (PDOException $e) {
            throw QueryException::fromQuery($sQuery, $this->getLastError());
        }
    }

    /**
     * @throws InvalidConnectionException
     */
    private function assertConnectionIsValid(): void
    {
        if ($this->connection === null) {
            throw InvalidConnectionException::notLoaded();
        }
    }

    private function getLastError(): string
    {
        $aError = $this->connection->errorInfo();

        return sprintf('[%d] %s', $aError[0], $aError[2]);
    }
}
