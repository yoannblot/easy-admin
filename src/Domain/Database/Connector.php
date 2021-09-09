<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

use EasyAdmin\Domain\Database\Exception\InvalidConnectionException;
use EasyAdmin\Domain\Database\Exception\QueryException;
use PDOStatement;

interface Connector
{
    /**
     * @param Connection $connexion
     *
     * @throws InvalidConnectionException
     */
    public function load(Connection $connexion): void;

    /**
     * @param string $sQuery
     *
     * @return PDOStatement
     *
     * @throws QueryException
     *
     * @throws InvalidConnectionException
     */
    public function exec(string $sQuery): PDOStatement;

    /**
     * @param string $sQuery
     *
     * @return bool
     *
     * @throws QueryException
     *
     * @throws InvalidConnectionException
     */
    public function execOnce(string $sQuery): bool;
}
