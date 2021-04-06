<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\I18N;

use EasyAdmin\Domain\I18N\Language;
use EasyAdmin\Domain\I18N\LanguageFactory;
use EasyAdmin\Infrastructure\I18N\LanguageDetector;
use PHPUnit\Framework\TestCase;

final class LanguageDetectorTest extends TestCase
{
    /**
     * @test
     */
    public function default_language_is_english(): void
    {
        $language = $this->detectLanguage();
        self::assertSame('english', $language->getName());
    }

    public function validLanguagesProvider(): array
    {
        return [
            'french' => ['fr', 'french'],
            'english' => ['en', 'english'],
        ];
    }

    /**
     * @test
     * @dataProvider validLanguagesProvider
     *
     * @param string $languageIso2
     * @param string $languageName
     */
    public function it_detects_from_query(string $languageIso2, string $languageName): void
    {
        $_GET['lang'] = $languageIso2;

        $language = $this->detectLanguage();
        self::assertSame($languageName, $language->getName());
    }

    /**
     * @test
     */
    public function it_retrieves_default_language_when_invalid_provided_in_query(): void
    {
        $_GET['lang'] = 'xx';

        $language = $this->detectLanguage();
        self::assertSame('english', $language->getName());
    }

    private function detectLanguage(): Language
    {
        return (new LanguageDetector(new LanguageFactory()))->detect();
    }
}
