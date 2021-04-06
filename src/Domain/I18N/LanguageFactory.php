<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

final class LanguageFactory
{
    /**
     * @param string $code
     *
     * @return Language
     *
     * @throws LanguageNotFoundException
     */
    public function createFromCode(string $code): Language
    {
        if ($code === 'fr' || $code === 'fr_FR') {
            return Language::fr();
        }
        if ($code === 'en' || $code === 'en_US') {
            return Language::en();
        }

        throw new LanguageNotFoundException($code);
    }
}
