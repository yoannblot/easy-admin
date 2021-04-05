<?php

declare(strict_types=1);

namespace Tests\Unit\Parser\Xml;

use EasyAdmin\Helper\Convertor\StringToBooleanConvertor;
use EasyAdmin\Parser\Xml\Component\Simple\TextComponentParser;
use EasyAdmin\Parser\Xml\XmlParser;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ErrorTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_when_file_does_not_exist(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->getXmlParser()->parse('fake_path.xml');
    }

    /**
     * @test
     */
    public function it_fails_when_file_is_not_xml_type(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->getXmlParser()->parse(__DIR__ . '/Resources/wrong-extension.txt');
    }

    /**
     * @test
     */
    public function it_fails_when_primary_root_is_missing(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->getXmlParser()->parse(__DIR__ . '/Resources/without-primary-root.xml');
    }

    /**
     * @test
     */
    public function it_fails_when_xml_content_is_invalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->getXmlParser()->parse(__DIR__ . '/Resources/parsing-error.xml');
    }

    private function getXmlParser(): XmlParser
    {
        return new XmlParser([new TextComponentParser(new StringToBooleanConvertor())]);
    }
}
