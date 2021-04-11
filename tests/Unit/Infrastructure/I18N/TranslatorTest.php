<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\I18N;

use EasyAdmin\Domain\I18N\Language;
use EasyAdmin\Domain\I18N\LanguageDetector;
use EasyAdmin\Domain\I18N\Loader;
use EasyAdmin\Domain\I18N\Translation;
use EasyAdmin\Infrastructure\I18N\Translator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class TranslatorTest extends TestCase
{
    /**
     * @var Translation[]
     */
    private array $translations;

    /**
     * @test
     */
    public function it_translates_a_word(): void
    {
        $this->translations = [
            new Translation('name', 'nom'),
        ];

        self::assertSame('nom', $this->getTranslator()->translate('name'));
    }

    /**
     * @test
     */
    public function it_retrieves_key_when_missing_from_translations(): void
    {
        $this->translations = [];

        self::assertSame('name', $this->getTranslator()->translate('name'));
    }

    private function getTranslator(): Translator
    {
        /** @var LanguageDetector|MockObject $languageDetector */
        $languageDetector = $this->createMock(LanguageDetector::class);
        $languageDetector->method('detect')->willReturn(Language::fr());

        /** @var Loader|MockObject $loader */
        $loader = $this->createMock(Loader::class);
        $loader->method('getAll')->with(Language::fr())->willReturn($this->translations);

        return new Translator($loader, $languageDetector);
    }
}
