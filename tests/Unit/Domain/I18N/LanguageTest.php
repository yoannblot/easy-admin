<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\I18N;

use EasyAdmin\Domain\I18N\Language;
use PHPUnit\Framework\TestCase;

final class LanguageTest extends TestCase
{
    /**
     * @test
     * @dataProvider validLanguageProvider
     */
    public function it_retrieves_valid_short_name(Language $language, string $expectedShortName): void
    {
        self::assertSame($expectedShortName, $language->getShortName());
    }

    public function validLanguageProvider(): array
    {
        return [
            'french' => [Language::fr(), 'fr'],
            'english' => [Language::en(), 'en'],
        ];
    }
}
