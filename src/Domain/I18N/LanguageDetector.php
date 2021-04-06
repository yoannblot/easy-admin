<?php

declare(strict_types=1);

namespace EasyAdmin\Domain\I18N;

interface LanguageDetector
{
    public function detect(): Language;
}
