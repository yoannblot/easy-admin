<?php

declare(strict_types=1);

namespace EasyAdmin\Parser\Xml\Component\Simple;

use EasyAdmin\Form\Component\Simple\TextComponent;
use EasyAdmin\Form\Element\Simple\TextElement;
use EasyAdmin\Form\Label\Label;
use EasyAdmin\Parser\Xml\Component\XmlComponentParser;
use SimpleXMLElement;

final class TextComponentParser implements XmlComponentParser
{
    public function canHandle(string $componentType): bool
    {
        return $componentType === 'text';
    }

    public function parse(SimpleXMLElement $xmlElement): TextComponent
    {
        $attributes = $xmlElement->attributes();
        $label = (string) $attributes['name'];

        return new TextComponent(new Label($label), new TextElement(''));
    }
}
