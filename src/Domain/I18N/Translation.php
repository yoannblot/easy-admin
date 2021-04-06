<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

class Translation
{
    private string $key;

    private string $value;

    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function translate(): string
    {
        return $this->value;
    }
}
