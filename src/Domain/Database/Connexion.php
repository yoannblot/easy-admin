<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

interface Connexion
{
    public function getDsn(): string;

    public function getLogin(): string;

    public function getPassword(): string;
}
