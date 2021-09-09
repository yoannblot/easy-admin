<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\Database;

interface Connection
{
    public function getDsn(): string;

    public function getLogin(): string;

    public function getPassword(): string;
}
