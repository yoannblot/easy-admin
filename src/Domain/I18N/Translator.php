<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

interface Translator
{
    public function translate(string $key): string;
}
