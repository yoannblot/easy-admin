<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

use EasyAdmin\Domain\Database\Exception\InvalidConnexionException;
use EasyAdmin\Domain\Database\Exception\QueryException;
use PDOStatement;

interface Connector
{
    /**
     * @param Connexion $connexion
     *
     * @throws InvalidConnexionException
     */
    public function load(Connexion $connexion): void;

    /**
     * @param string $sQuery
     *
     * @return PDOStatement
     *
     * @throws QueryException
     *
     * @throws InvalidConnexionException
     */
    public function exec(string $sQuery): PDOStatement;
}
