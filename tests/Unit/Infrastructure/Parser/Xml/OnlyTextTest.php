<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Parser\Xml;

use EasyAdmin\Domain\Form\Component\Simple\TextComponent;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Helper\Convertor\StringToBooleanConvertor;
use EasyAdmin\I18N\I18nLoader;
use EasyAdmin\I18N\LanguageDetector;
use EasyAdmin\I18N\LanguageFactory;
use EasyAdmin\I18N\Translator;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Simple\TextComponentParser;
use EasyAdmin\Infrastructure\Parser\Xml\XmlParser;
use PHPUnit\Framework\TestCase;

final class OnlyTextTest extends TestCase
{
    private const FILE_PATH = __DIR__ . '/Resources/OnlyText.xml';
    private const WITH_VALUE_FILE_PATH = __DIR__ . '/Resources/OnlyTextWithValue.xml';

    /**
     * @test
     */
    public function it_retrieves_file_name(): void
    {
        $itemStructure = $this->parse(self::FILE_PATH);

        self::assertSame('OnlyText', $itemStructure->getName());
    }

    /**
     * @test
     */
    public function it_retrieves_text_component(): void
    {
        $itemStructure = $this->parse(self::FILE_PATH);

        self::assertCount(1, $itemStructure->getComponents());

        /** @var TextComponent $component */
        $component = $itemStructure->getComponents()[0];
        self::assertInstanceOf(TextComponent::class, $component);
        self::assertSame('firstname', $component->getLabelValue());
        self::assertSame('', $component->getTextElementValue());
    }

    /**
     * @test
     */
    public function it_retrieves_text_component_with_value(): void
    {
        $itemStructure = $this->parse(self::WITH_VALUE_FILE_PATH);

        self::assertCount(1, $itemStructure->getComponents());

        /** @var TextComponent $component */
        $component = $itemStructure->getComponents()[0];
        self::assertInstanceOf(TextComponent::class, $component);
        self::assertSame('firstname', $component->getLabelValue());
        self::assertSame('John', $component->getTextElementValue());
    }

    private function parse(string $filePath): ItemStructure
    {
        return (new XmlParser(
            [
                new TextComponentParser(
                    new StringToBooleanConvertor(),
                    new Translator(new I18nLoader(), new LanguageDetector(new LanguageFactory()))
                ),
            ]
        ))->parse($filePath);
    }
}
