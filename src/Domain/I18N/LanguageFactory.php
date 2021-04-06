<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

final class LanguageFactory
{
    /**
     * @param string $iso2Name
     *
     * @return Language
     *
     * @throws LanguageNotFoundException
     */
    public function createFromIso2(string $iso2Name): Language
    {
        if ($iso2Name === 'fr') {
            return Language::fr();
        }
        if ($iso2Name === 'en') {
            return Language::en();
        }

        throw new LanguageNotFoundException($iso2Name);
    }
}
