<?php

declare(strict_types=1);

namespace EasyAdmin\Parser\Xml\Component;

use EasyAdmin\Form\Component\Simple\TextComponent;
use SimpleXMLElement;

interface XmlComponentParser
{
    public function canHandle(string $componentType): bool;

    public function parse(SimpleXMLElement $xmlElement): TextComponent;
}
