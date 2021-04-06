<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Parser\Xml;

use EasyAdmin\Domain\I18N\LanguageFactory;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToBooleanConvertor;
use EasyAdmin\Infrastructure\I18N\LanguageDetector;
use EasyAdmin\Infrastructure\I18N\Loader;
use EasyAdmin\Infrastructure\I18N\Translator;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Simple\TextComponentParser;
use EasyAdmin\Infrastructure\Parser\Xml\XmlParser;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

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
        return new XmlParser(
            [
                new TextComponentParser(
                    new StringToBooleanConvertor(),
                    new Translator(
                        new Loader(),
                        new LanguageDetector(new LanguageFactory(), Request::createFromGlobals())
                    )
                ),
            ]
        );
    }
}
