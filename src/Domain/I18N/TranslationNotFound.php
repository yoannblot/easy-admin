<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

final class TranslationNotFound extends Translation
{
    public function __construct(string $keyAndValue)
    {
        parent::__construct($keyAndValue, $keyAndValue);
    }
}
