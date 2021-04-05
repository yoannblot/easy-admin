<?php

declare(strict_types=1);

namespace EasyAdmin\I18N;

final class LanguageDetector
{
    private LanguageFactory $factory;

    public function __construct(LanguageFactory $factory)
    {
        $this->factory = $factory;
    }

    public function detect(): Language
    {
        try {
            // First choice : language is defined in URL
            return $this->detectFromQuery();
        } catch (LanguageNotFoundException $e) {
            try {
                // Second choice : language is defined in session
                return $this->detectFromSession();
            } catch (LanguageNotFoundException $e) {
                return $this->detectFromBrowser();
            }
        }
    }

    /**
     * @return Language
     *
     * @throws LanguageNotFoundException
     */
    private function detectFromQuery(): Language
    {
        $language = $_GET['lang'] ?? '';

        return $this->factory->createFromIso2($language);
    }

    /**
     * @return Language
     *
     * @throws LanguageNotFoundException
     */
    private function detectFromSession(): Language
    {
        // TODO not implemented yet
        return $this->factory->createFromIso2('');
    }

    private function detectFromBrowser(): Language
    {
        $acceptedLanguages = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
        foreach (explode(';', $acceptedLanguages) as $sLangInfos) {
            // take the first language accepted
            foreach (explode(',', $sLangInfos) as $sLanguage) {
                try {
                    return $this->factory->createFromIso2($sLanguage);
                } catch (LanguageNotFoundException $e) {
                    continue;
                }
            }
        }

        return Language::en();
    }
}
