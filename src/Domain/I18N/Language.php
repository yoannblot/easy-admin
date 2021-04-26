<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

final class Language
{
    public static function fr(): self
    {
        return new Language('french', 'fr_FR');
    }

    public static function en(): self
    {
        return new Language('english', 'en_EN');
    }

    private string $name;

    private string $fileName;

    private function __construct(string $name, string $fileName)
    {
        $this->name = $name;
        $this->fileName = $fileName;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getShortName(): string
    {
        return substr($this->fileName, 0, 2);
    }
}
