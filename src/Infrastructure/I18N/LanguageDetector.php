<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\I18N;

use EasyAdmin\Domain\I18N\Language;
use EasyAdmin\Domain\I18N\LanguageDetector as LanguageDetectorInterface;
use EasyAdmin\Domain\I18N\LanguageFactory;
use EasyAdmin\Domain\I18N\LanguageNotFoundException;
use Symfony\Component\HttpFoundation\Request;

final class LanguageDetector implements LanguageDetectorInterface
{
    private LanguageFactory $factory;

    private Request $request;

    public function __construct(LanguageFactory $factory, Request $request)
    {
        $this->factory = $factory;
        $this->request = $request;
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
        $language = $this->request->query->get('lang', '');

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
        // TODO use request
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
