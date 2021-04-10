<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Simple;

use EasyAdmin\Domain\Form\Component\Simple\TextComponent;
use EasyAdmin\Domain\Form\Element\Simple\TextElement;
use EasyAdmin\Domain\Form\Label\Label;
use EasyAdmin\Infrastructure\Parser\Xml\Component\Common\AttributesParser;
use EasyAdmin\Infrastructure\Parser\Xml\Component\XmlComponentParser;
use SimpleXMLElement;

final class TextComponentParser implements XmlComponentParser
{
    private AttributesParser $attributesParser;

    public function __construct(AttributesParser $attributesParser)
    {
        $this->attributesParser = $attributesParser;
    }

    public function canHandle(string $componentType): bool
    {
        return $componentType === 'text';
    }

    public function parse(SimpleXMLElement $xmlElement, array $values): TextComponent
    {
        $attributes = $this->attributesParser->parse($xmlElement);
        $value = $values[$attributes->getName()] ?? $attributes->getDefaultValue();

        return new TextComponent(
            $attributes->getName(),
            new Label($attributes->getLabel()),
            new TextElement($value, $attributes->getBind()),
            $attributes->isRequired()
        );
    }
}
