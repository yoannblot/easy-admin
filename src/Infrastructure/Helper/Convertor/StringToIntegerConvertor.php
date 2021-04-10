<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Helper\Convertor;

final class StringToIntegerConvertor
{
    public function convert($asInteger): ?int
    {
        if (is_int($asInteger)) {
            return $asInteger;
        }

        if ($asInteger === '') {
            return null;
        }

        if (!is_numeric($asInteger)) {
            return null;
        }

        return (int) $asInteger;
    }
}
