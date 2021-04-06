<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

use InvalidArgumentException;

interface Loader
{
    /**
     * @param string $directory
     *
     * @throws InvalidArgumentException
     */
    public function load(string $directory): void;

    /**
     * @param Language $language
     *
     * @return Translation[]
     */
    public function getAll(Language $language): array;
}
