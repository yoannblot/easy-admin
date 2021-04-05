<?php

declare(strict_types=1);

namespace EasyAdmin\I18N;

final class Translator
{
    private I18nLoader $loader;

    private LanguageDetector $languageDetector;

    /**
     * @var Translation[]
     */
    private array $translations;

    private bool $loaded;

    public function __construct(I18nLoader $loader, LanguageDetector $languageDetector)
    {
        $this->loader = $loader;
        $this->languageDetector = $languageDetector;
        $this->translations = [];
        $this->loaded = false;
    }

    public function translate(string $key): string
    {
        if (!$this->loaded) {
            $this->translations = $this->loader->getAll($this->languageDetector->detect());
        }

        return $this->getTranslation($key)->translate();
    }

    private function getTranslation(string $key): Translation
    {
        foreach ($this->translations as $translation) {
            if ($translation->getKey() === $key) {
                return $translation;
            }
        }

        return new TranslationNotFound($key);
    }
}
