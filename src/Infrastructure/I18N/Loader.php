<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\I18N;

use EasyAdmin\Domain\I18N\Language;
use EasyAdmin\Domain\I18N\Loader as LoaderInterface;
use EasyAdmin\Domain\I18N\Translation;
use InvalidArgumentException;

final class Loader implements LoaderInterface
{
    private array $directories;

    public function __construct()
    {
        $this->directories = [];
    }

    public function load(string $directory): void
    {
        if (!is_dir($directory)) {
            throw new InvalidArgumentException(sprintf('I18n directory not found "%s"', $directory));
        }
        $this->directories[] = $directory;
    }

    public function getAll(Language $language): array
    {
        $translations = [];
        foreach ($this->directories as $directory) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $language->getFileName() . '.lang';
            if (is_file($filePath)) {
                foreach ($this->getTranslations($filePath) as $translation) {
                    $translations[] = $translation;
                }
            }
        }

        return $translations;
    }

    /**
     * @param string $filePath
     *
     * @return Translation[]
     */
    private function getTranslations(string $filePath): array
    {
        $translations = [];

        $file = parse_ini_file($filePath, false, INI_SCANNER_RAW);
        if ($file === false) {
            throw new InvalidArgumentException(sprintf('Cannot parse language file : "%s".', $filePath));
        }
        foreach ($file as $sKey => $sValue) {
            $translations[] = new Translation($sKey, $sValue);
        }

        return $translations;
    }
}
