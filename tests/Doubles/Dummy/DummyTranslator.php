<?php

declare(strict_types=1);

namespace Tests\Doubles\Dummy;

use EasyAdmin\Domain\I18N\Translator;

final class DummyTranslator implements Translator
{
    public function translate(string $key): string
    {
        return '';
    }
}
