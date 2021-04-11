<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml;

use EasyAdmin\Domain\Form\Component\Simple\TextComponent;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Parser\ItemParser;
use EasyAdmin\Infrastructure\Parser\Xml\Component\XmlComponentParser;
use Exception;
use InvalidArgumentException;
use SimpleXMLElement;

final class XmlItemParser implements ItemParser
{
    public const EXTENSION = '.xml';

    /**
     * @var XmlComponentParser[]
     */
    private array $parsers;

    public function __construct(array $parsers)
    {
        $this->parsers = $parsers;
    }

    public function parse(string $path, array $values): ItemStructure
    {
        $this->assertValidXmlFile($path);

        $xmlElement = $this->createXmlElementFromFile($path);

        return new ItemStructure(
            $this->getItemName($path),
            $this->getItemTable($xmlElement),
            $this->getComponents($xmlElement, $values)
        );
    }

    /**
     * @param string $path
     *
     * @throws InvalidArgumentException
     */
    private function assertValidXmlFile(string $path): void
    {
        if (!is_file($path)) {
            throw new InvalidArgumentException('Given file not found');
        }

        if (!str_ends_with($path, self::EXTENSION)) {
            throw new InvalidArgumentException('Wrong file format. Expected XML file');
        }
    }

    private function getItemName(string $path): string
    {
        return basename($path, self::EXTENSION);
    }

    private function getItemTable(SimpleXMLElement $xmlRootElement): string
    {
        return (string) $xmlRootElement->attributes()['table'];
    }

    /**
     * @param SimpleXMLElement $xmlRootElement
     * @param array            $values
     *
     * @return TextComponent[]
     *
     * @throws InvalidArgumentException
     */
    private function getComponents(SimpleXMLElement $xmlRootElement, array $values): array
    {
        $components = [];
        foreach ($xmlRootElement as $componentType => $xmlElement) {
            foreach ($this->parsers as $parser) {
                if ($parser->canHandle($componentType)) {
                    $components[] = $parser->parse($xmlElement, $values);
                    break;
                }
            }
        }

        return $components;
    }

    /**
     * @param string $path
     *
     * @return SimpleXMLElement
     *
     * @throws InvalidArgumentException
     */
    private function createXmlElementFromFile(string $path): SimpleXMLElement
    {
        try {
            $xml = new SimpleXMLElement(file_get_contents($path));
        } catch (Exception $e) {
            throw new InvalidArgumentException('Invalid XML content');
        }

        if ($xml->getName() !== 'item') {
            throw new InvalidArgumentException('Primary root must be <item>');
        }

        return $xml;
    }
}
