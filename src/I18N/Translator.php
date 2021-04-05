<?php

declare(strict_types=1);

namespace EasyAdmin\I18N;

final class Translator
{
    /**
     * @var Translation[]
     */
    private array $translations;

    private I18nLoader $loader;

    private bool $loaded;

    public function __construct(I18nLoader $loader)
    {
        $this->translations = [];
        $this->loader = $loader;
        $this->loaded = false;
    }

    public function translate(string $key): string
    {
        if (!$this->loaded) {
            // TODO retrieve current language
            $this->translations = $this->loader->getAll(new Language('french', 'fr_FR'));
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
