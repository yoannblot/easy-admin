<?php

declare(strict_types=1);

namespace EasyAdmin\Database;

use EasyAdmin\Database\Exception\InvalidConnexionException;
use EasyAdmin\Database\Exception\QueryException;
use Exception;
use PDO;
use PDOStatement;

final class MysqlConnector
{
    private ?PDO $connection;

    public function __construct()
    {
        $this->connection = null;
    }

    /**
     * @param MysqlConnexion $connexion
     *
     * @throws InvalidConnexionException
     */
    public function load(MysqlConnexion $connexion): void
    {
        try {
            $this->connection = new PDO(
                $connexion->getDsn(),
                $connexion->getLogin(),
                $connexion->getPassword(),
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
            $this->connection->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } catch (Exception $e) {
            throw InvalidConnexionException::fromConnexion($connexion);
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

    /**
     * @param string $sQuery
     *
     * @return PDOStatement
     *
     * @throws QueryException
     *
     * @throws InvalidConnexionException
     */
    public function exec(string $sQuery): PDOStatement
    {
        $this->assertConnexionIsValid();
        try {
            return $this->connection->query($sQuery);
        } catch (Exception $e) {
            throw QueryException::fromException($sQuery, $this->getLastError(), $e);
        }
    }

    private function getLastError(): string
    {
        $aError = $this->connection->errorInfo();

        return 'code SQLSTATE : ' . $aError[0] . ' - driver code : ' . $aError[1] . ' - message : ' . $aError[2];
    }
}
