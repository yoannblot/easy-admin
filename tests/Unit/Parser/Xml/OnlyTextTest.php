<?php

declare(strict_types=1);

namespace Tests\Unit\Parser\Xml;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Item\ItemStructure;
use EasyAdmin\Parser\Xml\Component\Simple\TextComponentParser;
use EasyAdmin\Parser\Xml\XmlParser;
use PHPUnit\Framework\TestCase;

final class OnlyTextTest extends TestCase
{
    private const FILE_PATH = __DIR__ . '/Resources/OnlyText.xml';

    /**
     * @test
     */
    public function it_retrieves_file_name(): void
    {
        $itemStructure = $this->parse();

        self::assertSame('OnlyText', $itemStructure->getName());
    }

    /**
     * @test
     */
    public function it_retrieves_text_component(): void
    {
        $itemStructure = $this->parse();

        self::assertCount(1, $itemStructure->getComponents());

        /** @var TextComponent $component */
        $component = $itemStructure->getComponents()[0];
        self::assertInstanceOf(TextComponent::class, $component);
        self::assertSame('firstname', $component->getLabelValue());
        self::assertSame('', $component->getTextElementValue());
    }

    private function parse(): ItemStructure
    {
        return (new XmlParser([new TextComponentParser()]))->parse(self::FILE_PATH);
    }
}