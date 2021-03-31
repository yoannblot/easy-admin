<?php

declare(strict_types=1);

namespace EasyAdmin\Parser;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Item\ItemStructure;
use EasyAdmin\Form\Label\Label;
use Exception;
use InvalidArgumentException;
use SimpleXMLElement;

final class XmlParser implements Parser
{
    /**
     * @param string $path
     *
     * @return ItemStructure
     *
     * @throws InvalidArgumentException
     */
    public function parse(string $path): ItemStructure
    {
        $this->assertValidXmlFile($path);

        return new ItemStructure(
            $this->getItemName($path),
            $this->getComponents($path)
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

        if (!str_ends_with($path, '.xml')) {
            throw new InvalidArgumentException('Wrong file format. Expected XML file');
        }
    }

    /**
     * @param string $path
     *
     * @return TextComponent[]
     *
     * @throws InvalidArgumentException
     */
    private function getComponents(string $path): array
    {
        try {
            $xml = new SimpleXMLElement(file_get_contents($path));
        } catch (Exception $e) {
            throw new InvalidArgumentException('Invalid XML content');
        }

        if ($xml->getName() !== 'item') {
            throw new InvalidArgumentException('Primary root must be <item>');
        }

        $components = [];
        foreach ($xml as $componentType => $xmlElement) {
            if ($componentType === 'text') {
                $attributes = $xmlElement->attributes();
                $label = (string) $attributes['name'];

                $components[] = new TextComponent(new Label($label), new TextElement(''));
            }
        }

        return $components;
    }

    private function getItemName(string $path): string
    {
        return basename($path, '.xml');
    }
}
