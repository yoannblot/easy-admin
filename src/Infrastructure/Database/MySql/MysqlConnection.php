<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Database\MySql;

use EasyAdmin\Domain\Database\Connection;

final class MysqlConnection implements Connection
{
    private string $database;

    private string $host;

    private string $login;

    private string $password;

    public function __construct(string $database, string $host, string $login, string $password)
    {
        $this->database = $database;
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
    }

    public function getDsn(): string
    {
        return sprintf('mysql:host=%s;dbname=%s;charset=utf8', $this->host, $this->database);
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
