<?php

declare(strict_types=1);

namespace EasyAdmin\Infrastructure\Parser\Xml\Component\Simple;

use EasyAdmin\Domain\Form\Component\Simple\IdComponent;
use EasyAdmin\Domain\Form\Element\Simple\IntegerElement;
use EasyAdmin\Infrastructure\Helper\Convertor\StringToIntegerConvertor;
use EasyAdmin\Infrastructure\Parser\Xml\Component\XmlComponentParser;
use SimpleXMLElement;

final class IdComponentParser implements XmlComponentParser
{
    private StringToIntegerConvertor $convertor;

    public function __construct(StringToIntegerConvertor $convertor)
    {
        $this->convertor = $convertor;
    }

    public function canHandle(string $componentType): bool
    {
        return $componentType === 'id';
    }

    public function parse(SimpleXMLElement $xmlElement, array $values): IdComponent
    {
        $attributes = $xmlElement->attributes();
        $bind = (string) $attributes['bind'];
        $value = $values[$bind] ?? '';

        return new IdComponent(new IntegerElement($this->convertor->convert($value), $bind));
    }
}
