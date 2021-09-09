<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database\Exception;

use EasyAdmin\Domain\Database\Connection;

final class InvalidConnectionException extends DatabaseException
{
    public static function fromConnection(Connection $connexion): self
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
        return new self('Database connection not loaded');
    }

    private function __construct(string $message)
    {
        parent::__construct($message);
    }
}
