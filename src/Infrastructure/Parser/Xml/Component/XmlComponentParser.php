<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component;

use EasyAdmin\Domain\Form\Component\Simple\TextComponent;
use SimpleXMLElement;

interface XmlComponentParser
{
    public function canHandle(string $componentType): bool;

    public function parse(SimpleXMLElement $xmlElement): TextComponent;
}
