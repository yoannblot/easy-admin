<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml;

use EasyAdmin\Domain\DisplayList\DisplayItem;
use EasyAdmin\Domain\DisplayList\Field;
use EasyAdmin\Domain\Form\Item\ItemStructure;
use EasyAdmin\Domain\Parser\ListParser;
use Exception;
use InvalidArgumentException;
use SimpleXMLElement;

final class XmlListParser implements ListParser
{
    public const EXTENSION = '.xml';

    public function parse(ItemStructure $itemStructure, string $path): DisplayItem
    {
        $this->assertValidXmlFile($path);

        $xmlElement = $this->createXmlElementFromFile($path);

        return new DisplayItem(
            $this->getFields($xmlElement),
            '',
            ''
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

    /**
     * @param SimpleXMLElement $xmlRootElement
     *
     * @return Field[]
     *
     * @throws InvalidArgumentException
     */
    private function getFields(SimpleXMLElement $xmlRootElement): array
    {
        $fields = [];
        foreach ($xmlRootElement->fields as $xmlFieldElement) {
            foreach ($xmlFieldElement->field as $xmlElement) {
                /** @var SimpleXMLElement $xmlElement */
                $attributes = $xmlElement->attributes();
                $name = (string) $attributes['name'];
                $fields[] = new Field($name, $name, '');
            }
        }

        return $fields;
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

        if ($xml->getName() !== 'list') {
            throw new InvalidArgumentException('Primary root must be <list>');
        }

        return $xml;
    }
}
