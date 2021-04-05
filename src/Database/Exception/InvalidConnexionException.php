<?php

declare(strict_types=1);

namespace EasyAdmin\Database\Exception;

use EasyAdmin\Database\MysqlConnexion;

final class InvalidConnexionException extends DatabaseException
{
    public function __construct(MysqlConnexion $connexion)
    {
        parent::__construct(
            sprintf(
                'Unable to connect to "%s" with couple "%s"/%s"',
                $connexion->getDsn(),
                $connexion->getLogin(),
                $connexion->getPassword()
            )
        );
    }
}
