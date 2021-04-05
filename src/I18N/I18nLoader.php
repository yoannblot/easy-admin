<?php

declare(strict_types=1);

namespace EasyAdmin\I18N;

use InvalidArgumentException;

final class I18nLoader
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

    /**
     * @param Language $language
     *
     * @return Translation[]
     */
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
