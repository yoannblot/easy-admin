<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database\Exception;

use EasyAdmin\Domain\Database\Connexion;

final class InvalidConnexionException extends DatabaseException
{
    public static function fromConnexion(Connexion $connexion): self
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
