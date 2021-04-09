<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Database\MySql;

use EasyAdmin\Domain\Database\Connector;
use EasyAdmin\Domain\Database\Connexion;
use EasyAdmin\Domain\Database\Exception\InvalidConnexionException;
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

    public function load(Connexion $connexion): void
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
            throw InvalidConnexionException::fromConnexion($connexion);
        }
    }

    public function exec(string $sQuery): PDOStatement
    {
        $this->assertConnexionIsValid();
        try {
            return $this->connection->query($sQuery);
        } catch (PDOException $e) {
            throw QueryException::fromQuery($sQuery, $this->getLastError());
        }
    }

    public function execOnce(string $sQuery): bool
    {
        $this->assertConnexionIsValid();
        try {
            $iNbLines = $this->connection->exec($sQuery);

            return $iNbLines !== false;
        } catch (PDOException $e) {
            throw QueryException::fromQuery($sQuery, $this->getLastError());
        }
    }

    /**
     * @throws InvalidConnexionException
     */
    private function assertConnexionIsValid(): void
    {
        if ($this->connection === null) {
            throw InvalidConnexionException::notLoaded();
        }
    }

    private function getLastError(): string
    {
        $aError = $this->connection->errorInfo();

        return sprintf('[%d] %s', $aError[0], $aError[2]);
    }
}
