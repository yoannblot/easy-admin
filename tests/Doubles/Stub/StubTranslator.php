<?php

declare(strict_types=1);

namespace Tests\Doubles\Stub;

use EasyAdmin\Domain\I18N\Translator;

final class StubTranslator implements Translator
{
    public function translate(string $key): string
    {
        return $key;
    }
}
