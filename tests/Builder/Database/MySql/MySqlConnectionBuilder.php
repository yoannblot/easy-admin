<?php

declare(strict_types=1);

namespace Tests\Builder\Database\MySql;

use EasyAdmin\Infrastructure\Database\MySql\MysqlConnection;

final class MySqlConnectionBuilder
{
    private string $database;

    private string $host;

    private string $login;

    private string $password;

    public function __construct()
    {
        $this->database = 'database';
        $this->host = 'localhost';
        $this->login = 'login';
        $this->password = 'password';
    }

    public function withDatabase(string $database): self
    {
        $this->database = $database;

        return $this;
    }

    public function withHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function build(): MysqlConnection
    {
        return new MysqlConnection($this->database, $this->host, $this->login, $this->password);
    }
}
