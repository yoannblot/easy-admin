<?php

declare(strict_types=1);

namespace EasyAdmin\I18N;

final class Language
{
    private string $name;

    private string $fileName;

    public function __construct(string $name, string $fileName)
    {
        $this->name = $name;
        $this->fileName = $fileName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}
