<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Helper\Convertor;

final class StringToBooleanConvertor
{
    public function convert(string $asBoolean): bool
    {
        return ('on' === $asBoolean || 'true' === $asBoolean);
    }
}
