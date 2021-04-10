<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Parser\Xml;

use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\I18N\LanguageFactory;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToBooleanConvertor;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToIntegerConvertor;
use EasyAdmin\Infrastructure\I18N\LanguageDetector;
use EasyAdmin\Infrastructure\I18N\Loader;
use EasyAdmin\Infrastructure\I18N\Translator;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Common\AttributesParser;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Simple\IdComponentParser;
use EasyAdmin\Infrastructure\Parser\Xml\XmlParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class IdTest extends TestCase
{
    private const FILE_PATH = __DIR__ . '/Resources/Id.xml';

    /**
     * @test
     */
    public function it_retrieves_id_bind(): void
    {
        $itemStructure = $this->parse(self::FILE_PATH);

        self::assertSame('my_custom_id', $itemStructure->getIdBind());
    }

    private function parse(string $filePath): ItemStructure
    {
        return (new XmlParser(
            [
                new IdComponentParser(
                    new AttributesParser(
                        new StringToBooleanConvertor(),
                        new Translator(
                            new Loader(),
                            new LanguageDetector(new LanguageFactory(), Request::createFromGlobals())
                        )
                    ),
                    new StringToIntegerConvertor()
                ),
            ]
        ))->parse($filePath, []);
    }
}
