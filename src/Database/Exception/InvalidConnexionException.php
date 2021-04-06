<?php

declare(strict_types=1);

namespace EasyAdmin\Database\Exception;

use EasyAdmin\Database\MysqlConnexion;

final class InvalidConnexionException extends DatabaseException
{
    public static function fromConnexion(MysqlConnexion $connexion): self
    {
        return new self(
            sprintf(
                'Unable to connect to "%s" with couple "%s"/%s"',
                $connexion->getDsn(),
                $connexion->getLogin(),
                $connexion->getPassword()
            )
        );
    }

    public static function notLoaded()
    {
        return new self('Database connexion not loaded');
    }

    private function __construct(string $message)
    {
        parent::__construct($message);
    }
}
