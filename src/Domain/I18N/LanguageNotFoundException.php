<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

use LogicException;

final class LanguageNotFoundException extends LogicException
{
    public function __construct(string $languageName)
    {
        parent::__construct(sprintf('Given language "%s" is invalid.', $languageName));
    }
}
